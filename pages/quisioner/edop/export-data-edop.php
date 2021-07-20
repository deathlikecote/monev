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
    ->setTitle('Data Aspek Parameter EDOP' . $_SESSION['nama_pt'] . ' ' . (date('Y')))
    ->setSubject('Data Aspek Parameter EDOP' . $_SESSION['nama_pt'] . ' ' . (date('Y')))
    ->setDescription('Data Aspek Parameter EDOP')
    ->setKeywords('Data Aspek Parameter EDOP Export')
    ->setCategory('Data Export');

  $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', (strtoupper($_SESSION['nama_pt'])));
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'DATA ASPEK PARAMETER EDOP | ' . (date('Y-m-d')));
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', 'JP (Jenis Pertanyaan) : 1 - Ordinal | 2 - Ya/Tidak | 3 - Isian');


  // Sheet Style
  $spreadsheet->getActiveSheet()->getStyle('A1:A2')
    ->getFont()->setSize(12);

  $spreadsheet->getActiveSheet()->getStyle('A1:A2')
    ->getFont()->setBold(true);

  $spreadsheet->getActiveSheet()->getStyle('A5:E5')
    ->getFont()->setBold(true);

  $spreadsheet->getActiveSheet()->getStyle('A5:E5')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

  // Header Tabel
  $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A5', 'NO')
    ->setCellValue('B5', 'URUT')
    ->setCellValue('C5', 'ASPEK')
    ->setCellValue('D5', 'PARAMETER')
    ->setCellValue('E5', '(JP)');

  $i = 6;
  $no = 1;
  $query = "SELECT * FROM edopparameter ORDER BY aspek, nourut ASC";
  $query = mysqli_query($Open, $query);
  while ($row = mysqli_fetch_assoc($query)) {
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A' . $i, $no)
      ->setCellValue('B' . $i, $row['nourut'])
      ->setCellValue('C' . $i, $row['aspek'])
      ->setCellValue('D' . $i, $row['parameter'])
      ->setCellValue('E' . $i, $row['jenis']);
    $spreadsheet->getActiveSheet()->getStyle('A' . $i . ':E' . $i)
      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $i++;
    $no++;
  }


  // Rename worksheet
  $spreadsheet->getActiveSheet()->setTitle('Data-Aspek-Param-EDOP-' . date('Ymd'));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $spreadsheet->setActiveSheetIndex(0);
  ob_end_clean(); // this is solution
  // Redirect output to a client’s web browser (Xlsx)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Data-Aspek-Param-EDOP-' . date('Ymd') . '.xlsx"');
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