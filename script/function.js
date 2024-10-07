
// Membuat fade animation menu
    function showChart(chart){
        var chartPemasukan = document.getElementById('chartMasuk');
        var chartPengeluaran = document.getElementById('chartKeluar');
        var menuMasuk = document.getElementById('menuMasuk');
        var menuKeluar = document.getElementById('menuKeluar');

        if (chart === 'pieMasuk'){
            chartPemasukan.style.opacity = '1';
            chartPengeluaran.style.opacity = '0';
            menuMasuk.style.opacity = '1';
            menuKeluar.style.opacity = '0';

        } else if (chart === 'pieKeluar') {
            chartPemasukan.style.opacity = '0';
            chartPengeluaran.style.opacity = '1';
            menuMasuk.style.opacity = '0';
            menuKeluar.style.opacity = '1';
        };
    }

// Membuat animation line menu 
    function showSelected(index){
        const menuItems = document.querySelectorAll('.menu li');
        menuItems.forEach((item, i) => {
            if (i === index - 1) {
              item.classList.add('selected');
            } else {
              item.classList.remove('selected');
            }
          });
    }
    
    document.addEventListener("DOMContentLoaded", function() {
        showSelected(1); 
    });