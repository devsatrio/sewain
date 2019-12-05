<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Image;
class akuncontroller extends Controller
{
    //====================================================================
    public function index()
    {
        if(Auth::guard('pengguna')->check()){
        $jumlahtoko = DB::table('toko')->where('id_pengguna',Auth::guard('pengguna')->user()->id)->count();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('akun.index',['websetting'=>$websetting,'jumlahtoko'=>$jumlahtoko]);
        }else{
            return view('error.user404');
        }
    }

    
    //====================================================================
    public function editpassword()
    {
        if(Auth::guard('pengguna')->check()){
            $websetting = DB::table('setting')->limit(1)->get();
            return view('akun.editpassword',['websetting'=>$websetting]);
        }else{
            return view('error.user404');
        }
    }

    //====================================================================
    public function updatepassword(Request $request, $kode)
    {
        $oldpass='';
        $id = Crypt::decrypt($kode);
        $data = DB::table('pengguna')->where('id',$id)->get();
        foreach ($data as $row) {
            $oldpass=$row->password;
        }
        if(Hash::check($request->oldpass, $oldpass)){
            DB::table('pengguna')
            ->where('id',$id)
            ->update([
                'password'=>Hash::make($request->newpass)
            ]);
            return redirect('detail-akun')
                    ->with('msg', 'Perubahan Password Berhasil Disimpan');
        }else{
            return back()->with('msg','Maaf, Password lama anda salah');
        }
    }

    //====================================================================
    public function edit()
    {
        if(Auth::guard('pengguna')->check()){
            $websetting = DB::table('setting')->limit(1)->get();
            return view('akun.edit',['websetting'=>$websetting]);
        }else{
            return view('error.user404');
        }
        
    }

    //====================================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        $namafoto = '';
        $namafotoktp = '';

            if ($request->hasFile('foto')) {
                File::delete('image/pengguna/' . $request->fotolama);
                File::delete('image/pengguna/thumbnail/' . $request->fotolama);
            
                $image = $request->file('foto');
                $input['imagename'] = rand() . '' . time() . '.' . $image->getClientOriginalExtension();
                
                $destinationPath = public_path('image/pengguna/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                
                $destinationPath = public_path('image/pengguna');
                $image->move($destinationPath, $input['imagename']);
                $namafoto = $input['imagename'];

                if ($request->hasFile('ktpfoto')) {
                    File::delete('image/ktp/' . $request->ktpfotolama);
                    File::delete('image/ktp/thumbnail/' . $request->ktpfotolama);

                    $imagektp = $request->file('ktpfoto');
                    $input['imagename'] = rand() . '' . time() . '.' . $imagektp->getClientOriginalExtension();

                    $destinationPathktp = public_path('image/ktp/thumbnail');
                    $imgktp = Image::make($imagektp->getRealPath());
                    $imgktp->resize(100, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPathktp . '/' . $input['imagename']);

                    $destinationPathktp = public_path('image/ktp');
                    $imagektp->move($destinationPathktp, $input['imagename']);
                    $namafotoktp = $input['imagename'];

                    DB::table('pengguna')
                    ->where('id',$id)
                    ->update([
                        'name' => $request->nama,
                        'username' => $request->usern,
                        'alamat' => $request->alamat,
                        'telp' => $request->telp,
                        'gender' => $request->gender,
                        'email' => $request->email,
                        'tgl_lahir' => $request->tgllahir,
                        'foto' => $namafoto,
                        'foto_ktp' => $namafotoktp
                    ]);
                    return redirect('detail-akun')
                    ->with('msg', 'Perubahan Data Berhasil Disimpan');

                } else {
                    DB::table('pengguna')
                    ->where('id',$id)
                    ->update([
                        'name' => $request->nama,
                        'username' => $request->usern,
                        'alamat' => $request->alamat,
                        'telp' => $request->telp,
                        'gender' => $request->gender,
                        'email' => $request->email,
                        'tgl_lahir' => $request->tgllahir,
                        'foto' => $namafoto
                    ]);
                    return redirect('detail-akun')
                    ->with('msg', 'Perubahan Data Berhasil Disimpan');
                }
            } else {
                if ($request->hasFile('ktpfoto')) {
                    File::delete('image/ktp/' . $request->ktpfotolama);
                    File::delete('image/ktp/thumbnail/' . $request->ktpfotolama);

                    $imagektp = $request->file('ktpfoto');
                    $input['imagename'] = rand() . '' . time() . '.' . $imagektp->getClientOriginalExtension();

                    $destinationPathktp = public_path('image/ktp/thumbnail');
                    $imgktp = Image::make($imagektp->getRealPath());
                    $imgktp->resize(100, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPathktp . '/' . $input['imagename']);

                    $destinationPathktp = public_path('image/ktp');
                    $imagektp->move($destinationPathktp, $input['imagename']);
                    $namafotoktp = $input['imagename'];

                    DB::table('pengguna')
                    ->where('id',$id)
                    ->update([
                        'name' => $request->nama,
                        'username' => $request->usern,
                        'alamat' => $request->alamat,
                        'telp' => $request->telp,
                        'gender' => $request->gender,
                        'email' => $request->email,
                        'tgl_lahir' => $request->tgllahir,
                        'foto_ktp' => $namafotoktp
                    ]);
                    return redirect('detail-akun')
                    ->with('msg', 'Perubahan Data Berhasil Disimpan');
                } else {
                    DB::table('pengguna')
                    ->where('id',$id)
                    ->update([
                        'name' => $request->nama,
                        'username' => $request->usern,
                        'alamat' => $request->alamat,
                        'telp' => $request->telp,
                        'gender' => $request->gender,
                        'email' => $request->email,
                        'tgl_lahir' => $request->tgllahir
                    ]);
                    return redirect('detail-akun')
                    ->with('msg', 'Perubahan Data Berhasil Disimpan');
                }
            }
        
    }
}
