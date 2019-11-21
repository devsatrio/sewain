$(function () {
    CKEDITOR.replace('editor1')
  })
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
            $('#grubfoto').addClass('has-error');
            $('#errorfoto').html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
            $('#photo').val('');
         }else{
            $('#grubfoto').removeClass('has-error');
            $('#errorfoto').html('');
            
         }
     }
 });
$('#photodua').change(function(){
    var imageSizeArr = 0;
    var imageSize = document.getElementById('photodua');
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
            $('#grubfotodua').addClass('has-error');
            $('#errorfotodua').html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
            $('#photodua').val('');
         }else{
            $('#grubfotodua').removeClass('has-error');
            $('#errorfotodua').html('');
            
         }
     }
 });