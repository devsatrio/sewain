$('#pemilik').select2();
$('#provinsi').select2();
$('#kota').select2();

//====================================================================
$('#provinsi').on('select2:select',function(e){
      $('#panelnya').loading('toggle');
      var id = $(this).val();
      $.ajax({
      type: 'GET',
      url: '/carikota/'+id,
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
$('.timepicker').timepicker({
	  showInputs: false,
});

//====================================================================
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