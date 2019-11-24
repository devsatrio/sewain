<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
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
        $data = DB::table('barang')
        ->select(DB::raw('barang.*,kategori.nama as namakategori, subkategori.nama as namasubkategori,toko.nama as namatoko'))
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->leftjoin('toko','toko.id','=','barang.id_toko')
        ->paginate(40);
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

        //----------------------------------------------------------
        DB::table('detail_barang')->insert($datapaket);
        DB::table('fotobarang')->insert($datafoto);
        DB::table('barang')
        ->insert([
            'id_toko'=>$request->toko,
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'kategori'=>$request->kategori,
            'sub_kategori'=>$request->subkategori,
            'tgl_post'=>date('Y-m-d'),
            'deskripsi'=>$request->deskripsi,
            'jaminan'=>$request->jaminan
        ]);
        return redirect('barang')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function show($kode)
    {
        $data = DB::table('barang')
        ->select(DB::raw('barang.*,kategori.nama as namakategori,subkategori.nama as namasubkategori,toko.nama as namatoko'))
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->leftjoin('toko','toko.id','=','barang.id_toko')
        ->where('barang.kode',$kode)
        ->get();
        $datadetail = DB::table('detail_barang')->where('kode_barang',$kode)->get();
        $datafoto = DB::table('fotobarang')->where('kode_barang',$kode)->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('barang.show',['datadetail'=>$datadetail,'datafoto'=>$datafoto,'data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function edit($kode)
    {
        $idkat ='';
        $databarang = DB::table('barang')->where('kode',$kode)->get();
        foreach ($databarang as $dbarang) {
         $idkat=$dbarang->kategori;
        }
        $datasubkategori = DB::table('subkategori')->where('id_kategori',$idkat)->get();
        $toko = DB::table('toko')->get();
        $kategori = DB::table('kategori')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        $datadetail = DB::table('detail_barang')->where('kode_barang',$kode)->get();
        $datafoto = DB::table('fotobarang')->where('kode_barang',$kode)->get();
        return view('barang.edit',['websetting'=>$websetting,'kategori'=>$kategori,'toko'=>$toko,'databarang'=>$databarang,'datasubkategori'=>$datasubkategori,'datadetail'=>$datadetail,'datafoto'=>$datafoto]);
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        DB::table('barang')
        ->where('kode',$kode)
        ->update([
            'id_toko'=>$request->toko,
            'nama'=>$request->nama,
            'kategori'=>$request->kategori,
            'sub_kategori'=>$request->subkategori,
            'deskripsi'=>$request->deskripsi,
            'jaminan'=>$request->jaminan
        ]);
        return back()->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        $kodebarang ='';
        $data = DB::table('barang')->where('id',$id)->get();

        foreach ($data as $row){
            $kodebarang = $row->kode;
            $datafoto = DB::table('fotobarang')
            ->where('kode_barang',$kodebarang)->get();
            
            foreach ($datafoto as $rowfoto){
                File::delete('image/barang/'.$rowfoto->nama);
                File::delete('image/barang/thumbnail/'.$rowfoto->nama);
            }
        }
        
        DB::table('barang')->where('id',$id)->delete();
        DB::table('fotobarang')->where('kode_barang',$kodebarang)->delete();
        DB::table('detail_barang')->where('kode_barang',$kodebarang)->delete();
        return redirect('barang')->with('msg','Data Berhasil Dihapus');
    }

    //===============================================================
    public function carisubkategori($id){
         $data = DB::table('subkategori')
        ->where('id_kategori',$id)
        ->get();
        return response()->json($data);
    }

    //================================================================
    public function caridata(Request $request){
        $data = DB::table('barang')
        ->select(DB::raw('barang.*,kategori.nama as namakategori, subkategori.nama as namasubkategori,toko.nama as namatoko'))
        ->leftjoin('kategori','kategori.id','=','barang.kategori')
        ->leftjoin('subkategori','subkategori.id','=','barang.sub_kategori')
        ->leftjoin('toko','toko.id','=','barang.id_toko')
        ->where('barang.nama','like','%'.$request->cari.'%')
        ->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('barang.cari',['data'=>$data,'websetting'=>$websetting,'datacari'=>$request->cari]);
    }

    //================================================================
    public function updatedetail(Request $request){
        DB::table('detail_barang')
        ->where('id',$request->kodeb)
        ->update([
            'nama'=>$request->nama,
            'durasi'=>$request->durasi,
            'satuan'=>$request->satuanpaket,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon
        ]);

        return back()->with('status','Data Berhasil Di Update');
    }

    //================================================================
    public function destroydetail($kode){
        $id = Crypt::decrypt($kode);
        DB::table('detail_barang')->where('id',$id)->delete();
        return back()->with('msg','Data Berhasil Dihapus');
    }

    //================================================================
    public function updatedetailfoto(Request $request){
        if ($request->hasFile('foto')) {
        $image = $request->file('foto');
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
            'kode_barang'=>$request->kodeb,
            'nama'=>$input['imagename']
        ]); }
        return back()->with('msgfoto','Foto Berhasil Disimpan');
    }
}
