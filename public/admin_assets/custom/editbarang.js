$('#toko').select2();
$('#kategori').select2();
$('#subkategori').select2({
	placeholder:'pilih kategori dahulu'
});

//====================================================================
$('#kategori').on('select2:select',function(e){
      $('#panelnya').loading('toggle');
      var id = $(this).val();
      $.ajax({
      type: 'GET',
      url: '/carisubkategori/'+id,
      success:function (data){
      addoption(data);
      },complete:function(){
                $('#panelnya').loading('stop');
            }
    });
});

//===================================================================
function addoption(data){
    $('#subkategori option').each(function() {
        $(this).remove();
    });
  var newOption ='';
  results : $.map(data, function (item){
    $('#subkategori')
         .append($("<option></option>")
                    .attr("value",item.id)
                    .text(item.nama)); 
    })
}
//===================================================================
  function imgToDatabarang(input) {
    $('#tempatfoto'+no).html('');
     var imageSiz = input.files[0].size;
     if (imageSiz > 3000000){
       		$('#fotoutama'+no).val('');
      		$('#grubfoto'+no).addClass('has-error');
            $('#errorfoto'+no).html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
     }else{
     		$('#grubfoto'+no).removeClass('has-error');
            $('#errorfoto'+no).html('');
        if (input.files) {
			var length = input.files.length;
	        $.each(input.files, function(i, v) {
	            var n = i + 1;
	            var File = new FileReader();
	            var datafoto ='';
	            File.onload = function(event) {
	              datafoto = datafoto + '<img src="'+event.target.result+'" width="30%">';
	              $('#tempatfoto'+no).append(datafoto);
	            };
				File.readAsDataURL(input.files[i]);
	        });
    	}
     }
    
  }
  window.imgToDatabarang = imgToDatabarang;

