<?php

namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Aksespengguna;
use Image;
class admincontroller extends Controller
{
    private $halaman ='Admin';
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $akses = Aksespengguna::cariakses(Auth::user()->level,$this->halaman);
        $aksesnya = Aksespengguna::setakses($akses);
        $websetting = DB::table('setting')->limit(1)->get();
        if($aksesnya['view']>0){
        $data = DB::table('users')
        ->select(DB::raw('users.*,roles.nama as leveluser'))
        ->leftjoin('roles','roles.id','=','users.level')
        ->get();
        return view('admin.index',['data'=>$data,'websetting'=>$websetting,'aksescreate'=>$aksesnya['create'],'aksesdelete'=>$aksesnya['delete'],'aksesedit'=>$aksesnya['edit']]);
         }else{
          return view('error.404',['websetting'=>$websetting]);   
        }
    }

    //===============================================================
    public function create()
    {
        $akses = Aksespengguna::cariakses(Auth::user()->level,$this->halaman);
        $aksesnya = Aksespengguna::setakses($akses);
        $websetting = DB::table('setting')->limit(1)->get();
        if($aksesnya['create']>0){
        $dataroles = DB::table('roles')->get();
        return view('admin.create',['dataroles'=>$dataroles,'websetting'=>$websetting]);
        }else{
               return view('error.404',['websetting'=>$websetting]); 
            }
    }

    //===============================================================
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
     
        $destinationPath = public_path('image/admin/thumbnail');
        $img = Image::make($image->getRealPath());
        $img->resize(100,null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
   
        $destinationPath = public_path('image/admin');
        $image->move($destinationPath, $input['imagename']);
        }
        DB::table('users')
        ->insert([
            'name'=>$request->nama,
            'username'=>$request->usern,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
            'level'=>$request->level,
            'email'=>$request->email,
            'password'=>Hash::make($request->pass),
            'foto'=>$input['imagename']
        ]);

        return redirect('admin')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function edit($kode)
    {
        $akses = Aksespengguna::cariakses(Auth::user()->level,$this->halaman);
        $aksesnya = Aksespengguna::setakses($akses);
        $websetting = DB::table('setting')->limit(1)->get();
        if($aksesnya['edit']>0){
        $id = Crypt::decrypt($kode);
        $data = DB::table('users')->where('id',$id)->get();
        $dataroles = DB::table('roles')->get();
        return view('admin.edit',['dataroles'=>$dataroles,'data'=>$data,'websetting'=>$websetting]);
        }else{
               return view('error.404',['websetting'=>$websetting]); 
            }
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        if ($request->hasFile('foto')) {
            File::delete('image/admin/'.$request->gambarlama);
            File::delete('image/admin/thumbnail/'.$request->gambarlama);
            $image = $request->file('foto');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/admin/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/admin');
            $image->move($destinationPath, $input['imagename']);
            if($request->pass!=''){
            DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$request->nama,
                'username'=>$request->usern,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'level'=>$request->level,
                'email'=>$request->email,
                'password'=>Hash::make($request->pass),
                'foto'=>$input['imagename']
            ]);
            return redirect('admin')->with('msg','Perubahan Data Berhasil Disimpan'); 
        }else{
            DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$request->nama,
                'username'=>$request->usern,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'level'=>$request->level,
                'email'=>$request->email,
                'foto'=>$input['imagename']
            ]);
            return redirect('admin')->with('msg','Perubahan Data Berhasil Disimpan'); 
        }
        }else{
           if($request->pass!=''){
            DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$request->nama,
                'username'=>$request->usern,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'level'=>$request->level,
                'email'=>$request->email,
                'password'=>Hash::make($request->pass)
            ]);
            return redirect('admin')->with('msg','Perubahan Data Berhasil Disimpan'); 
        }else{
            DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$request->nama,
                'username'=>$request->usern,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'level'=>$request->level,
                'email'=>$request->email,
            ]);
            return redirect('admin')->with('msg','Perubahan Data Berhasil Disimpan'); 
        } 
        }
        
    }

    //===============================================================
    public function destroy($kode)
    {
      $id = Crypt::decrypt($kode);
      $data = DB::table('users')->where('id',$id)->get();
      foreach ($data as $row) {
         if($row->foto!=''){
            File::delete('image/admin/'.$row->foto);
            File::delete('image/admin/thumbnail/'.$row->foto);
         } 
      }
      DB::table('users')->where('id',$id)->delete();
      return redirect('admin')->with('msg','Data Berhasil Dihapus');
    }
}
