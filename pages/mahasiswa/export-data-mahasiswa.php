<div class="row">
  <?php
  session_start();
  include "../../config/koneksi.php";
  require_once "../../assets/plugins/importexcel/autoload.php";
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
    ->setTitle('Data Mahasiswa' . $_SESSION['nama_pt'] . ' ' . (date('Y')))
    ->setSubject('Data Mahasiswa' . $_SESSION['nama_pt'] . ' ' . (date('Y')))
    ->setDescription('Data Mahasiswa')
    ->setKeywords('Data Mahasiswa Export')
    ->setCategory('Data Export');

  $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', (strtoupper($_SESSION['nama_pt'])));
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'DATA MAHASISWA | ' . (date('Y-m-d')));


  // Sheet Style
  $spreadsheet->getActiveSheet()->getStyle('A1:A2')
    ->getFont()->setSize(12);

  $spreadsheet->getActiveSheet()->getStyle('A1:A2')
    ->getFont()->setBold(true);

  $spreadsheet->getActiveSheet()->getStyle('A4:G4')
    ->getFont()->setBold(true);

  $spreadsheet->getActiveSheet()->getStyle('A4:G4')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

  // Header Tabel
  $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A4', 'NO')
    ->setCellValue('B4', 'NIM')
    ->setCellValue('C4', 'NAMA')
    ->setCellValue('D4', 'SEX')
    ->setCellValue('E4', 'TGL LAHIR')
    ->setCellValue('F4', 'THN MASUK')
    ->setCellValue('G4', 'EMAIL');

  $i = 5;
  $no = 1;
  $query = "SELECT * FROM m_siswa ORDER BY nim, thnmasuk ASC";
  $query = mysqli_query($Open, $query);
  while ($row = mysqli_fetch_assoc($query)) {
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A' . $i, $no)
      ->setCellValue('B' . $i, $row['nim'])
      ->setCellValue('C' . $i, $row['nama'])
      ->setCellValue('D' . $i, $row['sex'])
      ->setCellValue('E' . $i, $row['tgllahir'])
      ->setCellValue('F' . $i, $row['thnmasuk'])
      ->setCellValue('G' . $i, $row['nemail']);
    $spreadsheet->getActiveSheet()->getStyle('A' . $i . ':G' . $i)
      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $i++;
    $no++;
  }


  // Rename worksheet
  $spreadsheet->getActiveSheet()->setTitle('Data-Mahasiswa-' . date('Ymd'));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $spreadsheet->setActiveSheetIndex(0);
  ob_end_clean(); // this is solution
  // Redirect output to a client’s web browser (Xlsx)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Data-Mahasiswa-' . date('Ymd') . '.xlsx"');
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