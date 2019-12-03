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

    //===============================================================
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
    
    //===============================================================
    public static function setaksesbarang($akses){
        $aksesnya = array('view'=>0,'create'=>0,'delete'=>0,'edit'=>0,'status'=>0);
        foreach ($akses as $aks){
                if($aks->aksi=='View Data'){
                    $aksesnya['view'] = 1;
                }elseif($aks->aksi=='Tambah Data'){
                    $aksesnya['create'] =1;
                }elseif($aks->aksi=='Hapus Data'){
                    $aksesnya['delete'] =1;
                }elseif($aks->aksi=='Edit Data'){
                    $aksesnya['edit'] =1;
                }elseif($aks->aksi=='Update Status'){
                    $aksesnya['status'] =1;
                }
            }
        return $aksesnya;
    }

    //===============================================================
    public static function daftarakses($level){
        $data = DB::table('akses')
        ->select(DB::raw('akses.*,permission.modul'))
        ->leftjoin('permission','permission.id','=','akses.id_permission')
        ->where('akses.id_roles',$level)
        ->groupby('modul')
        ->get();
        $aksesnya = array('Admin'=>0,'Pengguna'=>0,'Kategori'=>0,'Sub Kategori'=>0,'Provinsi'=>0,'Kota'=>0,'Toko'=>0,'Barang'=>0,'Kategori Artikel'=>0,'Artikel'=>0,'Slider'=>0,'Setting'=>0);
        foreach ($data as $aks){
                if($aks->modul=='Admin'){
                    $aksesnya['Admin'] = 1;
                }elseif($aks->modul=='Pengguna'){
                    $aksesnya['Pengguna'] =1;
                }elseif($aks->modul=='Kategori'){
                    $aksesnya['Kategori'] =1;
                }elseif($aks->modul=='Sub Kategori'){
                    $aksesnya['Sub Kategori'] =1;
                }elseif($aks->modul=='Provinsi'){
                    $aksesnya['Provinsi'] =1;
                }elseif($aks->modul=='Kota'){
                    $aksesnya['Kota'] =1;
                }elseif($aks->modul=='Toko'){
                    $aksesnya['Toko'] =1;
                }elseif($aks->modul=='Barang'){
                    $aksesnya['Barang'] =1;
                }elseif($aks->modul=='Kategori Artikel'){
                    $aksesnya['Kategori Artikel'] =1;
                }elseif($aks->modul=='Artikel'){
                    $aksesnya['Artikel'] =1;
                }elseif($aks->modul=='Slider'){
                    $aksesnya['Slider'] =1;
                }elseif($aks->modul=='Setting'){
                    $aksesnya['Setting'] =1;
                }
            }
        return $aksesnya;
    }
}