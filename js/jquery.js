$(document).ready(function () {
    // Sembunyikan tombol cari jika diperlukan
    $('#tombol-cari').hide();

    // Event saat kata kunci diketik
    $("#keyword").on("keyup", function () {
        // Tampilkan ikon loading
        $(".load").show();

        // Melakukan permintaan AJAX
        $.get("ajax/ajax.php", { keyword: $("#keyword").val() }, function (data) {
            $('#container').html(data); // Perbarui container dengan data baru
            $(".load").hide(); // Sembunyikan ikon loading setelah data dimuat



        }).fail(function () {
            $(".load").hide(); // Sembunyikan ikon loading jika terjadi kesalahan
            alert("Terjadi kesalahan saat mengambil data."); // Tampilkan pesan kesalahan


        });

        
    });

    
});
