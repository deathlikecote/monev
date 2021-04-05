<?php
session_start();
define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/edomclassonet.php');
// require('../fpdf17/linegraphonet.php');
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

//--ok
mysqli_query($Open, "TRUNCATE TABLE edomtemp05");
mysqli_query($Open, "INSERT INTO edomtemp05 (kodedosen) (select distinct(kodedosen) from edomdata$sta)") or die(mysqli_error());
mysqli_query($Open, "UPDATE edomtemp05 INNER JOIN edompotensi$sta ON edomtemp05.kodedosen = edompotensi$sta.kodedosen SET edomtemp05.namadosen = edompotensi$sta.namadosen") or die(mysqli_error());
mysqli_query($Open, "update edomtemp05 t1 inner join (select kodedosen, count(kodedosen)/'$jpar' as Jsiswa from edomdata$sta group by kodedosen) t2 on t1.kodedosen = t2.kodedosen set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysqli_error());

mysqli_query($Open, "update edomtemp05 t1 inner join (select kodedosen, sum(v1) as Jsc from edomdata$sta where jenis != '3' group by kodedosen) t2 on t1.kodedosen = t2.kodedosen set t1.jumlah = t2.Jsc") or die("error jumlah:".mysqli_error());

mysqli_query($Open, "update edomtemp05 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysqli_error());

$title='e-DOM Report.05';

$pdf=new PDF_onet();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetFont('helvetica','',8);
$pdf->SetLeftMargin(20);
$tgi=4;
$tgiaspek=4;
$judul="EVALUASI DOSEN OLEH MAHASISWA";
$subjudul="LAPORAN REKAPITULASI DOSEN";

$quepot=mysqli_fetch_assoc(mysqli_query($Open, "select ta, per, utsuas from edompotensi$sta where id=861"));
$sper=$quepot['per'];

$periode="Periode ".$singper;

// -- header	
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('helvetica','',11);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('helvetica','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(2);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// -- Judul
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(8,5,'No.',0,0,'C');		
$pdf->Cell(15,5,' ',0,0,'C');		
$pdf->Cell(100,5,'Nama Dosen',0,0,'L');		
$pdf->Cell(10,5,'Score',0,0,'L');		
$pdf->Cell(10,5,'#siswa',0,1,'L');		
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(5);
$pdf->SetLeftMargin(20);

// --- data nilai prodi

$nou=0;
$jscore=0;
$que1=mysqli_query($Open, "select kodedosen, namadosen, score, jmlmhs from edomtemp05 where ucase(trim(namadosen)) <> 'TIM' order by score desc")  or die("error as:".mysql_error());
while ($list=mysqli_fetch_array($que1)){
	$nou=$nou+1;
	$skddsn=$list['kodedosen'];
	$snmdsn=$list['namadosen'];
	$sscore=$list['score'];
	$sjsiswa=$list['jmlmhs'];
	
	$pdf->SetFont('helvetica','',9);
	$pdf->Cell(15,$tgiaspek,$nou.'.',0,0,"L");
	$pdf->Cell(110,$tgiaspek,$skddsn.' - '.$snmdsn,0,0,"L");
	$pdf->Cell(10,$tgiaspek,number_format($sscore, 2, '.', ''),0,0,"C");
	$pdf->Cell(12,$tgiaspek,'('.number_format($sjsiswa, 0, '.', '').')',0,1,"C");

	if ($nou == 55){
$pdf->AddPage('P','A4');
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('helvetica','',11);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('helvetica','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(2);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// -- Judul
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(8,5,'No.',0,0,'C');		
$pdf->Cell(15,5,' ',0,0,'C');		
$pdf->Cell(100,5,'Nama Dosen',0,0,'L');		
$pdf->Cell(10,5,'Score',0,0,'L');		
$pdf->Cell(10,5,'#siswa',0,1,'L');		
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(5);
$pdf->SetLeftMargin(20);
	
	}
	
}


$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(2);

$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(110,$tgi,ucwords(strtolower($_SESSION['kota_pt'])).', '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(110,$tgi,'            - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(110,$tgi,strtoupper($_SESSION['unit']),0,1,"L");


mysqli_close($Open);

$filename="pdfoutput/edomr5-".$singper.".pdf";
$filename2="edomr5-".$singper.".pdf";

$pdf->Output($filename2,'D');

$pdf->output()


?>