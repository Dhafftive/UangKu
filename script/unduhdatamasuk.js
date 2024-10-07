document.addEventListener("DOMContentLoaded", function () {
    var downloadButton = document.getElementById("downloadButton");

    downloadButton.addEventListener("click", function () {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../function/downloadpemasukan.php", true);
        xhr.responseType = "blob"; // Menetapkan tipe respons sebagai blob (file)

        xhr.onload = function () {
            if (xhr.status === 200) {
                var url = window.URL.createObjectURL(xhr.response);
                var a = document.createElement("a");
                a.href = url;
                a.download = "Data_Pengeluaran.xlsx";
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            }
        };

        xhr.send();
    });
});