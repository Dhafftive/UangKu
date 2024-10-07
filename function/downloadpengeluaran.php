<?php
include('koneksi.php');
// Mengimpor PhpSpreadsheet
require '../vendor/autoload.php';

// Menggunakan namespace PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

// Membuat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();

// Membuat lembar pertama untuk data pengeluaran
$worksheetPengeluaran = $spreadsheet->getActiveSheet();
$worksheetPengeluaran->setTitle('Data Pengeluaran');

// Menulis header kolom
$worksheetPengeluaran->setCellValue('A4', 'No.');
$worksheetPengeluaran->setCellValue('B4', 'Catatan');
$worksheetPengeluaran->setCellValue('C4', 'Kategori');
$worksheetPengeluaran->setCellValue('D4', 'Jumlah');
$worksheetPengeluaran->setCellValue('E4', 'Tanggal');

// Mengatur lebar kolom
$worksheetPengeluaran->getColumnDimension('A')->setWidth(5);
$worksheetPengeluaran->getColumnDimension('B')->setWidth(20); // Diperkecil sedikit
$worksheetPengeluaran->getColumnDimension('C')->setWidth(15); // Diperkecil sedikit
$worksheetPengeluaran->getColumnDimension('D')->setWidth(20);
$worksheetPengeluaran->getColumnDimension('E')->setWidth(30); // Diperlebar untuk tanggal

// Mengatur tinggi baris untuk header
$worksheetPengeluaran->getRowDimension(4)->setRowHeight(30);

// Mengatur format teks dan latar belakang untuk header
$styleHeader = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
        'size' => 12,
        'name' => 'Arial',
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'color' => ['rgb' => '009900'], // Warna latar belakang yang lebih gelap
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];

$worksheetPengeluaran->getStyle('A4:E4')->applyFromArray($styleHeader);

$query = mysqli_query($conn, "SELECT * FROM pengeluaran");
$no = 1;
$i = 5;

// Menambahkan judul "Data Pengeluaran Anda" di luar tabel
$worksheetPengeluaran->mergeCells('A1:E1');
$worksheetPengeluaran->setCellValue('A1', 'Data Pengeluaran Anda');
$worksheetPengeluaran->getStyle('A1')->getFont()->setBold(true);
$worksheetPengeluaran->getStyle('A1')->getFont()->setSize(20);
$worksheetPengeluaran->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Menambahkan beberapa baris kosong untuk memberikan jarak antara judul dan tabel
$worksheetPengeluaran->mergeCells('A2:E3');

while ($row = mysqli_fetch_assoc($query)) {
    $worksheetPengeluaran->setCellValue('A' . $i, $no++);
    
    // Mengatur teks nomor menjadi center
    $worksheetPengeluaran->getStyle('A' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $worksheetPengeluaran->setCellValue('B' . $i, $row['catatan_keluar']);
    $worksheetPengeluaran->setCellValue('C' . $i, $row['kategori_keluar']);
    $worksheetPengeluaran->setCellValue('D' . $i, 'Rp. ' . number_format($row['jumlah_keluar'], 0, ',', '.'));
    $worksheetPengeluaran->setCellValue('E' . $i, date('d F Y', strtotime($row['tgl_pengeluaran'])));
    
    $i++;
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];

// Terapkan gaya border pada seluruh data
$i = $i - 1;
$worksheetPengeluaran->getStyle('A4:E' . $i)->applyFromArray($styleArray);

// Mengatur kertas menjadi A4
$worksheetPengeluaran->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

// Mengatur margin
$worksheetPengeluaran->getPageMargins()->setTop(1);
$worksheetPengeluaran->getPageMargins()->setRight(0.75);
$worksheetPengeluaran->getPageMargins()->setLeft(0.75);
$worksheetPengeluaran->getPageMargins()->setBottom(1);

// Simpan file Excel ke direktori server
$file = "Data_Pengeluaran.xlsx";
$writer = new Xlsx($spreadsheet);
$writer->save($file);

// Atur header HTTP untuk mengirimkan file Excel yang akan diunduh
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Length: ' . filesize($file));

// Baca dan kirimkan isi file Excel ke output
readfile($file);

// Hapus file Excel setelah diunduh (opsional)
unlink($file);

// Hentikan eksekusi script
exit;
?>
