<?php

namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Image;
class artikelcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('artikel')
        ->select(DB::raw('artikel.*,kategori_artikel.nama as namakategori,users.name as namauser'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','artikel.id_kategori')
        ->leftjoin('users','users.id','=','artikel.penulis')
        ->paginate(40);
        $websetting = DB::table('setting')->limit(1)->get();
        return view('artikel.index', ['data' => $data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function create()
    {
        $datakategori = DB::table('kategori_artikel')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('artikel.create', ['datakategori'=>$datakategori,'websetting'=>$websetting]);
    }

    //===============================================================
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
     
        $destinationPath = public_path('image/artikel/thumbnail');
        $img = Image::make($image->getRealPath());
        $img->resize(100,null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
   
        $destinationPath = public_path('image/artikel');
        $image->move($destinationPath, $input['imagename']);
        
        DB::table('artikel')
        ->insert([
            'id_kategori'=>$request->kategori,
            'judul'=>$request->judul,
            'isi'=>$request->isi,
            'penulis'=>Auth::user()->id,
            'tgl'=>date('Y-m-d'),
            'gambar'=>$input['imagename']
        ]);
        }
        return redirect('artikel')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function show($kode)
    {
        $id = Crypt::decrypt($kode);
        $data = DB::table('artikel')
        ->select(DB::raw('artikel.*,kategori_artikel.nama as namakategori,users.name as namauser'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','artikel.id_kategori')
        ->leftjoin('users','users.id','=','artikel.penulis')
        ->where('artikel.id',$id)
        ->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('artikel.show',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function edit($kode)
    {
        $id = Crypt::decrypt($kode);
        $datakategori = DB::table('kategori_artikel')->get();
        $data = DB::table('artikel')
        ->select(DB::raw('artikel.*,kategori_artikel.nama as namakategori,users.name as namauser'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','artikel.id_kategori')
        ->leftjoin('users','users.id','=','artikel.penulis')
        ->where('artikel.id',$id)
        ->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('artikel.edit',['datakategori'=>$datakategori,'data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        if ($request->hasFile('foto')) {
            File::delete('image/artikel/'.$request->gambarlama);
            File::delete('image/artikel/thumbnail/'.$request->gambarlama);

            $image = $request->file('foto');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/artikel/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/artikel');
            $image->move($destinationPath, $input['imagename']);
                        
            DB::table('artikel')
            ->where('id',$id)
            ->update([
                'id_kategori'=>$request->kategori,
                'judul'=>$request->judul,
                'isi'=>$request->isi,
                'gambar'=>$input['imagename']
            ]);
            return redirect('artikel')->with('msg','Perubahan Data Berhasil Disimpan');
        }else{
            DB::table('artikel')
            ->where('id',$id)
            ->update([
                'id_kategori'=>$request->kategori,
                'judul'=>$request->judul,
                'isi'=>$request->isi
            ]);
            return redirect('artikel')->with('msg','Perubahan Data Berhasil Disimpan');
        }

    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        $data = DB::table('artikel')->where('id',$id)->get();
        foreach ($data as $row) {
             if($row->gambar!=''){
                File::delete('image/artikel/'.$row->gambar);
                File::delete('image/artikel/thumbnail/'.$row->gambar);
             } 
          }
      DB::table('artikel')->where('id',$id)->delete();
      return redirect('artikel')->with('msg','Data Berhasil Dihapus');
    }

    public function caridata(Request $request){
        $data = DB::table('artikel')
        ->select(DB::raw('artikel.*,kategori_artikel.nama as namakategori,users.name as namauser'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','artikel.id_kategori')
        ->leftjoin('users','users.id','=','artikel.penulis')
        ->where('artikel.judul','like','%'.$request->cari.'%')
        ->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('artikel.cari',['cari'=>$request->cari,'data'=>$data,'websetting'=>$websetting]);
    }
}
