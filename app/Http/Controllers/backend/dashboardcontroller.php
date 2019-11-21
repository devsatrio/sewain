<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class dashboardcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================
    public function index()
    {
    	$websetting = DB::table('setting')->limit(1)->get();
        return view('dashboard.index',['websetting'=>$websetting]);
    }
}
