<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class subkategoricontroller extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('subkategori')
        ->select(DB::raw('subkategori.*,kategori.nama as namakategori'))
        ->leftjoin('kategori','kategori.id','=','subkategori.id_kategori')
        ->get();
        $datakategori = DB::table('kategori')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('subkategori.index',['data'=>$data,'datakategori'=>$datakategori,'websetting'=>$websetting]);
    }

    //===============================================================
    public function store(Request $request)
    {
        DB::table('subkategori')
        ->insert([
            'nama'=>$request->nama,
            'id_kategori'=>$request->kategori,
            'status'=>$request->status
        ]);
        return redirect('sub-kategori')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('subkategori')
        ->where('id',$id)
        ->update([
            'id_kategori'=>$request->kategori,
            'nama'=>$request->nama,
            'status'=>$request->status
        ]);
        return redirect('sub-kategori')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('subkategori')->where('id',$id)->delete();
        return redirect('sub-kategori')->with('msg','Data Berhasil Dihapus');
    }
}
