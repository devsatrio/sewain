<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Image;

class penggunacontroller extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	//===============================================================
	public function index() {
        $websetting = DB::table('setting')->limit(1)->get();
		$data = DB::table('pengguna')->paginate(40);
		return view('pengguna.index', ['data' => $data,'websetting'=>$websetting]);
	}

	//===============================================================
	public function create() {
        $websetting = DB::table('setting')->limit(1)->get();
		return view('pengguna.create',['websetting'=>$websetting]);
	}

	//===============================================================
	public function store(Request $request) {
		$namafoto = '';
		$namafotoktp = '';
		if ($request->hasFile('foto')) {
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
			} else {
				$namafotoktp = NULL;
			}
		} else {
			$namafoto = NULL;
			if ($request->hasFile('ktpfoto')) {
				$imagektp = $request->file('ktpfoto');
				$input['imagename'] = rand() . '' . time() . '.' . $imagektp->getClientOriginalExtension();
				$destinationPathktp = public_path('image/ktp/thumbnail');
				$imgktp = Image::make($imagektp->getRealPath());
				$imgktp->resize(100, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destinationPathktp . '/' . $input['imagename']);
				$destinationPath = public_path('image/ktp');
				$image->move($destinationPath, $input['imagename']);
				$namafotoktp = $input['imagename'];
			} else {
				$namafotoktp = NULL;
			}
		}

		DB::table('pengguna')
			->insert([
				'name' => $request->nama,
				'username' => $request->usern,
				'alamat' => $request->alamat,
				'telp' => $request->telp,
				'gender' => $request->gender,
				'email' => $request->email,
				'tgl_lahir' => $request->tgllahir,
				'password' => Hash::make($request->pass),
				'foto' => $namafoto,
				'foto_ktp' => $namafotoktp,
			]);
		return redirect('pengguna')->with('msg', 'Data Berhasil Disimpan');
	}

	//===============================================================
	public function show($kode) {
        $websetting = DB::table('setting')->limit(1)->get();
		$id = Crypt::decrypt($kode);
        $data = DB::table('pengguna')->where('id', $id)->get();
        return view('pengguna.show', ['data' => $data,'websetting'=>$websetting]);
	}

	//===============================================================
	public function edit($kode) {
        $websetting = DB::table('setting')->limit(1)->get();
		$id = Crypt::decrypt($kode);
		$data = DB::table('pengguna')->where('id', $id)->get();
		return view('pengguna.edit', ['data' => $data,'websetting'=>$websetting]);
	}

	//===============================================================
	public function update(Request $request, $kode) {
		$id = Crypt::decrypt($kode);
        $namafoto = '';
		$namafotoktp = '';
		if ($request->pass != '') {

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
                        'password' => Hash::make($request->pass),
                        'foto' => $namafoto,
                        'foto_ktp' => $namafotoktp,
                    ]);
                    return redirect('pengguna')
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
                        'password' => Hash::make($request->pass),
                        'foto' => $namafoto,
                    ]);
                    return redirect('pengguna')
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
                        'password' => Hash::make($request->pass),
                        'foto_ktp' => $namafotoktp,
                    ]);
                    return redirect('pengguna')
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
                        'password' => Hash::make($request->pass),
                    ]);
                    return redirect('pengguna')
                    ->with('msg', 'Perubahan Data Berhasil Disimpan');
				}
			}
		} else {
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
                        'foto_ktp' => $namafotoktp,
                    ]);
                    return redirect('pengguna')
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
                        'foto' => $namafoto,
                    ]);
                    return redirect('pengguna')
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
                        'foto_ktp' => $namafotoktp,
                    ]);
                    return redirect('pengguna')
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
                    ]);
                    return redirect('pengguna')
                    ->with('msg', 'Perubahan Data Berhasil Disimpan');
                }
            }
		}

	}

	//===============================================================
	public function destroy($kode) {
		$id = Crypt::decrypt($kode);
		$data = DB::table('pengguna')->where('id', $id)->get();
		foreach ($data as $row) {
			if ($row->foto != '') {
				File::delete('image/pengguna/' . $row->foto);
				File::delete('image/pengguna/thumbnail/' . $row->foto);
			}
			if ($row->foto_ktp != '') {
				File::delete('image/ktp/' . $row->foto);
				File::delete('image/ktp/thumbnail/' . $row->foto);
			}
		}
		DB::table('pengguna')->where('id', $id)->delete();
		return redirect('pengguna')->with('msg', 'Data Berhasil Dihapus');
	}
    
    //===============================================================
    public function caridata(Request $request){
        $websetting = DB::table('setting')->limit(1)->get();
        $data = DB::table('pengguna')
        ->where('name','like','%'.$request->cari.'%')
        ->orwhere('username','like','%'.$request->cari.'%')
        ->get();
        return view('pengguna.cari',['data'=>$data,'datacari'=>$request->cari,'websetting'=>$websetting]);
    }
}
