<?php

namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Image;
class tokocontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('toko')
        ->select(DB::raw('toko.*,kota.nama as namakota,pengguna.name as namapengguna'))
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->leftjoin('pengguna','pengguna.id','=','toko.id_pengguna')
        ->paginate(40);
        $websetting = DB::table('setting')->limit(1)->get();
        return view('toko.index', ['data' => $data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function create()
    {
        $datapengguna = DB::table('pengguna')->get();
        $dataprovinsi = DB::table('provinsi')->get();
        $datakota = DB::table('kota')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('toko.create', ['websetting'=>$websetting,'datapengguna'=>$datapengguna,'datakota'=>$datakota,'dataprovinsi'=>$dataprovinsi]);
    }

    //===============================================================
    public function store(Request $request)
    {
        $hari = '';
        foreach ($request->haribuka as $hr){
            $hari = $hari.''.$hr.',';
        }
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/toko/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/toko');
            $image->move($destinationPath, $input['imagename']);

            DB::table('toko')
            ->insert([
                'id_pengguna'=>$request->pemilik,
                'nama'=>$request->nama,
                'deskripsi'=>$request->deskripsi,
                'provinsi'=>$request->provinsi,
                'kota'=>$request->kota,
                'alamat'=>$request->alamat,
                'status'=>$request->status,
                'verivikasi_status'=>$request->verivikasi,
                'deskripsi_status'=>$request->keterangan_status,
                'jam_buka'=>$request->jambuka,
                'jam_tutup'=>$request->jamtutup,
                'logo'=>$input['imagename'],
                'hari_buka'=>$hari,
            ]);
            return redirect('toko')->with('msg','Data Berhasil Disimpan');
        }else{

        }
    }

    //===============================================================
    public function show($kode)
    {
        $id = Crypt::decrypt($kode);
        $data = DB::table('toko')
        ->select(DB::raw('toko.*,provinsi.nama as namaprovinsi,kota.nama as namakota,pengguna.name as namapengguna'))
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->leftjoin('provinsi','provinsi.id','=','toko.provinsi')
        ->leftjoin('pengguna','pengguna.id','=','toko.id_pengguna')
        ->where('toko.id',$id)
        ->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('toko.show',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function edit($kode)
    {
        $id = Crypt::decrypt($kode);
        $kodeprovinsi ='';
        $data = DB::table('toko')->where('id',$id)->get();
        foreach ($data as $row) {
            $kodeprovinsi=$row->provinsi;
        }
        $datapengguna = DB::table('pengguna')->get();
        $datakota = DB::table('kota')->where('id_provinsi',$kodeprovinsi)->get();
        $dataprovinsi = DB::table('provinsi')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('toko.edit',['data'=>$data,'websetting'=>$websetting,'datapengguna'=>$datapengguna,'datakota'=>$datakota,'dataprovinsi'=>$dataprovinsi]);
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        $hari = '';
        foreach ($request->haribuka as $hr){
            $hari = $hari.''.$hr.',';
        }
        if ($request->hasFile('foto')) {
            File::delete('image/toko/'.$request->oldlogo);
            File::delete('image/toko/thumbnail/'.$request->oldlogo);

            $image = $request->file('foto');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/toko/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/toko');
            $image->move($destinationPath, $input['imagename']);
            
            DB::table('toko')
            ->where('id',$id)
            ->update([
                'id_pengguna'=>$request->pemilik,
                'nama'=>$request->nama,
                'deskripsi'=>$request->deskripsi,
                'provinsi'=>$request->provinsi,
                'kota'=>$request->kota,
                'alamat'=>$request->alamat,
                'status'=>$request->status,
                'verivikasi_status'=>$request->verivikasi,
                'deskripsi_status'=>$request->keterangan_status,
                'jam_buka'=>$request->jambuka,
                'jam_tutup'=>$request->jamtutup,
                'logo'=>$input['imagename'],
                'hari_buka'=>$hari,
            ]);
            return redirect('toko')->with('msg','Perubahan Data Berhasil Disimpan');
        }else{
            DB::table('toko')
            ->where('id',$id)
            ->update([
                'id_pengguna'=>$request->pemilik,
                'nama'=>$request->nama,
                'deskripsi'=>$request->deskripsi,
                'provinsi'=>$request->provinsi,
                'kota'=>$request->kota,
                'alamat'=>$request->alamat,
                'status'=>$request->status,
                'verivikasi_status'=>$request->verivikasi,
                'deskripsi_status'=>$request->keterangan_status,
                'jam_buka'=>$request->jambuka,
                'jam_tutup'=>$request->jamtutup,
                'hari_buka'=>$hari,
            ]);
            return redirect('toko')->with('msg','Perubahan Data Berhasil Disimpan');
        }
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        $data = DB::table('toko')->where('id',$id)->get();
        foreach ($data as $row) {
             if($row->logo!=''){
                File::delete('image/toko/'.$row->logo);
                File::delete('image/toko/thumbnail/'.$row->logo);
             } 
          }
      DB::table('toko')->where('id',$id)->delete();
      return redirect('toko')->with('msg','Data Berhasil Dihapus');
    }

    //===============================================================
    public function caridata(Request $request){
        $websetting = DB::table('setting')->limit(1)->get();

        $data = DB::table('toko')
        ->select(DB::raw('toko.*,kota.nama as namakota,pengguna.name as namapengguna'))
        ->leftjoin('kota','kota.id','=','toko.kota')
        ->leftjoin('pengguna','pengguna.id','=','toko.id_pengguna')
        ->where('toko.nama','like','%'.$request->cari.'%')
        ->get();
        return view('toko.cari',['data'=>$data,'datacari'=>$request->cari,'websetting'=>$websetting]);
    }

    //===================================================================
    public function caridatakota($id){
        $data = DB::table('kota')
        ->where('id_provinsi',$id)
        ->get();
     return response()->json($data);
    }
}
