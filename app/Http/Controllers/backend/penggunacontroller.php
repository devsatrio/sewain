<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Image;
class penggunacontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //===============================================================
    public function index()
    {
        $data =DB::table('pengguna')->paginate(40);
        return view('pengguna.index',['data'=>$data]);
    }

    //===============================================================
    public function create()
    {
        return view('pengguna.create');
    }

    //===============================================================
    public function store(Request $request)
    {
        $namafoto = '';
        $namafotoktp = '';
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $input['imagename'] = rand().''.time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('image/pengguna/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('image/pengguna');
            $image->move($destinationPath, $input['imagename']);
            $namafoto = $input['imagename'];

            if ($request->hasFile('ktpfoto')) {
                $imagektp = $request->file('ktpfoto');
                $input['imagename'] = rand().''.time().'.'.$imagektp->getClientOriginalExtension();

                $destinationPathktp = public_path('image/ktp/thumbnail');
                $imgktp = Image::make($imagektp->getRealPath());
                $imgktp->resize(100,null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathktp.'/'.$input['imagename']);
                
                $destinationPathktp = public_path('image/ktp');
                $imagektp->move($destinationPathktp, $input['imagename']);
                $namafotoktp = $input['imagename'];
            }else{
                $namafotoktp =NULL;
            }
        }else{
            $namafoto = NULL;
            if ($request->hasFile('ktpfoto')) {
                $imagektp = $request->file('ktpfoto');
                $input['imagename'] = rand().''.time().'.'.$imagektp->getClientOriginalExtension();
                $destinationPathktp = public_path('image/ktp/thumbnail');
                $imgktp = Image::make($imagektp->getRealPath());
                $imgktp->resize(100,null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathktp.'/'.$input['imagename']);
                $destinationPath = public_path('image/ktp');
                $image->move($destinationPath, $input['imagename']);
                $namafotoktp = $input['imagename'];
            }else{
               $namafotoktp =NULL; 
            }
        }

        DB::table('pengguna')
        ->insert([
            'name'=>$request->nama,
            'username'=>$request->usern,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
            'gender'=>$request->gender,
            'email'=>$request->email,
            'tgl_lahir'=>$request->tgllahir,
            'password'=>Hash::make($request->pass),
            'foto'=>$namafoto,
            'foto_ktp'=>$namafotoktp
        ]);
        return redirect('pengguna')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function show($id)
    {
        //
    }

    //===============================================================
    public function edit($id)
    {
        //
    }

    //===============================================================
    public function update(Request $request, $id)
    {
        $namafoto = '';
        $namafotoktp = '';
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $namakecil = strtolower($image->getClientOriginalExtension());
            $namaspasi=str_replace(' ', '-', $namakecil);
            $input['imagename'] = rand().''.time().''.$namaspasi;
            $destinationPath = public_path('image/pengguna/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
            $destinationPath = public_path('image/pengguna');
            $image->move($destinationPath, $input['imagename']);
            $namafoto = $input['imagename'];

            if ($request->hasFile('ktpfoto')) {
                $imagektp = $request->file('ktpfoto');
                $namakecilktp = strtolower($imagektp->getClientOriginalExtension());
                $namaspasiktp=str_replace(' ', '-', $namakecilktp);
                $finalname = rand().''.time().''.$namaspasiktp;
                $destinationPathktp = public_path('image/ktp/thumbnail');
                $imgktp = Image::make($imagektp->getRealPath());
                $imgktp->resize(100,null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathktp.'/'.$finalname);
                $destinationPath = public_path('image/ktp');
                $image->move($destinationPath, $finalname);
                $namafotoktp = $finalname;
            }else{
                $namafotoktp =NULL;
            }
        }else{
            $namafoto = NULL;
            if ($request->hasFile('ktpfoto')) {
                $imagektp = $request->file('ktpfoto');
                $namakecilktp = strtolower($imagektp->getClientOriginalExtension());
                $namaspasiktp=str_replace(' ', '-', $namakecilktp);
                $finalname = rand().''.time().''.$namaspasiktp;
                $destinationPathktp = public_path('image/ktp/thumbnail');
                $imgktp = Image::make($imagektp->getRealPath());
                $imgktp->resize(100,null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathktp.'/'.$finalname);
                $destinationPath = public_path('image/ktp');
                $image->move($destinationPath, $finalname);
                $namafotoktp = $finalname;
            }else{
               $namafotoktp =NULL; 
            }
        }
    }

    //===============================================================
    public function destroy($id)
    {
        //
    }
}
