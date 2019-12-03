<?php

namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Aksespengguna;
use Image;
class settingcontroller extends Controller
{
    private $halaman ='Setting';
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
        if($aksesnya['edit']>0){
            $data = DB::table('setting')
            ->orderby('id','desc')
            ->limit(1)
            ->get();
            return view('setting.index',['data'=>$data,'websetting'=>$websetting]);
        }else{
           return view('error.404',['websetting'=>$websetting]); 
        }
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        $namalogo = '';
        $namaicon = '';
        if ($request->hasFile('logo')){
                File::delete('image/setting/' . $request->logolama);
                File::delete('image/setting/thumbnail/' . $request->logolama);
            
                $image = $request->file('logo');
                $input['imagename'] = rand() . '' . time() . '.' . $image->getClientOriginalExtension();
                
                $destinationPath = public_path('image/setting/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                
                $destinationPath = public_path('image/setting');
                $image->move($destinationPath, $input['imagename']);
                $namalogo = $input['imagename'];

            if ($request->hasFile('icon')){
                File::delete('image/setting/' . $request->iconlama);
                File::delete('image/setting/thumbnail/' . $request->iconlama);
            
                $image = $request->file('icon');
                $input['imagename'] = rand() . '' . time() . '.' . $image->getClientOriginalExtension();
                
                $destinationPath = public_path('image/setting/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                
                $destinationPath = public_path('image/setting');
                $image->move($destinationPath, $input['imagename']);
                $namaicon = $input['imagename'];

                DB::table('setting')
                ->where('id',$id)
                ->update([
                    'nama'=>$request->nama,
                    'singkatan'=>$request->singkatan,
                    'logo'=>$namalogo,
                    'icon'=>$namaicon,
                    'deskripsi'=>$request->deskripsi
                ]);
                return redirect('setting')->with('msg','Perubahan Data Berhasil Disimpan');
            }else{
                DB::table('setting')
                ->where('id',$id)
                ->update([
                    'nama'=>$request->nama,
                    'singkatan'=>$request->singkatan,
                    'logo'=>$namalogo,
                    'deskripsi'=>$request->deskripsi
                ]);
                return redirect('setting')->with('msg','Perubahan Data Berhasil Disimpan');
            }
        }else{
            if ($request->hasFile('icon')){
                File::delete('image/setting/' . $request->iconlama);
                File::delete('image/setting/thumbnail/' . $request->iconlama);
            
                $image = $request->file('icon');
                $input['imagename'] = rand() . '' . time() . '.' . $image->getClientOriginalExtension();
                
                $destinationPath = public_path('image/setting/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                
                $destinationPath = public_path('image/setting');
                $image->move($destinationPath, $input['imagename']);
                $namaicon = $input['imagename'];

                DB::table('setting')
                ->where('id',$id)
                ->update([
                    'nama'=>$request->nama,
                    'singkatan'=>$request->singkatan,
                    'icon'=>$namaicon,
                    'deskripsi'=>$request->deskripsi
                ]);
                return redirect('setting')->with('msg','Perubahan Data Berhasil Disimpan');
            }else{
                DB::table('setting')
                ->where('id',$id)
                ->update([
                    'nama'=>$request->nama,
                    'singkatan'=>$request->singkatan,
                    'deskripsi'=>$request->deskripsi
                ]);
                return redirect('setting')->with('msg','Perubahan Data Berhasil Disimpan');
            }
        }
    }
}
