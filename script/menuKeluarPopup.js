document.getElementById("kategoriSelect").addEventListener("click", function() {
        document.getElementById("popup").style.display = "block";
    });
  
    var radioInputs = document.querySelectorAll("#popup-form input[type='radio']");
    for (var i = 0; i < radioInputs.length; i++) {
        radioInputs[i].addEventListener("change", function() {
        var selectedText = this.nextElementSibling.textContent;
        document.querySelector("#kategoriSelect p").textContent = selectedText;
        document.getElementById("popup").style.display = "none";
    });
}
  // Tunggu hingga halaman selesai dimuat
document.addEventListener("DOMContentLoaded", function() {
    // Ambil elemen-elemen yang diperlukan
    const kategoriSelect = document.getElementById("kategoriSelect");
    const popupKategori = document.getElementById("popup-kategori");
    const pilihKategori = kategoriSelect.querySelector("p");
    const hiddenIdInput = document.getElementById("hidden-id-input");

    // Tambahkan event listener saat elemen kategori diklik
    kategoriSelect.addEventListener("click", function() {
        // Tampilkan popup kategori
        popupKategori.style.display = "block";
    });

    // Tambahkan event listener untuk perubahan pada popup kategori
    popupKategori.addEventListener("change", function(event) {
        // Pastikan yang diubah adalah input radio
        if (event.target.tagName === "INPUT" && event.target.type === "radio") {
            // Ubah teks di dalam elemen <p> dengan teks kategori yang dipilih
            pilihKategori.textContent = event.target.nextElementSibling.textContent;
            // Atur nilai input hidden dengan nilai dari input radio yang dipilih
            hiddenIdInput.value = event.target.value;
            // Sembunyikan popup setelah memilih
            popupKategori.style.display = "none";
        }
    });
});
