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

// Membuat lembar pertama untuk data pemasukan
$worksheetpemasukan = $spreadsheet->getActiveSheet();
$worksheetpemasukan->setTitle('Data pemasukan');

// Menulis header kolom
$worksheetpemasukan->setCellValue('A4', 'No.');
$worksheetpemasukan->setCellValue('B4', 'Catatan');
$worksheetpemasukan->setCellValue('C4', 'Kategori');
$worksheetpemasukan->setCellValue('D4', 'Jumlah');
$worksheetpemasukan->setCellValue('E4', 'Tanggal');

// Mengatur lebar kolom
$worksheetpemasukan->getColumnDimension('A')->setWidth(5);
$worksheetpemasukan->getColumnDimension('B')->setWidth(20); // Diperkecil sedikit
$worksheetpemasukan->getColumnDimension('C')->setWidth(15); // Diperkecil sedikit
$worksheetpemasukan->getColumnDimension('D')->setWidth(20);
$worksheetpemasukan->getColumnDimension('E')->setWidth(30); // Diperlebar untuk tanggal

// Mengatur tinggi baris untuk header
$worksheetpemasukan->getRowDimension(4)->setRowHeight(30);

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

$worksheetpemasukan->getStyle('A4:E4')->applyFromArray($styleHeader);

$query = mysqli_query($conn, "SELECT * FROM pemasukan");
$no = 1;
$i = 5;

// Menambahkan judul "Data pemasukan Anda" di luar tabel
$worksheetpemasukan->mergeCells('A1:E1');
$worksheetpemasukan->setCellValue('A1', 'Data pemasukan Anda');
$worksheetpemasukan->getStyle('A1')->getFont()->setBold(true);
$worksheetpemasukan->getStyle('A1')->getFont()->setSize(20);
$worksheetpemasukan->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Menambahkan beberapa baris kosong untuk memberikan jarak antara judul dan tabel
$worksheetpemasukan->mergeCells('A2:E3');

while ($row = mysqli_fetch_assoc($query)) {
    $worksheetpemasukan->setCellValue('A' . $i, $no++);
    
    // Mengatur teks nomor menjadi center
    $worksheetpemasukan->getStyle('A' . $i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $worksheetpemasukan->setCellValue('B' . $i, $row['catatan_masuk']);
    $worksheetpemasukan->setCellValue('C' . $i, $row['kategori_masuk']);
    $worksheetpemasukan->setCellValue('D' . $i, 'Rp. ' . number_format($row['jumlah_masuk'], 0, ',', '.'));
    $worksheetpemasukan->setCellValue('E' . $i, date('d F Y', strtotime($row['tgl_pemasukan'])));
    
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
$worksheetpemasukan->getStyle('A4:E' . $i)->applyFromArray($styleArray);

// Mengatur kertas menjadi A4
$worksheetpemasukan->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

// Mengatur margin
$worksheetpemasukan->getPageMargins()->setTop(1);
$worksheetpemasukan->getPageMargins()->setRight(0.75);
$worksheetpemasukan->getPageMargins()->setLeft(0.75);
$worksheetpemasukan->getPageMargins()->setBottom(1);

// Simpan file Excel ke direktori server
$file = "Data_pemasukan.xlsx";
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
