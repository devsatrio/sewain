<?php

namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Image;
use Aksespengguna;
class kategoricontroller extends Controller
{
    private $halaman ='Kategori';
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
            $data = DB::table('kategori')->get();
            return view('kategori.index',['data'=>$data,'websetting'=>$websetting,'aksescreate'=>$aksesnya['create'],'aksesdelete'=>$aksesnya['delete'],'aksesedit'=>$aksesnya['edit']]);
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
     
        $destinationPath = public_path('image/kategori/thumbnail');
        $img = Image::make($image->getRealPath());
        $img->resize(100,null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
   
        $destinationPath = public_path('image/kategori');
        $image->move($destinationPath, $input['imagename']);

        DB::table('kategori')
        ->insert([
            'nama'=>$request->nama,
            'status'=>$request->status,
            'gambar'=>$input['imagename']
        ]); }
        return redirect('kategori')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        if ($request->hasFile('foto')) {
            File::delete('image/kategori/'.$request->gambarlama);
            File::delete('image/kategori/thumbnail/'.$request->gambarlama);
            $image = $request->file('foto');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/kategori/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/kategori');
            $image->move($destinationPath, $input['imagename']);

            DB::table('kategori')
            ->where('id',$id)
            ->update([
                'nama'=>$request->nama,
                'status'=>$request->status,
                'gambar'=>$input['imagename']
            ]);
        }else{
            DB::table('kategori')
            ->where('id',$id)
            ->update([
                'nama'=>$request->nama,
                'status'=>$request->status
            ]); 
        }
        
        return redirect('kategori')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
      $id = Crypt::decrypt($kode);
      $data = DB::table('kategori')->where('id',$id)->get();
      foreach ($data as $row) {
         if($row->gambar!=''){
            File::delete('image/kategori/'.$row->gambar);
            File::delete('image/kategori/thumbnail/'.$row->gambar);
         } 
      }
      DB::table('kategori')->where('id',$id)->delete();
      return redirect('kategori')->with('msg','Data Berhasil Dihapus');
    }
}
