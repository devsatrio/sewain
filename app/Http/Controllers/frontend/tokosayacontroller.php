<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use Hash;
use Auth;
use DB;
use Image;
use File;
class tokosayacontroller extends Controller
{
    //=================================================================
    public function updatetoko(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        $hari = '';
        foreach ($request->haribuka as $hr){
            $hari = $hari.''.$hr.',';
        }

        $linktoko = strtolower($request->nama);
        $final_linktoko=str_replace(' ', '-', $linktoko);

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
                'nama'=>$request->nama,
                'link'=>$final_linktoko,
                'deskripsi'=>$request->deskripsi,
                'telp'=>$request->telp,
                'provinsi'=>$request->provinsi,
                'kota'=>$request->kota,
                'alamat'=>$request->alamat,
                'jam_buka'=>$request->jambuka,
                'jam_tutup'=>$request->jamtutup,
                'logo'=>$input['imagename'],
                'hari_buka'=>$hari,
            ]);
            return redirect('detail-akun')->with('msgtoko','Berhasil Mengedit Toko');
        }else{
            DB::table('toko')
            ->where('id',$id)
            ->update([
                'nama'=>$request->nama,
                'link'=>$final_linktoko,
                'deskripsi'=>$request->deskripsi,
                'telp'=>$request->telp,
                'provinsi'=>$request->provinsi,
                'kota'=>$request->kota,
                'alamat'=>$request->alamat,
                'jam_buka'=>$request->jambuka,
                'jam_tutup'=>$request->jamtutup,
                'hari_buka'=>$hari,
            ]);
            return redirect('detail-akun')->with('msgtoko','Berhasil Mengedit Toko');
        }
    }

    //=================================================================
    public function buattoko()
    {
        if(Auth::guard('pengguna')->check()){
        $websetting = DB::table('setting')->limit(1)->get();
        $dataprovinsi = DB::table('provinsi')->get();
        $datakota = DB::table('kota')->get();
        return view('tokosaya.create',['websetting'=>$websetting,'datakota'=>$datakota,'dataprovinsi'=>$dataprovinsi]);
        }else{
            return view('error.user404');
        }
    }

    //=================================================================
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

            $linktoko = strtolower($request->nama);
            $final_linktoko=str_replace(' ', '-', $linktoko);

            DB::table('toko')
            ->insert([
                'id_pengguna'=>Auth::guard('pengguna')->user()->id,
                'nama'=>$request->nama,
                'link'=>$final_linktoko,
                'deskripsi'=>$request->deskripsi,
                'provinsi'=>$request->provinsi,
                'kota'=>$request->kota,
                'telp'=>$request->telp,
                'alamat'=>$request->alamat,
                'jam_buka'=>$request->jambuka,
                'jam_tutup'=>$request->jamtutup,
                'logo'=>$input['imagename'],
                'hari_buka'=>$hari,
            ]);
            
        }
        return redirect('detail-akun')->with('msgtoko','Berhasil Membuat Toko');
    }

   //=================================================================
    public function caridatakota($id)
    {
        $data = DB::table('kota')
        ->where('id_provinsi',$id)
        ->get();
     return response()->json($data);
    }

    //=================================================================
    public function edittoko()
    {
        if(Auth::guard('pengguna')->check()){
        $kodeprovinsi ='';
        $websetting = DB::table('setting')->limit(1)->get();
        $data = DB::table('toko')->where('id_pengguna',Auth::guard('pengguna')->user()->id)->get();
        foreach ($data as $row){
        $kodeprovinsi=$row->provinsi;
        }
        $datapengguna = DB::table('pengguna')->get();
        $datakota = DB::table('kota')->where('id_provinsi',$kodeprovinsi)->get();
        $dataprovinsi = DB::table('provinsi')->get();
        return view('tokosaya.edit',['data'=>$data,'websetting'=>$websetting,'datapengguna'=>$datapengguna,'datakota'=>$datakota,'dataprovinsi'=>$dataprovinsi]);
        }else{
            return view('error.user404');
        }
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        //
    }

    //=================================================================
    public function destroy(Request $request)
    {
        $id = Crypt::decrypt($request->kode);
        $datatoko = DB::table('toko')->where('id',$id)->first();
        $databarang = DB::table('barang')->where('id_toko',$datatoko->id)->get();
        
        foreach ($databarang as $row) {
            $datafoto = DB::table('fotobarang')
            ->where('kode_barang',$row->kode)->get();
            
            foreach ($datafoto as $rowfoto){
                File::delete('image/barang/'.$rowfoto->nama);
                File::delete('image/barang/thumbnail/'.$rowfoto->nama);
            }

            DB::table('fotobarang')
            ->where('kode_barang',$row->kode)->delete();
            DB::table('detail_barang')
            ->where('kode_barang',$row->kode)->delete();
        }
        
        File::delete('image/toko/'.$datatoko->logo);
        File::delete('image/toko/thumbnail/'.$datatoko->logo);
        
        DB::table('barang')->where('id_toko',$id)->delete();
        DB::table('toko')->where('id',$id)->delete();
        return redirect('detail-akun')->with('msgtoko','Berhasil Menghapus Toko');
    }
}
