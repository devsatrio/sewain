<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
class admincontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('users')->get();
        return view('admin.index',['data'=>$data]);
    }

    //===============================================================
    public function create()
    {
        return view('admin.create');
    }

    //===============================================================
    public function store(Request $request)
    {
        DB::table('users')
        ->insert([
            'name'=>$request->nama,
            'username'=>$request->usern,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
            'level'=>$request->level,
            'email'=>$request->email,
            'password'=>Hash::make($request->pass)
        ]);

        return redirect('admin')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function edit($kode)
    {
        $id = Crypt::decrypt($kode);
        $data = DB::table('users')->where('id',$id)->get();
        return view('admin.edit',['data'=>$data]);
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        if($request->pass!=''){
            DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$request->nama,
                'username'=>$request->usern,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'level'=>$request->level,
                'email'=>$request->email,
                'password'=>Hash::make($request->pass)
            ]);
            return redirect('admin')->with('msg','Perubahan Data Berhasil Disimpan'); 
        }else{
            DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$request->nama,
                'username'=>$request->usern,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'level'=>$request->level,
                'email'=>$request->email,
            ]);
            return redirect('admin')->with('msg','Perubahan Data Berhasil Disimpan'); 
        }
    }

    //===============================================================
    public function destroy($kode)
    {
      $id = Crypt::decrypt($kode);
      DB::table('users')->where('id',$id)->delete();
      return redirect('admin')->with('msg','Data Berhasil Dihapus');
    }
}
