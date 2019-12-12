$('#provinsi').select2();
$('#kota').select2();

//====================================================================
$('#provinsi').on('select2:select',function(e){
      $('#panelnya').loading('toggle');
      var id = $(this).val();
      $.ajax({
      type: 'GET',
      url: '/carikotauser/'+id,
      success:function (data){
      addoption(data);
      },complete:function(){
                $('#panelnya').loading('stop');
            }
    });
});

//===================================================================
function addoption(data){
    $('#kota option').each(function() {
        $(this).remove();
    });
  var newOption ='';
  results : $.map(data, function (item){
    $('#kota')
         .append($("<option></option>")
                    .attr("value",item.id)
                    .text(item.nama)); 
    })
}

//====================================================================
function photouploaded(input){

     var imageSiz = input.files[0].size;
     if (imageSiz > 3000000){
            $('#errorfoto').html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
            $('#photo').val('');
            $('#tempatfoto').html('');
     }else{
            $('#tempatfoto').html('');
            $('#errorfoto').html('');
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

//====================================================================
function validasiform() {
         
           $('#panelnya').loading('toggle');
           $('#submitbutton').attr('disabled',true);
           $('#submitbutton').html('Loading...');
        return true;
        
    }