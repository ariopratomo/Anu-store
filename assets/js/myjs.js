$(document).ready(function () {
	/*place jQuery actions here*/
	var link = "/"; // Url to your application (including index.php/)

	$("products form").submit(function () {
		// Get the product ID and the quantity 
		var id = $(this).find('input[name=product_id]').val();
		var qty = $(this).find('input[name=qty]').val();

		alert('ID:' + id + '\n\rQTY:' + qty);

		return false; // Stop the browser of loading the page defined in the form "action" parameter.
	});

});

$(document).ready(function () {
	$("#anu").change(function () {
		var harga = parseInt($("#anua").val()) + 1;

		var harga1 = '<?= rupiah(' + harga + ') ?>'
		// var diskon = parseInt($("#discount").val());

		$("#tprices").val(harga1);
	});

});
// $("#anu").change(function () {
// 	var a = 1;

// 	$("#tprices").val(A);
// });


// Fungsi update keranjang


// Sweetalert 
const flashData = $('.flash-data').data('flashdata');
if (flashData == 'Password Salah') {
	Swal.fire({
		title: 'Oops...',
		type: 'warning',
		text: flashData + ' !',
		footer: '<a href="#">Lupa Password?</a>'
	})
}
if (flashData == 'Email Belum Diaktivasi') {
	Swal.fire({
		type: 'info',
		title: 'Oops...',
		text: flashData + ' !',
		footer: 'Silahkan cek email anda!'

	})
}
if (flashData == 'Email Belum Diaktivasi') {
	Swal.fire({
		type: 'info',
		title: 'Oops...',
		text: flashData + ' !',
		footer: 'Silahkan cek email anda!'

	})
}
if (flashData == 'Email Tidak Terdaftar') {
	Swal.fire({
		type: 'error',
		title: 'Oops...',
		text: flashData + ' !',
		footer: '<a href="signup">Daftar ?</a>'

	})
}
if (flashData == 'Anda Belum Login') {
	Swal.fire({
		type: 'info',
		title: 'Oops...',
		text: flashData + ' !'

	})
}
if (flashData == 'Dihapus') {
	Swal.fire({
		type: 'success',
		title: 'Berhasil ' + flashData,


	})
}
if (flashData == 'Anda berhasil keluar') {
	Swal.fire({
		type: 'success',
		title: flashData + '!',


	})
}
if (flashData == 'Keranjang berhasil di update') {
	Swal.fire({
		type: 'success',
		title: flashData + '!',


	})
}
if (flashData == 'Jumlah melebihi stock') {
	Swal.fire({
		type: 'info',
		title: 'Oops...',
		text: flashData + ' !'

	})
}
if (flashData == 'Berhasil Mendaftar') {
	Swal.fire({
		type: 'info',
		title: flashData,
		text: 'Silahkan login untuk mulai membeli produk !'

	})
}

function newFunction() {
	return (diskon / 100);
}
// test rajaongkir
