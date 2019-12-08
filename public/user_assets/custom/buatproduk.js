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
      url: '/carisubkategoriuser/'+id,
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
var counter = 1; //variabel nomor inputan
var limit = 5; //fungsi tambah input
function addInput(divName){

 if (counter == limit)  {
    alert("Maaf maksimal hanya 5 paket");
 }else{
    var newdiv = document.createElement('div');
    newdiv.setAttribute('id','inputan'+counter);
    newdiv.innerHTML ='<br><hr>'+
                            '<div class="form-group">'+
                            '<label for="inputEmail3">Nama Paket</label>'+
                                '<input type="text" class="form-control" name="namapaket[]" required>'+
                        '</div>'+

                        '<div class="form-group row">'+
                                        '<div class="col-md-6">'+
                                            '<label for="c_fname" class="text-black">Durasi</label>'+
                                            '<input type="number" min="0" class="form-control" name="durasipaket[]" required>'+
                                        '</div>'+
                                        '<div class="col-md-6">'+
                                            '<label for="c_lname" class="text-black">Satuan</label>'+
                                            '<select name="satuanpaket[]" class="form-control">'+
                                                '<option value="Jam">Jam</option>'+
                                                '<option value="Hari">Hari</option>'+
                                                '<option value="Bulan">Bulan</option>'+
                                                '<option value="Tahun">Tahun</option>'+
                                            '</select>'+
                                        '</div>'+
                                    '</div>'+
                        '<div class="form-group">'+
                            '<label for="inputEmail3">Harga</label>'+
                            '<input type="number" min="0" class="form-control" name="hargapaket[]" required>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label for="inputEmail3">Diskon</label>'+
                                '<input type="number" min="0" max="99" class="form-control" name="diskonpaket[]" required>'+
                                '<br><button type="button" onclick="del('+counter+')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Hapus Paket Ini</button>'+
                        '</div>';

    document.getElementById(divName).appendChild(newdiv);
    counter++;
 }
}

//fungsi hapus input
function del(no) {
  document.getElementById('inputan'+no).remove();
  counter -= 1;
}//===================================================================
  function imgToDatabarang(input,no) {
    $('#tempatfoto'+no).html('');
     var imageSiz = input.files[0].size;
     if (imageSiz > 3000000){
       		$('#fotoutama'+no).val('');
            $('#errorfoto'+no).html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
     }else{
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
var counterfoto = 1; //variabel nomor inputan
var kodefoto = 2;
var limitfoto = 4; //fungsi tambah input
function addInputfoto(divName){

 if (counterfoto == limitfoto)  {
    alert("Maaf maksimal hanya 3 foto");
 }else{
    var newdiv = document.createElement('div');
    newdiv.setAttribute('id','inputanfoto'+kodefoto);
    newdiv.innerHTML ='<hr>'+
                            '<div class="form-group">'+
                            '<label for="inputEmail3">Foto Lain</label>'+
                            '<div id="tempatfoto'+kodefoto+'"></div>'+
                                '<input type="file" id="foto'+kodefoto+'" class="form-control" onchange="imgToDatabarang(this,'+kodefoto+')" accept="image/*" name="foto[]" required>'+
                                '<span class="help-block text-danger" id="errorfoto'+kodefoto+'"></span>'+
                        		'<br><button type="button" onclick="delfoto('+kodefoto+')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Hapus Foto</button>'+
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

function validasiform() {
         
           $('#panelnya').loading('toggle');
           $('#submitbutton').attr('disabled',true);
           $('#submitbutton').html('Loading...');
        return true;
        
    }