function photoktpuploaded(input){

     var imageSiz = input.files[0].size;
     if (imageSiz > 3000000){
            $('#errorktpfoto').addClass('text-danger');
            $('#errorktpfoto').html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
            $('#ktpphoto').val('');
            $('#tempatfotoktp').html('');
     }else{
            $('#tempatfotoktp').html('');
            $('#errorktpfoto').removeClass('text-danger');
            $('#errorktpfoto').html('*Isi apabila ingin mengganti foto KTP');
        if (input.files) {
            var length = input.files.length;
            $.each(input.files, function(i, v) {
                var n = i + 1;
                var File = new FileReader();
                var datafoto ='';
                File.onload = function(event) {
                  datafoto = datafoto + '<br><img src="'+event.target.result+'" width="30%"><br><br>';
                  $('#tempatfotoktp').append(datafoto);
                };
                File.readAsDataURL(input.files[i]);
            });
        }
     }
}
window.photoktpuploaded = photoktpuploaded;

function photouploaded(input){

     var imageSiz = input.files[0].size;
     if (imageSiz > 3000000){
            $('#errorfoto').addClass('text-danger');
            $('#errorfoto').html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
            $('#photo').val('');
            $('#tempatfoto').html('');
     }else{
            $('#tempatfoto').html('');
            $('#errorfoto').removeClass('text-danger');
            $('#errorfoto').html('*Isi apabila ingin mengganti foto profile');
        if (input.files) {
            var length = input.files.length;
            $.each(input.files, function(i, v) {
                var n = i + 1;
                var File = new FileReader();
                var datafoto ='';
                File.onload = function(event) {
                  datafoto = datafoto + '<br><img src="'+event.target.result+'" width="30%"><br><br>';
                  $('#tempatfoto').append(datafoto);
                };
                File.readAsDataURL(input.files[i]);
            });
        }
     }
}
window.photouploaded = photouploaded;
function checkform(form){
    $('#panelnya').loading('toggle');
    form.submitbutton.disabled = false;
    $('#submitbutton').html('Loading...');
    return true;
}