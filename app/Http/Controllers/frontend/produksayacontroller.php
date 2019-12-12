<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Image;
class produksayacontroller extends Controller
{
    //==================================================================
    public function index()
    {
        if(Auth::guard('pengguna')->check()){
        $kodetoko='';
        $datatoko = DB::table('toko')->where('id_pengguna',Auth::guard('pengguna')->user()->id)->first();
        $kodetoko=$datatoko->id;
        $jumlahbarang = DB::table('barang')->where('id_toko',$kodetoko)->count();
        $databarang = DB::table('barang')->where('id_toko',$kodetoko)->orderby('id','desc')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('produksaya.index',['websetting'=>$websetting,'jumlahbarang'=>$jumlahbarang,'databarang'=>$databarang]);
        }else{
            return view('error.user404');
        }
    }

    //==================================================================
    public function create()
    {
        if(Auth::guard('pengguna')->check()){
                $kodeuser = sprintf("%03s",Auth::guard('pengguna')->user()->id);
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
        $kategori = DB::table('kategori')->where('status','Aktif')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('produksaya.create',['websetting'=>$websetting,'kategori'=>$kategori,'kode'=>$finalkode]);
        }else{
            return view('error.user404');
        }
    }

    //==================================================================
    public function carisubkategori($id){
        $data = DB::table('subkategori')
        ->where([['id_kategori',$id],['status','Aktif']])
        ->get();
        return response()->json($data);
    }

    //==================================================================
    public function store(Request $request)
    {
        $a=0;
        foreach ($request->namapaket as $pkt){
            $datapaket[] = [ 
                'kode_barang'=>$request->kode,
                'nama'=>$pkt,
                'durasi'=>$request->durasipaket[$a],
                'satuan'=>$request->satuanpaket[$a],
                'harga'=>$request->hargapaket[$a],
                'diskon'=>$request->diskonpaket[$a]
            ];
            $a++;
        }

        //----------------------------------------------------------
        if($request->hasFile('fotoutama')) {
            $image = $request->file('fotoutama');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/barang/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/barang');
            $image->move($destinationPath, $input['imagename']);

            $datafoto[] = [ 
                'kode_barang'=>$request->kode,
                'nama'=>$input['imagename'],
                'default'=>'Y'
            ];
        }

        //----------------------------------------------------------
        if($request->hasFile('foto')){
            foreach ($request->foto as $photos){
                $image = $photos;
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
                $destinationPath = public_path('image/barang/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(100,null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);
           
                $destinationPath = public_path('image/barang');
                $image->move($destinationPath, $input['imagename']);

                $datafoto[] = [ 
                    'kode_barang'=>$request->kode,
                    'nama'=>$input['imagename'],
                    'default'=>'N'
                ];
            }
        }
        //---------------------------------------------------------
        $kodetoko='';
        $datatoko = DB::table('toko')->where('id_pengguna',Auth::guard('pengguna')->user()->id)->first();
        $kodetoko=$datatoko->id;
        //----------------------------------------------------------
        DB::table('detail_barang')->insert($datapaket);
        DB::table('fotobarang')->insert($datafoto);
        DB::table('barang')
        ->insert([
            'id_toko'=>$kodetoko,
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'kategori'=>$request->kategori,
            'sub_kategori'=>$request->subkategori,
            'tgl_post'=>date('Y-m-d'),
            'deskripsi'=>$request->deskripsi,
            'jaminan'=>$request->jaminan
        ]);
        return redirect('produk-saya')->with('msg','Data Produk Berhasil Disimpan');
    }

    //==================================================================
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
        $websetting = DB::table('setting')->limit(1)->get();
        return view('produksaya.show',['websetting'=>$websetting,'databarang'=>$databarang,'detailbarang'=>$detailbarang,'fotobrg'=>$fotobrg,'toko'=>$toko]);
        
    }

    //==================================================================
    public function edit($kode)
    {
        if(Auth::guard('pengguna')->check()){
        $idkat ='';
        $websetting = DB::table('setting')->limit(1)->first();
        $databarang = DB::table('barang')->where('kode',$kode)->first();
        $idkat=$databarang->kategori;
        $datasubkategori = DB::table('subkategori')->where([['id_kategori',$idkat],['status','Aktif']])->get();
        $toko = DB::table('toko')->get();
        $kategori = DB::table('kategori')->where('status','Aktif')->get();
        $datadetail = DB::table('detail_barang')
        ->where('kode_barang',$kode)->get();
        $jumlahdetail = DB::table('detail_barang')
        ->where('kode_barang',$kode)->count();
        $datafoto = DB::table('fotobarang')->where('kode_barang',$kode)->get();
        $jumlahfoto = DB::table('fotobarang')->where('kode_barang',$kode)->count();
        return view('produksaya.edit',['websetting'=>$websetting,'kategori'=>$kategori,'toko'=>$toko,'databarang'=>$databarang,'datasubkategori'=>$datasubkategori,'datadetail'=>$datadetail,'datafoto'=>$datafoto,'jumlahfoto'=>$jumlahfoto,'jumlahdetail'=>$jumlahdetail]);
        }else{
            return view('error.user404');
        }
    }

