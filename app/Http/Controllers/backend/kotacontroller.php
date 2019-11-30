<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Aksespengguna;
class kotacontroller extends Controller
{
    private $halaman ='Kota';
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $akses = Aksespengguna::cariakses(Auth::user()->level,$this->halaman);
        $aksesnya = Aksespengguna::setakses($akses);
        $websetting = DB::table('setting')->limit(1)->get();
        if($aksesnya['view']>0){
            $data = DB::table('kota')->get();
            $dataprovinsi = DB::table('provinsi')->get();
            return view('kota.index',['data'=>$data,'websetting'=>$websetting,'dataprovinsi'=>$dataprovinsi,'aksescreate'=>$aksesnya['create'],'aksesdelete'=>$aksesnya['delete'],'aksesedit'=>$aksesnya['edit']]);
        }else{
            return view('error.404',['websetting'=>$websetting]);
        }
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
