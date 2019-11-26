<?php

namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Image;
class kategoriartikelcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('kategori_artikel')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('kategoriartikel.index',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function store(Request $request)
    {
        DB::table('kategori_artikel')
        ->insert([
            'nama'=>$request->nama,
            'status'=>$request->status
        ]);
        return redirect('kategori-artikel')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($kode);
        DB::table('kategori_artikel')
        ->where('id',$id)
        ->update([
            'nama'=>$request->nama,
            'status'=>$request->status,
        ]);
        return redirect('kategori-artikel')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //=================================================================
    public function destroy($kode)
    {
      $id = Crypt::decrypt($kode);
      DB::table('kategori_artikel')->where('id',$id)->delete();
      return redirect('kategori-artikel')->with('msg','Data Berhasil Dihapus');
    }
}
