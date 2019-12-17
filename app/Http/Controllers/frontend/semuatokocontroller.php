<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\models\websetting;
use App\models\toko;
use App\models\kota;
use App\Http\Controllers\Controller;
use DB;
class semuatokocontroller extends Controller
{
    public function index()
    {
        $websetting = websetting::first();
        
        $kota = kota::where('aktif','Y')
        ->orderby('id','desc')
        ->get();

        $toko = 
        toko::select(DB::raw('toko.*,provinsi.nama as namaprovinsi,kota.nama as namakota'))
        ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->where('toko.status','Aktif')
        ->orderby('toko.id','desc')
        ->paginate(12);
        return view('semuatoko.index',['websetting'=>$websetting,'toko'=>$toko,'kota'=>$kota]);
    }

    //========================================================================
    public function show($toko)
    {
        $websetting = websetting::first();
        $toko = 
        toko::select(DB::raw('toko.*,provinsi.nama as namaprovinsi,kota.nama as namakota'))
        ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->where([['toko.status','Aktif'],['toko.link',$toko]])
        ->first();
        $barang = 
        DB::table('barang')
        ->select(DB::raw('barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori'))
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->where([['barang.status','Aktif'],['barang.id_toko',$toko->id]])
        ->orderby('id','desc')
        ->paginate(6);
        return view('semuatoko.show',['websetting'=>$websetting,'toko'=>$toko,'barang'=>$barang]);
    }

    //========================================================================
    public function kota($kota){
        $websetting = websetting::first();
        
        $toko = 
        toko::select(DB::raw('toko.*,provinsi.nama as namaprovinsi,kota.nama as namakota'))
        ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->where([['toko.status','Aktif'],['kota.nama',$kota]])
        ->orderby('toko.id','desc')
        ->paginate(12);
        return view('semuatoko.kota',['websetting'=>$websetting,'toko'=>$toko,'kota'=>$kota]);
    }

    public function terverikasi(){
        $websetting = websetting::first();
        
        $toko = 
        toko::select(DB::raw('toko.*,provinsi.nama as namaprovinsi,kota.nama as namakota'))
        ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->where([['toko.status','Aktif'],['toko.verivikasi_status','Ya']])
        ->orderby('toko.id','desc')
        ->paginate(12);
        return view('semuatoko.terverivikasi',['websetting'=>$websetting,'toko'=>$toko]);
    }
}
