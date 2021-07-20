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
    ->setTitle('Data Generate EDOM & EPOM' . $_SESSION['nama_pt'] . ' ' . (date('Y')))
    ->setSubject('Data Generate EDOM & EPOM' . $_SESSION['nama_pt'] . ' ' . (date('Y')))
    ->setDescription('Data Generate EDOM & EPOM')
    ->setKeywords('Data Generate EDOM & EPOM Export')
    ->setCategory('Data Export');

  $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', (strtoupper($_SESSION['nama_pt'])));
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'DATA GENERATE EDOM & EPOM | ' . (date('Y-m-d')));


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
    ->setCellValue('B4', 'PERTA')
    ->setCellValue('C4', '')
    ->setCellValue('D4', 'NIM')
    ->setCellValue('E4', 'NAMA')
    ->setCellValue('F4', 'PRODI')
    ->setCellValue('G4', 'KELAS');

  $i = 5;
  $no = 1;
  $query = "SELECT a.*, b.nama FROM edompotensi a, m_siswa b WHERE ta = '" . $_SESSION['perta'] . "' AND (b.nim = a.nim) GROUP BY a.ta, a.per, a.utsuas, a.nim, a.idprogstudi, a.kelas ORDER BY a.ta, a.per, a.utsuas, a.nim, a.kodemk, a.idprogstudi, a.kelas asc";
  $query = mysqli_query($Open, $query);
  while ($row = mysqli_fetch_assoc($query)) {
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A' . $i, $no)
      ->setCellValue('B' . $i, $row['ta'])
      ->setCellValue('C' . $i, $row['utsuas'])
      ->setCellValue('D' . $i, $row['nim'])
      ->setCellValue('E' . $i, $row['nama'])
      ->setCellValue('F' . $i, $row['idprogstudi'])
      ->setCellValue('G' . $i, $row['kelas']);
    $spreadsheet->getActiveSheet()->getStyle('A' . $i . ':G' . $i)
      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $i++;
    $no++;
  }


  // Rename worksheet
  $spreadsheet->getActiveSheet()->setTitle('Data-Generate-EDOM-EPOM' . date('Ymd'));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $spreadsheet->setActiveSheetIndex(0);
  ob_end_clean(); // this is solution
  // Redirect output to a client’s web browser (Xlsx)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Data-Generate-EDOM-EPOM' . date('Ymd') . '.xlsx"');
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