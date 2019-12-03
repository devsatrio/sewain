<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class homecontroller extends Controller
{
    public function index()
    {
    	$slider = DB::table('slider')->where('status','Aktif')->orderby('id','desc')->get();
    	$websetting = DB::table('setting')->limit(1)->get();
    	$kategori = DB::table('kategori')->where('status','Aktif')->orderby('id','desc')->get();
    	$artikel = DB::table('artikel')->orderby('id','desc')->limit(1)->get();
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
