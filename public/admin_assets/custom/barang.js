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
  function imgToDatabarang(input,no) {
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

//===================================================================
var counter = 1; //variabel nomor inputan
var limit = 5; //fungsi tambah input
function addInput(divName){

 if (counter == limit)  {
    alert("Maaf maksimal hanya 5 paket");
 }else{
    var newdiv = document.createElement('div');
    newdiv.setAttribute('id','inputan'+counter);
    newdiv.innerHTML ='<hr style="border: 1px solid grey">'+
                            '<div class="form-group">'+
                            '<label for="inputEmail3" class="col-sm-2 control-label">Nama Paket</label>'+
                            '<div class="col-sm-10">'+
                                '<input type="text" class="form-control" name="namapaket[]" required>'+
                            '</div>'+
                        '</div>'+

                        '<div class="form-group">'+
                            '<label for="inputEmail3" class="col-sm-2 control-label">Durasi</label>'+
                            '<div class="col-sm-6">'+
                                '<input type="number" min="0" class="form-control" name="durasipaket[]" required>'+
                            '</div>'+
                            '<div class="col-sm-4">'+
                                '<select name="satuanpaket[]" class="form-control">'+
                                    '<option value="">Jam</option>'+
                                    '<option value="">Hari</option>'+
                                    '<option value="">Bulan</option>'+
                                    '<option value="">Tahun</option>'+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label for="inputEmail3" class="col-sm-2 control-label">Harga</label>'+
                            '<div class="col-sm-10">'+
                                '<input type="number" min="0" class="form-control" name="hargapaket[]" required>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label for="inputEmail3" class="col-sm-2 control-label">Diskon</label>'+
                            '<div class="col-sm-8">'+
                                '<input type="number" min="0" max="99" class="form-control" name="diskonpaket[]" required>'+
                            '</div>'+
                            '<div class="col-sm-2">'+
                                '<button type="button" onclick="del('+counter+')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Hapus Paket Ini</button>'+
                            '</div>'+
                        '</div>';

    document.getElementById(divName).appendChild(newdiv);
    counter++;
 }
}

//fungsi hapus input
function del(no) {
  document.getElementById('inputan'+no).remove();
  counter -= 1;
}

//===================================================================
var counterfoto = 1; //variabel nomor inputan
var kodefoto = 2;
var limitfoto = 4; //fungsi tambah input
function addInputfoto(divName){

 if (counterfoto == limitfoto)  {
    alert("Maaf maksimal hanya 3 foto");
 }else{
    var newdiv = document.createElement('div');
    newdiv.setAttribute('id','inputanfoto'+kodefoto);
    newdiv.innerHTML ='<hr style="border: 1px solid grey">'+
                            '<div class="form-group" id="grubfoto'+kodefoto+'">'+
                            '<label for="inputEmail3" class="col-sm-2 control-label">Foto Lain</label>'+
                            '<div class="col-sm-10">'+
                                '<div id="tempatfoto'+kodefoto+'"></div>'+
                                '<input type="file" id="foto'+kodefoto+'" class="form-control" onchange="imgToDatabarang(this,'+kodefoto+')" accept="image/*" name="foto[]" required>'+
                                '<span class="help-block" id="errorfoto'+kodefoto+'"></span>'+
                        		'<button type="button" onclick="delfoto('+kodefoto+')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Hapus Foto</button>'+
                            '</div>'+
                        '</div>';

    document.getElementById(divName).appendChild(newdiv);
    counterfoto++;
    kodefoto++;
 }
}

//fungsi hapus input
function delfoto(no) {
  document.getElementById('inputanfoto'+no).remove();
  counterfoto -= 1;
}