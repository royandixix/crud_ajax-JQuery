// ambil elemen2 yang di elemen
var keyword = document.getElementById("keyword");
var tombolCari = document.getElementById("tombol-cari");
var container = document.getElementById("container");

// tombolCari.addEventListener('mouseover', function() {
//     alert("berhasil");
// });

// tambahkan event ktika keyword di tulis
keyword.addEventListener("keyup", function () {
  // console.log(keyword.value);

  // buat ajax nyah
  var xhr = new XMLHttpRequest();

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
    //   console.log(xhr.responseText);
        container.innerHTML = xhr.responseText;
    }
  };

  // eksekusi ajax nyah

  // Membuka permintaan GET ke file 'ajax/ajax.txt'
  xhr.open("GET", "ajax/ajax.php?keyword=" + encodeURIComponent(keyword.value), true);


  // Mengirim permintaan
  xhr.send();
});
