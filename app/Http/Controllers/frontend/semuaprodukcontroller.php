<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
        ->get();
        return view('semuaproduk.index',['websetting'=>$websetting,'barang'=>$barang,'kategori'=>$kategori,'kota'=>$kota]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

   //===================================================================
    public function show($kode)
    {
        $databarang = DB::table('barang')
        ->select(DB::raw('barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori'))
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')->where('kode',$kode)->first();
        $detailbarang = DB::table('detail_barang')->where('kode_barang',$databarang->kode)->orderby('harga','asc')->get();
        $fotobrg = DB::table('fotobarang')->where('kode_barang',$databarang->kode)->get();
        $toko = DB::table('toko')->select(DB::raw('toko.*,provinsi.nama as namaprovinsi,kota.nama as namakota'))
        ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->where('toko.id',$databarang->id_toko)->first();
        $websetting = DB::table('setting')->limit(1)->first();
        return view('semuaproduk.show',['websetting'=>$websetting,'databarang'=>$databarang,'detailbarang'=>$detailbarang,'fotobrg'=>$fotobrg,'toko'=>$toko]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
