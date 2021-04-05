<?php
session_start();
define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/edopclassonet.php');
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
	mysqli_query($Open, "RENAME TABLE edopdata TO edopdata_ori");
	mysqli_query($Open, "RENAME TABLE exoxpotensi TO exoxpotensi_ori");
	mysqli_query($Open, "RENAME TABLE edopdata$sta TO edopdata");
	mysqli_query($Open, "RENAME TABLE exoxpotensi$sta TO exoxpotensi");
}else{
	$sta='';
}


$xjnspar=2;
$qscpar=mysqli_query($Open, "select a.idprogstudi, b.namaprodi, b.jurprodi, a.ta,a.per,a.utsuas,a.totscor,a.jmlpengajar from v_edop_overall_totalscore a, m_prodi b where a.ta = '".$singper."' and b.kodeprodi=a.idprogstudi order by jurprodi asc");


$title='e-DOP Report.03';
$pdf = new PDF_onet();
$pdf->SetLeftMargin(20);
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','',9);
$aspeka=1;
$aspekb=10;
$aspekc=17;
$aspekd=22;
$tgi=4;
$tgi1=5;
$tgiaspek=7;
$lbraspek=145;
$judul="EVALUASI DOSEN OLEH PROGRAM STUDI";
$subjudul="LAPORAN REKAPITULASI PRODI";
$pdf->SetTitle($title);
$pdf->SetDrawColor(168,168,168);


$periode="Periode ".$singper;


// -- logo + title 
$pdf->SetFont('Arial','',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(3);

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(168,168,168);
$pdf-> SetFillColor(190,206,238);
$y=$pdf->getY();
$pdf->Line(20,$y+3,190,$y+3);
$pdf->ln(4);

$pdf->Cell(7,6,"No",0,0,"C",1);$pdf->Cell(70,6,"Nama Program Studi",0,0,"L",1);$pdf->Cell(60,6,"Jurusan",0,0,"C",1);$pdf->Cell(33,6,"Score (#Dosen)",0,1,"C",1);
$pdf->ln(4);
$pdf->Line(20,$y+11,190,$y+11);	
$no=1;
while ($scpar=mysqli_fetch_array($qscpar)) {
$pdf->Cell(7,6,"".$no.".",0,0,"C");$pdf->Cell(70,6,"".$scpar['idprogstudi']." - ".$scpar['namaprodi']."",0,0,"L");$pdf->Cell(60,6,"".$scpar['jurprodi']."",0,0,"C");$pdf->Cell(33,6,"".number_format($scpar['totscor'],2)." (".$scpar['jmlpengajar'].")",0,1,"C");
	$no++;	
}
$pdf->ln(4);
$pdf->SetLeftMargin(20);
$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(70,$tgi,ucwords(strtolower($_SESSION['kota_pt'])).', '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'   - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,strtoupper($_SESSION['unit']),0,1,"L");
$pdf->Cell(70,$tgi,'',0,1,"L");

if($_SESSION['perta'] != $sta){
	mysqli_query($Open, "RENAME TABLE edopdata TO edopdata$sta");
	mysqli_query($Open, "RENAME TABLE exoxpotensi TO exoxpotensi$sta");
	mysqli_query($Open, "RENAME TABLE edopdata_ori TO edopdata");
	mysqli_query($Open, "RENAME TABLE exoxpotensi_ori TO exoxpotensi");
}
mysqli_close($Open);




//$filename="test1.pdf";
$filename="pdfoutput/edopr3-".$singper.".pdf";
$filename2="edopr3-".$singper.".pdf";

$pdf->Output($filename2,'D');
//$pdf->Output($filename,'F');
//echo'<a href="test1.pdf">Download your Invoice</a>';

$pdf->output()

?>