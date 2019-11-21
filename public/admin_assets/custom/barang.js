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


//====================================================

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
                                '<input type="text" class="form-control" name="namapaket[]">'+
                            '</div>'+
                        '</div>'+

                        '<div class="form-group">'+
                            '<label for="inputEmail3" class="col-sm-2 control-label">Durasi</label>'+
                            '<div class="col-sm-6">'+
                                '<input type="number" min="0" class="form-control" name="durasipaket[]">'+
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
                                '<input type="number" min="0" class="form-control" name="hargapaket[]">'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label for="inputEmail3" class="col-sm-2 control-label">Diskon</label>'+
                            '<div class="col-sm-8">'+
                                '<input type="number" min="0" max="99" class="form-control" name="diskonpaket[]">'+
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