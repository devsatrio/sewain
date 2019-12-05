function validasiform() {
        if($('#pass').val()==$('#kpass').val()){
        	$('#errorkpass').html('');
           
        return true;
        }else{
           $('#errorkpass').html('Maaf, Konfirmasi Password Salah');
            return false;
        }
    }