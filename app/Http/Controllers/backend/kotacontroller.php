<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class kotacontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('kota')->get();
        $dataprovinsi = DB::table('provinsi')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('kota.index',['data'=>$data,'websetting'=>$websetting,'dataprovinsi'=>$dataprovinsi]);
    }

    //===============================================================
    public function store(Request $request)
    {
        DB::table('kota')
        ->insert([
            'id_provinsi'=>$request->provinsi,
            'nama'=>$request->nama
        ]);

        return redirect('kota')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('kota')
        ->where('id',$id)
        ->update([
            'nama'=>$request->nama
        ]);
        return redirect('kota')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('kota')->where('id',$id)->delete();
        return redirect('kota')->with('msg','Data Berhasil Dihapus');
    }
}
