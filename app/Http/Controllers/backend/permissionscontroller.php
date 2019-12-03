<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
class permissionscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $websetting = DB::table('setting')->limit(1)->get();
        if(Auth::user()->level=='1'){
        $data = DB::table('permission')->orderby('id','desc')->get();
        return view('permission.index',['data'=>$data,'websetting'=>$websetting]);
        }else{
            return view('error.404',['websetting'=>$websetting]);  
        }
    }

    //===============================================================
    public function store(Request $request)
    {
        $nama = '';
        if ($request->namalain!=''){
            $nama=$request->namalain;
        }else{
            $nama=$request->nama;
        }
        $jumlah = DB::table('permission')->where([['modul','=',$request->modul],['aksi','=',$nama]])->count();
        if ($jumlah>0) {
        return redirect('permission')->with('msgerror','Data Tidak Boleh Sama');
        }else{
            DB::table('permission')
            ->insert([
                'modul'=>$request->modul,
                'aksi'=>$nama
            ]);
        return redirect('permission')->with('msg','Data Berhasil Disimpan');
        }
        
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('permission')
        ->where('id',$id)
        ->update([
            'modul'=>$request->modul,
            'aksi'=>$request->nama,
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
