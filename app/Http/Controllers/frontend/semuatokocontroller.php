<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class semuatokocontroller extends Controller
{
    public function index()
    {
        $websetting = DB::table('setting')->limit(1)->get();
        $kota = DB::table('kota')->where('aktif','Y')->orderby('id','desc')->get();
        $toko = 
        DB::table('toko')
        ->select(DB::raw('toko.*,provinsi.nama as namaprovinsi,kota.nama as namakota'))
        ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->where('toko.status','Aktif')
        ->orderby('toko.id','desc')
        ->get();
        return view('semuatoko.index',['websetting'=>$websetting,'toko'=>$toko,'kota'=>$kota]);
    }
}
