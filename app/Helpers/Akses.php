<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Akses {
    public static function cariakses($level,$halaman) {
    	$data = DB::table('akses')
    	->select(DB::raw('roles.nama,permission.modul,permission.aksi'))
    	->leftjoin('roles','roles.id','=','akses.id_roles')
    	->leftjoin('permission','permission.id','=','akses.id_permission')
    	->where([['akses.id_roles','=',$level],['permission.modul','=',$halaman]])
    	->get();
    	return $data;
    }
    public static function setakses($akses){
    	$aksesnya = array('view'=>0,'create'=>0,'delete'=>0,'edit'=>0);
    	foreach ($akses as $aks){
                if($aks->aksi=='View Data'){
                    $aksesnya['view'] = 1;
                }elseif($aks->aksi=='Tambah Data'){
                    $aksesnya['create'] =1;
                }elseif($aks->aksi=='Hapus Data'){
                    $aksesnya['delete'] =1;
                }elseif($aks->aksi=='Edit Data'){
                    $aksesnya['edit'] =1;
                }
    		}
    	return $aksesnya;
    }
}