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
        $kategori = DB::table('kategori')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('produksaya.create',['websetting'=>$websetting,'kategori'=>$kategori,'kode'=>$finalkode]);
        }else{
            return view('error.user404');
        }
    }

    //==================================================================
    public function carisubkategori($id){
        $data = DB::table('subkategori')
        ->where('id_kategori',$id)
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
        if(Auth::guard('pengguna')->check()){
        $databarang = DB::table('barang')->where('kode',$kode)->first();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('produksaya.show',['websetting'=>$websetting,'databarang'=>$databarang]);
        }else{
            return view('error.user404');
        }
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
