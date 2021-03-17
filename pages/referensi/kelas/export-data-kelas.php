<div class="row">
<?php	
session_start();
include "../../../config/koneksi.php";
require_once "../../../assets/plugins/importexcel/autoload.php";
// Load library phpspreadsheet
// require('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator($_SESSION['nama_pt'])
->setLastModifiedBy($_SESSION['nama_pt'])
->setTitle('Data Kelas'.$_SESSION['nama_pt'].' '.(date('Y')))
->setSubject('Data Kelas'.$_SESSION['nama_pt'].' '.(date('Y')))
->setDescription('Data Kelas')
->setKeywords('Data Kelas Export')
->setCategory('Data Export');

$spreadsheet->getActiveSheet()->mergeCells('A1:G1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', (strtoupper($_SESSION['nama_pt'])));
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'DATA KELAS MAHASISWA AKTIF | '.(date('Y-m-d')));


// Sheet Style
$spreadsheet->getActiveSheet()->getStyle('A1:A2')
    ->getFont()->setSize(12);

$spreadsheet->getActiveSheet()->getStyle('A1:A2')
    ->getFont()->setBold(true);

$spreadsheet->getActiveSheet()->getStyle('A4:F4')
    ->getFont()->setBold(true);

$spreadsheet->getActiveSheet()->getStyle('A4:F4')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// Header Tabel
$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A4', 'NO')
->setCellValue('B4', 'PERTA')
->setCellValue('C4', 'PRODI')
->setCellValue('D4', 'KELAS')
->setCellValue('E4', 'NIM')
->setCellValue('F4', 'NAMA')
;

$i=5; 
$no=1; 
$query = "SELECT * FROM t_kelas ORDER BY perta, kdprodi, kelas, nim ASC";
$dewan1 = $db1->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
  $spreadsheet->setActiveSheetIndex(0)
  ->setCellValue('A'.$i, $no)
  ->setCellValue('B'.$i, $row['perta'])
  ->setCellValue('C'.$i, $row['kdprodi'])
  ->setCellValue('D'.$i, $row['kelas'])
  ->setCellValue('E'.$i, $row['nim'])
  ->setCellValue('F'.$i, $row['nama'])
  ;
  $spreadsheet->getActiveSheet()->getStyle('A'.$i.':F'.$i)
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
  $i++; $no++;
}


// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Data-Kelas-Mhs-Aktif'.date('Ymd'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);
ob_end_clean(); // this is solution
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Data-Kelas-Mhs-Aktif'.date('Ymd').'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: 0'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

?>