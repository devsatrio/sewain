function validasiform() {
        if($('#pass').val()==$('#kpass').val()){
        return true;
        }else{
            $('#grubkpass').addClass('has-error');
            $('#errorkpass').html('Maaf, Konfirmasi Password Salah');
            return false;
        }
    }