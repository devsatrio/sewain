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
class tokosayacontroller extends Controller
{
    //=================================================================
    public function index()
    {
        
    }

    //=================================================================
    public function buattoko()
    {
        if(Auth::guard('pengguna')->check()){
        $websetting = DB::table('setting')->limit(1)->get();
        $dataprovinsi = DB::table('provinsi')->get();
        $datakota = DB::table('kota')->get();
        return view('tokosaya.create',['websetting'=>$websetting,'datakota'=>$datakota,'dataprovinsi'=>$dataprovinsi]);
        }else{
            return view('error.user404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
