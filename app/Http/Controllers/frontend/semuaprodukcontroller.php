<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\m_semuaproduk;
use DB;

class semuaprodukcontroller extends Controller
{
    //===================================================================
    public function index()
    {
        $websetting = DB::table('setting')->limit(1)->first();
        $kategori = DB::table('kategori')->where('status','Aktif')->orderby('id','desc')->get();
        $kota = DB::table('kota')->where('aktif','Y')->orderby('id','desc')->get();
        $barang = 
        DB::table('barang')
        ->select(DB::raw('barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori'))
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->where('barang.status','Aktif')
        ->orderby('id','desc')
        ->paginate(12);
        return view('semuaproduk.index',['websetting'=>$websetting,'barang'=>$barang,'kategori'=>$kategori,'kota'=>$kota]);
    }

    //===================================================================
    public function kota($kota)
    {
       $websetting = DB::table('setting')->limit(1)->first();
        $barang = 
        DB::table('barang')
        ->select(DB::raw('toko.kota,kota.nama as namakota,barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori'))
        ->leftjoin('toko','toko.id','=','barang.id_toko')
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->where([['barang.status','Aktif'],['kota.nama',$kota]])
        ->orderby('id','desc')
        ->paginate(16);
        return view('semuaproduk.kota',['websetting'=>$websetting,'barang'=>$barang,'kota'=>$kota]);
    }

    //===================================================================
    public function kategori($kategori)
    {
        $websetting = DB::table('setting')->limit(1)->first();
        $barang = 
        DB::table('barang')
        ->select(DB::raw('barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori'))
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->where([['barang.status','Aktif'],['kategori.nama',$kategori]])
        ->orderby('id','desc')
        ->paginate(16);
        return view('semuaproduk.kategori',['websetting'=>$websetting,'barang'=>$barang,'kategori'=>$kategori]);
    }

   //===================================================================
    public function show($kode)
    {
        $databarang = DB::table('barang')
        ->select(DB::raw('barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori'))
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->where('kode',$kode)
        ->first();

        $detailbarang = DB::table('detail_barang')->where('kode_barang',$databarang->kode)->orderby('harga','asc')->get();
        $fotobrg = DB::table('fotobarang')->where('kode_barang',$databarang->kode)->get();
        $toko = DB::table('toko')->select(DB::raw('toko.*,provinsi.nama as namaprovinsi,kota.nama as namakota'))
        ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->where('toko.id',$databarang->id_toko)->first();
        $websetting = DB::table('setting')->limit(1)->first();
        return view('semuaproduk.show',['websetting'=>$websetting,'databarang'=>$databarang,'detailbarang'=>$detailbarang,'fotobrg'=>$fotobrg,'toko'=>$toko]);
    }

   //===================================================================
    public function diskon()
    {
       $databarang = DB::table('detail_barang')
       ->select(DB::raw('barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori'))
       ->leftjoin('barang','barang.kode','=','detail_barang.kode_barang')
       ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
       ->where([['detail_barang.diskon','>',0],['barang.status','Aktif']])
       ->groupby('detail_barang.kode_barang')
       ->paginate(16);
        $websetting = DB::table('setting')->limit(1)->first();
        return view('semuaproduk.diskon',['websetting'=>$websetting,'barang'=>$databarang]);
    }

   //===================================================================
    public function update(Request $request, $id)
    {
        //
    }

   //===================================================================
    public function destroy($id)
    {
        //
    }
}
