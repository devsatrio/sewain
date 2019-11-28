<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Akses {
    public static function coba($level,$halaman) {
    	$data = DB::table('akses')
    	->select(DB::raw('roles.nama,permission.modul,permission.aksi'))
    	->leftjoin('roles','roles.id','=','akses.id_roles')
    	->leftjoin('permission','permission.id','=','akses.id_permission')
    	->where([['akses.id_roles','=',$level],['permission.modul','=',$halaman]])
    	->get();
    	
        return $data;
    }
}