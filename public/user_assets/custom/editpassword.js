function validasiform() {
        if($('#pass').val()==$('#kpass').val()){
        	$('#errorkpass').html('');
           $('#panelnya').loading('toggle');
           $('#submitbutton').attr('disabled',true);
           $('#submitbutton').html('Loading...');
        return true;
        }else{
           $('#errorkpass').html('Maaf, Konfirmasi Password Salah');
            return false;
        }
    }