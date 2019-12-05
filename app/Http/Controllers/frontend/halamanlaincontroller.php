<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class halamanlaincontroller extends Controller
{
    public function tipssewa()
    {
        $websetting = DB::table('setting')->limit(1)->get();
        return view('halamanlain.tipssewa',['websetting'=>$websetting]);
    }

    //================================================================
    public function artikel()
    {
        $websetting = DB::table('setting')->limit(1)->get();
        $artikel = DB::table('artikel')->orderby('id','desc')->get();
        return view('halamanlain.artikel',['websetting'=>$websetting,'artikel'=>$artikel]);
    }
}
