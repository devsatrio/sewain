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
$('.tomboledit').on('click', function(){
  $('#namapaket').val($(this).data('nama'));
  $('#durasipaket').val($(this).data('durasi'));
  $('#hargapaket').val($(this).data('harga'));
  $('#diskonpaket').val($(this).data('diskon'));
  $('#satuanpaket').val($(this).data('satuan'));
  $('#kodepaket').val($(this).data('kode'));
  $('#modal-ubahpaket').modal('toggle');
});

//===================================================================
$('.tombolhapus').on('click', function(){
  $('#kodepakethapus').val($(this).data('kode'));
  $('#modal-hapuspaket').modal('toggle');
});

//==================================================================
$('.tombolhapusfoto').on('click',function(){
  $('#kodefotohapus').val($(this).data('kode'));
  $('#modal-hapusfoto').modal('toggle');
});

//=================================================================
$('.tomboleditfoto').on('click',function(){
  $('#statusfoto').val($(this).data('status'));
  $('#kodeedit').val($(this).data('kode'));
  $('#oldfoto').val($(this).data('nama'));
  $('#tempateditfoto').html('<img src="../image/barang/thumbnail/'+$(this).data('nama')+'">')
  $('#modal-editfoto').modal('toggle');
});

//==================================================================
$('#modal-tambahfoto').on('hidden.bs.modal',function(){
  $('#errorfoto').html('');
  $('#photo').val('');
  $('#tempatfoto').html('');
});

//===================================================================
function imgphoto(input){
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

//===================================================================
function imgphotoedit(input){
  var imageSiz = input.files[0].size;
  if (imageSiz > 3000000){
            $('#errorfotoedit').html('Maaf, gambar terlalu besar / memiliki ukuran lebih dari 3MB');
            $('#photoedit').val('');
            $('#tempateditfoto').html('');
     }else{
            $('#tempateditfoto').html('');
            $('#errorfotoedit').html('');
        if (input.files) {
            var length = input.files.length;
            $.each(input.files, function(i, v) {
                var n = i + 1;
                var File = new FileReader();
                var datafoto ='';
                File.onload = function(event) {
                  datafoto = datafoto + '<br><img src="'+event.target.result+'" width="30%"><br><br>';
                  $('#tempateditfoto').append(datafoto);
                };
                File.readAsDataURL(input.files[i]);
            });
        }
     }
}

//=================================================================
function validtambahfoto(){
  if($('#photo').val()==''){
    $('#errorfoto').html('Maaf, gambar harus diisi');
    return false;
  }else{
    return true;
  }
}

//=================================================================
function valideditfoto(){
  if($('#photoedit').val()==''){
    $('#errorfotoedit').html('Maaf, gambar harus diisi');
    return false;
  }else{
    return true;
  }
}