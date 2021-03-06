<?php
session_start();
define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/edomclassonet.php');
include "../../../config/koneksi.php";

function konversi_tanggal($format, $tanggal="now", $bahasa="id"){
 $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
 
 $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
 "Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September",
 "Oktober","Nopember","Desember");
 
 $fr = array("dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi",
 "janvier","février","mars","avril","Mei","mai","juillet","aoùt","septembre",
 "octobre","novembre","décembre");
 
 return str_replace($en,$$bahasa,date($format,strtotime($tanggal)));
}

$sta=$_POST['perta'];
$singper=$_POST['perta'];
if($_SESSION['perta'] != $sta){
	$sta=$_POST['perta'];
}else{
	$sta='';
}
$qry=mysqli_fetch_assoc(mysqli_query($Open, "select count(parameter) as vjpar from edomparameter$sta where jenis != '3'"));
$jpar=$qry['vjpar'];
// mysqli_query($Open, "update edomdata set kodeprodikls=concat(idprogstudi,kelas)") or die("update edomdata : ".mysqli_error());

mysqli_query($Open, "TRUNCATE TABLE edomtemp04");
mysqli_query($Open, "INSERT INTO edomtemp04 (kodeprodikls,idprogstudi,kelas) (select distinct(kodeprodikls),idprogstudi,kelas from edomdata$sta)") or die("insert to edomtemp04 : ".mysqli_error());
//mysqli_query("update edomtemp04 set kodeprodikls=concat(idprogstudi,kelas)") or die(mysqli_error());
mysqli_query($Open, "UPDATE edomtemp04 INNER JOIN m_prodi ON edomtemp04.idprogstudi = m_prodi.kodeprodi SET edomtemp04.namaprodi = m_prodi.namaprodi, edomtemp04.jurprodi = m_prodi.jurprodi") or die(mysqli_error());
mysqli_query($Open, "update edomtemp04 t1 inner join (select kodeprodikls, count(kodeprodikls)/'$jpar' as Jsiswa from edomdata$sta group by kodeprodikls) t2 on t1.kodeprodikls = t2.kodeprodikls set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysqli_error());
mysqli_query($Open, "update edomtemp04 t1 inner join (select kodeprodikls, sum(v1) as Jsc from edomdata$sta where jenis != '3' group by kodeprodikls) t2 on t1.kodeprodikls = t2.kodeprodikls set t1.jumlah = t2.Jsc") or die("error jumlah:".mysqli_error());
mysqli_query($Open, "update edomtemp04 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysqli_error());
$title='e-DOM Report.04';

$pdf=new PDF_onet();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetFont('helvetica','',8);
$pdf->SetLeftMargin(20);
$tgi=4;
$tgiaspek=5;
$pdf->SetDrawColor(168,168,168);
$judul="EVALUASI DOSEN OLEH MAHASISWA";
$subjudul="LAPORAN REKAPITULASI PRODI per KELAS";


$periode="Periode ".$singper;

// -- header

$pdf->ln(4);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('helvetica','',9);
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,6,$periode,0,1,"C");
//$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(2);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);
$pdf->SetLeftMargin(20);
$pdf->HLevel3('No.','Nama Program Studi - Kelas','Jurusan','Score #mhs');
$y=$pdf->getY();
$pdf->Line(20,$y+7,190,$y+7);
$pdf->ln(8);
$pdf->SetLeftMargin(20);

// --- data nilai prodi

$nou=0;
$jscore=0;
$que1=mysqli_query($Open, "select kodeprodikls, idprogstudi, kelas, namaprodi, jurprodi, score, jmlmhs from edomtemp04 order by jurprodi,kodeprodikls")  or die("error as:".mysqli_error());
while ($list=mysqli_fetch_array($que1)){
	$nou=$nou+1;
	$skpk=$list['kodeprodikls'];
	$sidp=$list['idprogstudi'];
	$skls=$list['kelas'];
	$snmp=$list['namaprodi'];
	$snmj=$list['jurprodi'];
	$sscore=$list['score'];
	$sjsiswa=$list['jmlmhs'];
	
	$pdf->SetFont('helvetica','',9);
	$pdf->Cell(17,$tgiaspek,$nou.'.',0,0,"L");
	$pdf->Cell(80,$tgiaspek,$snmp.' - '.$skls,0,0,"L");
	$pdf->Cell(40,$tgiaspek,$snmj,0,0,"L");
	$pdf->Cell(10,$tgiaspek,number_format($sscore, 2, '.', ''),0,0,"C");
	$pdf->Cell(12,$tgiaspek,'('.number_format($sjsiswa, 0, '.', '').')',0,1,"C");

	if ($nou == 40){
	$pdf->AddPage('P','A4');
	// -- Judul
	$pdf->ln(4);
	$pdf->SetFont('helvetica','',11);
	$pdf->Cell(170,6,$judul,0,1,"C");
	$pdf->SetFont('helvetica','B',12);
	$pdf->Cell(170,6,$subjudul,0,1,"C");
	$pdf->SetFont('helvetica','',9);
	$pdf->Cell(170,5,$periode,0,1,"C");
	$pdf->ln(2);
	$y=$pdf->getY();
	$pdf->Line(20,$y+2,190,$y+2);
	$pdf->ln(3);
	$pdf->SetLeftMargin(20);
	$pdf->HLevel3('No.','Nama Program Studi - Kelas','Jurusan','Score #mhs');
	$y=$pdf->getY();
	$pdf->Line(20,$y+7,190,$y+7);
	$pdf->ln(8);
	$pdf->SetLeftMargin(20);
	}
}


$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);

$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(110,$tgi,ucwords(strtolower($_SESSION['kota_pt'])).', '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(110,$tgi,'            - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(110,$tgi,strtoupper($_SESSION['unit']),0,1,"L");


mysqli_close($Open);

//$filename="test1.pdf";
$filename="pdfoutput/edomr4-".$singper.".pdf";
$filename2="edomr4-".$singper.".pdf";

$pdf->Output($filename2,'D');

$pdf->output()

?>