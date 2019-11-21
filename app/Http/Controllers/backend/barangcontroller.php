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
                'harga'=>$request->hargapaket[$a],
                'diskon'=>$request->diskonpaket[$a]
            ];
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
}
