
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(function() {
	$('.detail').click(function() {
		$('.modal-title').html("Detail Film");

		const id = $(this).data('id');

		$.ajax({
			url: 'detail.php',
			data: {
				id: id
			},
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				console.log(data);
				$('.card-img').attr('src', 'img/' + data.img);
				$('.card-title').html(data.judul);
				$('.sinopsis').html(data.sinopsis);
				$('.sutradara').html("<strong>Sutradara</strong> : " + data.sutradara);
				$('.pemain').html("<strong>Pemain Utama : </strong>" + data.pemain_utama);
				$('.harga').html("<strong>Harga</strong> : Rp " + numberWithCommas(data.harga));
				$('.tahun').html("<strong>Tahun</strong> : " + data.thn_terbit);
			}
		});
	});
});