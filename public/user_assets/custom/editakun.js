$('#photo').change(function(){
    var imageSizeArr = 0;
    var imageSize = document.getElementById('photo');
    var imageCount = imageSize.files.length;
    var jumlah = 0;
    for (var i = 0; i < imageSize.files.length; i++)
    {
        jumlah +=1;
         var imageSiz = imageSize.files[i].size;
         var imagename = imageSize.files[i].name;
         if (imageSiz > 3000000) {
             $('#test').text('3');
             var imageSizeArr = 1;
         }
         if (imageSizeArr == 1){
            $('#errorfoto').addClass('text-danger');
            $('#errorfoto').html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
            $('#photo').val('');
         }else{
            $('#errorfoto').removeClass('text-danger');
            $('#errorfoto').html('*Isi apabila ingin mengganti foto profile');
            
         }
     }
 });
$('#ktpphoto').change(function(){
    var imageSizeArr = 0;
    var imageSize = document.getElementById('ktpphoto');
    var imageCount = imageSize.files.length;
    var jumlah = 0;
    for (var i = 0; i < imageSize.files.length; i++)
    {
        jumlah +=1;
         var imageSiz = imageSize.files[i].size;
         var imagename = imageSize.files[i].name;
         if (imageSiz > 3000000) {
             $('#test').text('3');
             var imageSizeArr = 1;
         }
         if (imageSizeArr == 1){
            $('#errorktpfoto').addClass('text-danger');
            $('#errorktpfoto').html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
            $('#ktpphoto').val('');
         }else{
            $('#errorktpfoto').removeClass('text-danger');
            $('#errorktpfoto').html('*Isi apabila ingin mengganti');
            
         }
     }
 });