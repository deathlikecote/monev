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
    ->setTitle('EDOP Report' . $_SESSION['nama_pt'] . ' ' . (date('Y')))
    ->setSubject('EDOP Report' . $_SESSION['nama_pt'] . ' ' . (date('Y')))
    ->setDescription('EDOP Report')
    ->setKeywords('EDOP Report')
    ->setCategory('Data');

  $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', (strtoupper($_SESSION['nama_pt'])));
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'REKAPITULASI EDOP | ' . (date('Y-m-d')));


  // Sheet Style
  $spreadsheet->getActiveSheet()->getStyle('A1:A2')
    ->getFont()->setSize(12);

  $spreadsheet->getActiveSheet()->getStyle('A1:A2')
    ->getFont()->setBold(true);

  $spreadsheet->getActiveSheet()->getStyle('A4:J4')
    ->getFont()->setBold(true);

  $spreadsheet->getActiveSheet()->getStyle('A4:J4')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

  // Header Tabel
  $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A4', 'NO')
    ->setCellValue('B4', 'KODEDOSEN')
    ->setCellValue('C4', 'NAMA')
    ->setCellValue('D4', 'MK')
    ->setCellValue('E4', 'PRODI')
    ->setCellValue('F4', 'KLS')
    ->setCellValue('G4', 'A')
    ->setCellValue('H4', 'B')
    ->setCellValue('I4', 'C')
    ->setCellValue('J4', 'NA');

  $i = 5;
  $no = 1;
  $query = "SELECT * FROM edopdata_es WHERE ta = '" . $_GET['perta'] . "' ORDER BY namadosen,kodemk ASC";
  $query = mysqli_query($Open, $query);
  while ($row = mysqli_fetch_assoc($query)) {
    $kdosen = strtoupper($row['kodedosen']);
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A' . $i, $no)
      ->setCellValue('B' . $i, $kdosen)
      ->setCellValue('C' . $i, strtoupper($row['namadosen']))
      ->setCellValue('D' . $i, $row['kodemk'])
      ->setCellValue('E' . $i, $row['idprogstudi'])
      ->setCellValue('F' . $i, (string)$row['kelas'])
      ->setCellValue('G' . $i, number_format($row['A'], 2))
      ->setCellValue('H' . $i, number_format($row['B'], 2))
      ->setCellValue('I' . $i, number_format($row['C'], 2))
      ->setCellValue('J' . $i, number_format($row['total'], 2));
    $spreadsheet->getActiveSheet()->getStyle('A' . $i . ':J' . $i)
      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $i++;
    $no++;
  }


  // Rename worksheet
  $spreadsheet->getActiveSheet()->setTitle('Edop-Report-' . date('Ymd'));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $spreadsheet->setActiveSheetIndex(0);
  ob_end_clean(); // this is solution
  // Redirect output to a client???s web browser (Xlsx)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Edop-Report-' . date('Ymd') . '.xlsx"');
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