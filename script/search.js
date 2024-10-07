document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll(".menu-table");
    const noResultsMessage = document.getElementById("noResultsMessage");

    searchInput.addEventListener("keyup", function () {
        const searchText = searchInput.value.toLowerCase();
        let noResults = true; // Tandai bahwa belum ada hasil pencarian yang ditemukan

        tableRows.forEach(function (row) {
            const catatan = row.querySelector("td:nth-child(1)").textContent.toLowerCase();
            const kategori = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
            const nominal = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
            const tanggal = row.querySelector("td:nth-child(4)").textContent.toLowerCase();

            if (
                catatan.includes(searchText) ||
                kategori.includes(searchText) ||
                nominal.includes(searchText) ||
                tanggal.includes(searchText)
            ) {
                row.style.display = "table-row";
                noResults = false; // Ada hasil pencarian yang sesuai
            } else {
                row.style.display = "none";
            }
        });

        // Tampilkan atau sembunyikan pesan "Tidak ada data yang sesuai"
        if (noResults) {
            noResultsMessage.style.display = "block";
        } else {
            noResultsMessage.style.display = "none";
        }
    });
});