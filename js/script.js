// hiolangkan tombol cari
$('#cari').hide();

// ambil element keyword
$('#keyword').on('keyup', function() {

  $('.loader').show();

  // panggil ajax
  $.get('ajax/cariData.php?keyword=' + $('#keyword').val(), function(data) {

    $('#container').html(data);
    $('.loader').hide();
    $('#jumlah').hide();

  });

});