    //==================================================================
    public function updatedetail(Request $request, $kode)
    {
        DB::table('barang')
        ->where('kode',$kode)
        ->update([
            'nama'=>$request->nama,
            'kategori'=>$request->kategori,
            'sub_kategori'=>$request->subkategori,
            'deskripsi'=>$request->deskripsi,
            'jaminan'=>$request->jaminan
        ]);
        return back()->with('msg','Data Produk Berhasil Diperbarui');
    }

    //==================================================================
    public function tambahharga(Request $request,$kode){
        DB::table('detail_barang')
        ->insert([
            'kode_barang'=>$kode,
            'nama'=>$request->namapaket,
            'durasi'=>$request->durasipaket,
            'satuan'=>$request->satuanpaket,
            'harga'=>$request->hargapaket,
            'diskon'=>$request->diskonpaket
        ]);
        return back()->with('msgdetail','Data Paket Produk Berhasil Disimpan'); 
    }

    //==================================================================
    public function ubahharga(Request $request){
       DB::table('detail_barang')
       ->where('id',$request->kodepaket)
        ->update([
            'nama'=>$request->namapaket,
            'durasi'=>$request->durasipaket,
            'satuan'=>$request->satuanpaket,
            'harga'=>$request->hargapaket,
            'diskon'=>$request->diskonpaket
        ]);
        return back()->with('msgdetail','Data Paket Produk Berhasil Diubah'); 
    }
    
    //==================================================================
    public function hapusharga(Request $request){
        DB::table('detail_barang')
        ->where('id',$request->kodepaket)
        ->delete();
        return back()->with('msgdetail','Data Paket Produk Berhasil Dihapus');
    }
    public function ubahfoto(Request $request){
        if($request->hasFile('photo')) {
            File::delete('image/barang/'.$request->oldfoto);
            File::delete('image/barang/thumbnail/'.$request->oldfoto);
            $image = $request->file('photo');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/barang/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/barang');
            $image->move($destinationPath, $input['imagename']);

        DB::table('fotobarang')
        ->where('id',$request->kode)
        ->update([
            'nama'=>$input['imagename'],
            'default'=>$request->status
        ]);
        }
        return back()->with('msgfoto','Foto Berhasil Diubah');
    }

    //==================================================================
    public function tambahfoto(Request $request,$kode){
        if($request->hasFile('photo')) {
            $image = $request->file('photo');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/barang/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/barang');
            $image->move($destinationPath, $input['imagename']);

        DB::table('fotobarang')
        ->insert([
            'kode_barang'=>$kode,
            'nama'=>$input['imagename'],
            'default'=>'N'
        ]);
        }
        return back()->with('msgfoto','Foto Berhasil Disimpan');

    }
    
    //==================================================================
    public function hapusfoto(Request $request){
        $datafoto = DB::table('fotobarang')->where('id',$request->kodefoto)->first();
        if($datafoto->nama !='' ){
            File::delete('image/barang/'.$datafoto->nama);
            File::delete('image/barang/thumbnail/'.$datafoto->nama);
        }
        DB::table('fotobarang')->where('id',$request->kodefoto)->delete();
        return back()->with('msgfoto','Foto Berhasil Dihapus');
    }
    
    //==================================================================
    public function destroy(Request $request)
    {
       $datafoto = DB::table('fotobarang')
            ->where('kode_barang',$request->kode)->get();
            
            foreach ($datafoto as $rowfoto){
                File::delete('image/barang/'.$rowfoto->nama);
                File::delete('image/barang/thumbnail/'.$rowfoto->nama);
            }
        
        
        DB::table('barang')->where('kode',$request->kode)->delete();
        DB::table('fotobarang')->where('kode_barang',$request->kode)->delete();
        DB::table('detail_barang')->where('kode_barang',$request->kode)->delete();
        return redirect('produk-saya')->with('msg','Data Barang Berhasil Dihapus');
    }
}
