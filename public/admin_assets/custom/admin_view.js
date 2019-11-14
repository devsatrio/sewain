$(function () {
$('#example1').DataTable()
$('.tampil-modal').on('click', function(){
	var nama = $(this).data('nama');
    var username = $(this).data('username');
    var telp = $(this).data('telp');
    var email = $(this).data('email');
    var alamat = $(this).data('alamat');
    var level = $(this).data('level');

    $('#tampil_nama').html(nama);
    $('#tampil_username').html(username);
    $('#tampil_telp').html('<a>No. Telp <span class="pull-right">'+telp+'</span></a>');
    $('#tampil_email').html('<a>Email <span class="pull-right badge bg-green">'+email+'</span></a>');
    $('#tampil_alamat').html('<a>Alamat <span class="pull-right">'+alamat+'</span></a>');
    $('#tampil_level').html('<a>Level <span class="pull-right badge bg-blue">'+level+'</span></a>');
	$('#modal-detail').modal('toggle');
})
})