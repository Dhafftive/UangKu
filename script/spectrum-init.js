$(document).ready(function(){
    // Inisialisasi Spectrum Color Picker
    $('#color-picker').spectrum({
        type: "text",
        togglePaletteOnly: true,
        hideAfterPaletteSelect: true,
        showInput: true,
        showInitial: true,
        move: function(color) {
            $("#hexInput").val(color);
            $("#iconColorInput").val(color);
            updateColorIcon(color);
        }
      });
    // Fungsi memanggil color palette
    var defaultColor = "#9f17ee"; // Warna ungu
    $("#color-picker").spectrum("set", defaultColor);
    $("#colorPreview").css("background-color", defaultColor);
    $("#hexInput").val(defaultColor);
    $("#iconColorInput").val(defaultColor);
    updateColorIcon(defaultColor);

    // Set warna putih untuk ikon
    $("#colorIcon").css("color", "#fff");

    // Mengambil kode HEX dan memasukkannya ke dalam input text
    $("#color-picker").on("change", function() {
        var color = $("#color-picker").spectrum("get");
        $("#colorPreview").css("background-color", color);
        updateColorIcon(color); // Memanggil updateColorIcon untuk mengubah warna ikon
    });

});

function updateColorIcon(_color) {
    var colorPreview = document.getElementById("colorPreview");
    var colorIcon = document.getElementById("colorIcon");
    
    // Mendapatkan nilai kecerahan warna latar belakang
    var bgColor = getComputedStyle(colorPreview)["background-color"];
    var brightness = calculateBrightness(bgColor);
    
    // Mengubah warna ikon berdasarkan kecerahan latar belakang
    if (brightness > 150) {
        colorIcon.style.color = "#1a1a1a"; // Warna ikon untuk background cerah
    } else if (brightness > 35) {
        colorIcon.style.color = "#f3f3f3"; // Warna ikon untuk background agak gelap
    } else {
        colorIcon.style.color = "#fff"; // Warna ikon untuk background gelap
    }
}

function calculateBrightness(rgbColor) {
    // Fungsi untuk menghitung kecerahan warna berdasarkan formula sederhana
    var colorArray = rgbColor.match(/\d+/g);
    var brightness = (colorArray[0] * 299 + colorArray[1] * 587 + colorArray[2] * 114) / 1000;
    return brightness;
}
