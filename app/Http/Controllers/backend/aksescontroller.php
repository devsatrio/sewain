<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
class aksescontroller extends Controller
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
        return view('akses.index',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function create()
    {

    }

    //===============================================================
    public function store(Request $request)
    {
        $jumlah = DB::table('akses')->where([['id_roles','=',$request->roles],['id_permission','=',$request->permission]])->count();
        if($jumlah>0){
            return back()->with('msgerror','Maaf Data Sama');
        }else{
            DB::table('akses')
            ->insert([
                'id_roles'=>$request->roles,
                'id_permission'=>$request->permission
            ]);
            return back()->with('msg','Data Berhasil Disimpan'); 
        }
        
       
    }

    //===============================================================
    public function show($kode)
    {
        $id = Crypt::decrypt($kode);
        $dataroles = DB::table('roles')->where('id',$id)->get();
        $permission = DB::table('permission')->get();
        $datapermission = DB::table('akses')
        ->select(DB::raw('akses.*,roles.nama as namarole,permission.modul,permission.aksi'))
        ->leftjoin('roles','roles.id','=','akses.id_roles')
        ->leftjoin('permission','permission.id','=','akses.id_permission')
        ->where('id_roles',$id)
        ->orderby('akses.id','desc')
        ->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('akses.show',['permission'=>$permission,'data'=>$datapermission,'dataroles'=>$dataroles,'websetting'=>$websetting]);
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        DB::table('akses')->where('id',$id)->delete();
        return back()->with('msg','Data Berhasil Dihapus');
    }
}
