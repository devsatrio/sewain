<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class halamanlaincontroller extends Controller
{
    public function tipssewa()
    {
        $websetting = DB::table('setting')->limit(1)->get();
        return view('halamanlain.tipssewa',['websetting'=>$websetting]);
    }

    //================================================================
    public function artikel()
    {
        $websetting = DB::table('setting')->limit(1)->first();
        $kategori = DB::table('kategori_artikel')->get();
        $artikel = DB::table('artikel')
        ->select(DB::raw('artikel.*,users.username,kategori_artikel.nama as namakategori'))
        ->leftjoin('users','users.id','=','artikel.penulis')
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','artikel.id_kategori')
        ->orderby('artikel.id','desc')
        ->paginate(6);
        return view('halamanlain.artikel',['websetting'=>$websetting,'artikel'=>$artikel,'kategori'=>$kategori]);
    }

    //================================================================
    public function detailartikel($judul){
        $websetting = DB::table('setting')->limit(1)->first();
        $artikel = DB::table('artikel')
        ->select(DB::raw('artikel.*,users.username,kategori_artikel.nama as namakategori'))
        ->leftjoin('users','users.id','=','artikel.penulis')
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','artikel.id_kategori')
        ->where('artikel.link',$judul)
        ->first();
        return view('halamanlain.detail_artikel',['websetting'=>$websetting,'artikel'=>$artikel]);
    }

    //==================================================================
    public function kategoriartikel($kategori){
        $websetting = DB::table('setting')->limit(1)->first();
        $artikel = DB::table('artikel')
        ->select(DB::raw('artikel.*,users.username,kategori_artikel.nama as namakategori'))
        ->leftjoin('users','users.id','=','artikel.penulis')
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','artikel.id_kategori')
        ->where('kategori_artikel.nama',$kategori)
        ->orderby('artikel.id','desc')
        ->paginate(9);
        return view('halamanlain.kategori_artikel',['websetting'=>$websetting,'artikel'=>$artikel,'kategori'=>$kategori]);
    }
}
