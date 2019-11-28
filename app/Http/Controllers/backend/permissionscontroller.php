<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
class permissionscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('permission')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('permission.index',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function store(Request $request)
    {
        DB::table('permission')
        ->insert([
            'modul'=>$request->modul,
            'aksi'=>$request->nama
        ]);
        return redirect('permission')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('permission')
        ->where('id',$id)
        ->update([
            'modul'=>$request->modul,
            'aksi'=>$request->nama
        ]);
        return redirect('permission')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('permission')
        ->where('id',$id)
        ->delete();
        return redirect('permission')->with('msg','Data Berhasil Dihapus');
    }
}
