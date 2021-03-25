<?php
define('FPDF_FONTPATH','fpdf17/font/');
require('fpdf17/linegraphonet.php');
include "../../include/koneksi.php";
$qry=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter where jenis != '3'"));
$jpar=$qry['vjpar'];

//--ok
mysqli_query($plm_edom, "TRUNCATE TABLE edomtemp05");
mysqli_query($plm_edom, "INSERT INTO edomtemp05 (kodedosen) (select distinct(kodedosen) from edomdata)") or die(mysqli_error());
mysqli_query($plm_edom, "UPDATE edomtemp05 INNER JOIN edompotensi ON edomtemp05.kodedosen = edompotensi.kodedosen SET edomtemp05.namadosen = edompotensi.namadosen") or die(mysqli_error());
mysqli_query($plm_edom, "update edomtemp05 t1 inner join (select kodedosen, count(kodedosen)/'$jpar' as Jsiswa from edomdata group by kodedosen) t2 on t1.kodedosen = t2.kodedosen set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp05 t1 inner join (select kodedosen, sum(v1) as Jsc from edomdata where jenis != '3' group by kodedosen) t2 on t1.kodedosen = t2.kodedosen set t1.jumlah = t2.Jsc") or die("error jumlah:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp05 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysqli_error());

$title='e-DOM Report.05';

$pdf=new FPDF();
$pdf->AddPage('P','A4');
$pdf->SetFont('helvetica','',8);
$pdf->SetLeftMargin(20);
$tgi=4;
$tgiaspek=4;
$spm='@2017-Satuan Penjaminan Mutu Poltekpar Palembang';
$judul="EVALUASI DOSEN OLEH MAHASISWA";
$subjudul="LAPORAN REKAPITULASI DOSEN";

$quepot=mysqli_fetch_assoc(mysqli_query($plm_edom, "select ta, per, utsuas from edompotensi where id=861"));
$sta=$_SESSION['pertan'];
$sper=$quepot['per'];
$sutsuas=$quepot['utsuas'];
$singper=$_SESSION['pertan'];

$periode="Periode ".$sta;

// -- header
$pdf->Image('images/logoblack.jpg',10,10,10);
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(0,5,'POLTEKPAR PALEMBANG',0,1,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(50,5,'Unit SATUAN PENJAMINAN MUTU',0,0,'L');		
$pdf->SetFont('helvetica','',8);
$pdf->cell(123,5,'hal : 1/2',0,1,"R");
$pdf->ln(4);
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
$que1=mysqli_query($plm_edom, "select kodedosen, namadosen, score, jmlmhs from edomtemp05 where ucase(trim(namadosen)) <> 'TIM' order by score desc")  or die("error as:".mysql_error());
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
$pdf->Image('images/logoblack.jpg',10,10,10);
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(0,5,'POLTEKPAR PALEMBANG',0,1,'L');
$pdf->SetFont('helvetica','',9);
$pdf->Cell(50,5,'Unit SATUAN PENJAMINAN MUTU',0,0,'L');		
$pdf->SetFont('helvetica','',8);
$pdf->cell(123,5,'hal : 2/2',0,1,"R");
$pdf->ln(4);
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


//-- footer
$pdf->sety(271);
$pdf->SetFont('helvetica','I',7);
//$pdf->SetTextColor(100,100,100);
$pdf->Cell(170,5,$spm,0,0,"L");
$pdf->SetTextColor(0,0,0);



mysqli_close($plm_edom);

//$filename="test1.pdf";
$filename="pdfoutput/edomr5-".$singper.".pdf";
$filename2="edomr5-".$singper.".pdf";

$pdf->Output($filename2,'D');
//$pdf->Output($filename,'F');
//echo'<a href="test1.pdf">Download your Invoice</a>';

$pdf->output()


//header("Location:edomreport1.php")


?>