<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class rolescontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('roles')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('roles.index',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function store(Request $request)
    {
        DB::table('roles')
        ->insert([
            'nama'=>$request->nama
        ]);
        return redirect('roles')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('roles')
        ->where('id',$id)
        ->update([
            'nama'=>$request->nama
        ]);
        return redirect('roles')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('roles')->where('id',$id)->delete();
        return redirect('roles')->with('msg','Data Berhasil Dihapus');
    }
}
