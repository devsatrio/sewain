<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Image;
class barangcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('barang')->paginate(40);
        $websetting = DB::table('setting')->limit(1)->get();
        return view('barang.index',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function create()
    {
        $kodeuser = sprintf("%02s",Auth::user()->id);
        $tgl = date('dmy');
        $finalkode ='';

        $kode = DB::table('barang')
        ->where('kode','like','%'.$tgl.'-'.$kodeuser.'%')
        ->max('kode');

        if($kode==''){
            $finalkode = "BRG".$tgl."-".$kodeuser."-0001";
        }else{
             $caridata = DB::table('barang')
            ->where('kode',$kode)->get();
            foreach ($caridata as $row) {
                $newkode    = explode("-", $kode);
                $nomer      = sprintf("%04s",$newkode[2]+1);
                $finalkode  = "BRG".$tgl."-".$kodeuser."-".$nomer; 
            }
           
        }
        $toko = DB::table('toko')->get();
        $kategori = DB::table('kategori')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('barang.create',['websetting'=>$websetting,'kategori'=>$kategori,'toko'=>$toko,'kode'=>$finalkode]);
    }

    //===============================================================
    public function store(Request $request)
    {
        //
    }

    //===============================================================
    public function show($id)
    {
        //
    }

    //===============================================================
    public function edit($id)
    {
        //
    }

    //===============================================================
    public function update(Request $request, $id)
    {
        //
    }

    //===============================================================
    public function destroy($id)
    {
        //
    }

    //===============================================================
    public function carisubkategori($id){
         $data = DB::table('subkategori')
        ->where('id_kategori',$id)
        ->get();
        return response()->json($data);
    }
}
