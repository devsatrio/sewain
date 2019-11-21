<?php

namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class provinsicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('provinsi')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('provinsi.index',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function store(Request $request)
    {
        DB::table('provinsi')
        ->insert([
            'nama'=>$request->nama
        ]);

        return redirect('provinsi')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('provinsi')
        ->where('id',$id)
        ->update([
            'nama'=>$request->nama
        ]);
        return redirect('provinsi')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('provinsi')->where('id',$id)->delete();
        return redirect('provinsi')->with('msg','Data Berhasil Dihapus');
    }
}