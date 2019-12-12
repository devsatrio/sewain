function validasiform() {
        if($('#pass').val()==$('#kpass').val()){
        	$('#submitbutton').attr('disabled',true);
           $('#submitbutton').html('Loading...');
        return true;
        }else{
            $('#grubkpass').addClass('has-error');
            $('#errorkpass').html('Maaf, Konfirmasi Password Salah');
            return false;
        }
    }