<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Aksespengguna;
class subkategoricontroller extends Controller
{
    private $halaman ='Sub Kategori';
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
        $data = DB::table('subkategori')
        ->select(DB::raw('subkategori.*,kategori.nama as namakategori'))
        ->leftjoin('kategori','kategori.id','=','subkategori.id_kategori')
        ->get();
        $datakategori = DB::table('kategori')->get();
        return view('subkategori.index',['data'=>$data,'datakategori'=>$datakategori,'websetting'=>$websetting,'aksescreate'=>$aksesnya['create'],'aksesdelete'=>$aksesnya['delete'],'aksesedit'=>$aksesnya['edit']]);
        }else{
            return view('error.404',['websetting'=>$websetting]);
        }
    }

    //===============================================================
    public function store(Request $request)
    {
        DB::table('subkategori')
        ->insert([
            'nama'=>$request->nama,
            'id_kategori'=>$request->kategori,
            'status'=>$request->status
        ]);
        return redirect('sub-kategori')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('subkategori')
        ->where('id',$id)
        ->update([
            'id_kategori'=>$request->kategori,
            'nama'=>$request->nama,
            'status'=>$request->status
        ]);
        return redirect('sub-kategori')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('subkategori')->where('id',$id)->delete();
        return redirect('sub-kategori')->with('msg','Data Berhasil Dihapus');
    }
}
