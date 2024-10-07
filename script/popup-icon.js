// Inisialisasi variabel yang dibutuhkan
const iconContainer = document.getElementById("colorPreview");
const popup = document.getElementById("icon-popup");
const iconForm = document.getElementById("icon-form");
const iconRadios = document.querySelectorAll(".icon-radio");
const selectedIcon = document.querySelector(".selected-icon");
const hiddenInput = document.getElementById("hidden-icon-input");

    // Munculkan popup menu ketika tombol diklik
    iconContainer.addEventListener("click", () => {
        popup.classList.toggle("show");
    });

    // Proses interaksi
    iconRadios.forEach((radio) => {
        radio.addEventListener("change", () => { 
            const selectedValue = iconForm.querySelector('input[name="icon"]:checked').value;

            // Ganti ikon dengan class yang dipilih
            selectedIcon.className = `selected-icon ${selectedValue}`;

            // Memasukkan value kedalam input hidden
            hiddenInput.value = selectedValue;
            popup.classList.remove("show");
        });
    });
// Proses selesai