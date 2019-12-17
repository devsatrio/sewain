<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\models\websetting;
class homecontroller extends Controller
{
    public function index()
    {
    	$slider = DB::table('slider')->where('status','Aktif')->orderby('id','desc')->get();
    	$websetting = $websetting = websetting::first();
    	$kategori = DB::table('kategori')->where('status','Aktif')->orderby('id','desc')->get();
    	$artikel = DB::table('artikel')->select(DB::raw('artikel.*,users.username,kategori_artikel.nama as namakategori'))
        ->leftjoin('users','users.id','=','artikel.penulis')
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','artikel.id_kategori')
        ->orderby('artikel.id','desc')->first();
    	$barang = 
    	DB::table('barang')
    	->select(DB::raw('barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori'))
    	->leftjoin('kategori','kategori.id','=','barang.kategori')
    	->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->where('barang.status','Aktif')
    	->orderby('id','desc')
    	->get();
       	return view('home.index',['kategori'=>$kategori,'barang'=>$barang,'websetting'=>$websetting,'artikel'=>$artikel,'slider'=>$slider]);
    }
}
