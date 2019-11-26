<?php
namespace App\Http\Controllers\backend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Image;
class slidercontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
        $data = DB::table('slider')->get();
        $websetting = DB::table('setting')->limit(1)->get();
        return view('slider.index',['data'=>$data,'websetting'=>$websetting]);
    }

    //===============================================================
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
     
        $destinationPath = public_path('image/slider/thumbnail');
        $img = Image::make($image->getRealPath());
        $img->resize(100,null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
   
        $destinationPath = public_path('image/slider');
        $image->move($destinationPath, $input['imagename']);

        DB::table('slider')
        ->insert([
            'header'=>$request->head,
            'deskripsi'=>$request->deskripsi,
            'status'=>$request->status,
            'nama'=>$input['imagename']
        ]); 
    }
        return redirect('slider')->with('msg','Data Berhasil Disimpan');
    }

    //===============================================================
    public function update(Request $request, $kode)
    {
        $id = Crypt::decrypt($kode);
        if ($request->hasFile('foto')) {
            File::delete('image/slider/'.$request->gambarlama);
            File::delete('image/slider/thumbnail/'.$request->gambarlama);
            $image = $request->file('foto');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
         
            $destinationPath = public_path('image/slider/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(100,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
       
            $destinationPath = public_path('image/slider');
            $image->move($destinationPath, $input['imagename']);

            DB::table('slider')
            ->where('id',$id)
            ->update([
                'header'=>$request->head,
                'deskripsi'=>$request->deskripsi,
                'status'=>$request->status,
                'nama'=>$input['imagename']
            ]);
        }else{
            DB::table('slider')
            ->where('id',$id)
            ->update([
                'header'=>$request->head,
                'deskripsi'=>$request->deskripsi,
                'status'=>$request->status
            ]); 
        }
        
        return redirect('slider')->with('msg','Perubahan Data Berhasil Disimpan');
    }

    //===============================================================
    public function destroy($kode)
    {
        $id = Crypt::decrypt($kode);
        $data = DB::table('slider')->where('id',$id)->get();
        foreach ($data as $row) {
             if($row->nama!=''){
                File::delete('image/slider/'.$row->nama);
                File::delete('image/slider/thumbnail/'.$row->nama);
             } 
        }
        DB::table('slider')->where('id',$id)->delete();
        return redirect('slider')->with('msg','Data Berhasil Dihapus');
    }
}
