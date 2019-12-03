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
class dashboardcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $jumlahuser = DB::table('pengguna')->count();
        $websetting = DB::table('setting')->limit(1)->get();
        $jumlahtoko = DB::table('toko')->count();
        $jumlahadmin = DB::table('users')->count();
        return view('dashboard.index',['websetting'=>$websetting,'jumlahuser'=>$jumlahuser,'jumlahtoko'=>$jumlahtoko,'jumlahadmin'=>$jumlahadmin]);
    }

    //===============================================================
    public function editprofile(){
        $data = DB::table('users')->where('id',Auth::user()->id)->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('dashboard.editprofile',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function aksieditprofile(Request $request,$kode){
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
                'email'=>$request->email,
                'password'=>Hash::make($request->pass),
                'foto'=>$input['imagename']
            ]);
            return redirect('dashboard')->with('msg','Perubahan Data Berhasil Disimpan'); 
        }else{
            DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$request->nama,
                'username'=>$request->usern,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'email'=>$request->email,
                'foto'=>$input['imagename']
            ]);
            return redirect('dashboard')->with('msg','Perubahan Data Berhasil Disimpan'); 
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
                'email'=>$request->email,
                'password'=>Hash::make($request->pass)
            ]);
            return redirect('dashboard')->with('msg','Perubahan Data Berhasil Disimpan'); 
        }else{
            DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$request->nama,
                'username'=>$request->usern,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'email'=>$request->email,
            ]);
            return redirect('dashboard')->with('msg','Perubahan Data Berhasil Disimpan'); 
        } 
        }
    }
}
