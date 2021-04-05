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

$sta=$_GET['perta'];
$singper=$_GET['perta'];
if($_SESSION['perta'] != $sta){
	$sta=$_GET['perta'];
	mysqli_query($Open, "RENAME TABLE edopdata TO edopdata_ori");
	mysqli_query($Open, "RENAME TABLE exoxpotensi TO exoxpotensi_ori");
	mysqli_query($Open, "RENAME TABLE edopdata$sta TO edopdata");
	mysqli_query($Open, "RENAME TABLE exoxpotensi$sta TO exoxpotensi");
}else{
	$sta='';
}

$xkode = $_GET["kodex"];
$xjnspar=2;
$qscpar=mysqli_query($Open, "select a.kodedosen,b.nama,a.kodemk,a.idprogstudi,c.namaprodi,a.ta,a.per,a.utsuas,a.A,a.B,a.C,a.total from v_edop_overall a,m_dosen b, m_prodi c where a.idprogstudi='$xkode' and b.kodedosen=a.kodedosen and c.kodeprodi=a.idprogstudi");


$title='e-DOP Report.02';
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
$subjudul="LAPORAN DOSEN PRODI";
$pdf->SetTitle($title);
$pdf->SetDrawColor(168,168,168);
$qv1=mysqli_query($Open, "select a.ta,a.per,a.utsuas,b.namaprodi from v_edop_overall a, m_prodi b where a.idprogstudi='$xkode' and b.kodeprodi=a.idprogstudi");
$r1=mysqli_fetch_array($qv1);
$sdata=mysqli_fetch_array($qv1);
$qv=mysqli_query($Open, "select totscor from v_edop_overall_totalscore where idprogstudi='$xkode'");
$r=mysqli_fetch_array($qv);
$sper=$sdata['per'];
$sutsuas=$sdata['utsuas'];


	$periode="Periode ".$singper;


// -- logo + title 
$pdf->SetFont('Arial','',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(3);


$pdf->SetFont('Arial','B',9);
$pdf->SetDrawColor(168,168,168);$pdf-> SetFillColor(54,105,201);$pdf->SetTextColor(255,255,255);
$pdf->Cell(140,5,"",0,0,"L");$pdf->Cell(30,5,"Score*",0,1,"C",1);$pdf->SetDrawColor(255,255,255);$pdf->Line(160,50,190,50);
$pdf->Cell(140,5,"",0,0,"L");$pdf->Cell(30,5,number_format($r['totscor'],2),0,1,"C",1);
$pdf->SetDrawColor(168,168,168);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(20,5,"Nama Prodi : ",0,0,"L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,5,"".$sdata['namaprodi']."",0,0,"L");$pdf->Cell(100,5,"",0,0,"L");
$pdf->SetFont('Arial','I',8);
$pdf->Cell(30,5,"* Skala 5",0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(168,168,168);
$pdf-> SetFillColor(190,206,238);
$y=$pdf->getY();
$pdf->Line(20,$y+3,190,$y+3);
$pdf->ln(4);

$pdf->Cell(7,6,"No",0,0,"C",1);$pdf->Cell(70,6,"Kode - Nama Dosen",0,0,"L",1);$pdf->Cell(42,6,"Kode MK",0,0,"C",1);$pdf->Cell(15,6,"Score",0,0,"C",1);$pdf->Cell(12,6,"A*",0,0,"C",1);$pdf->Cell(12,6,"B*",0,0,"C",1);$pdf->Cell(12,6,"C*",0,1,"C",1);
$pdf->ln(4);
$pdf->Line(20,$y+11,190,$y+11);	
$no=1;
while ($scpar=mysqli_fetch_array($qscpar)) {
$pdf->Cell(7,6,"".$no.".",0,0,"C");$pdf->Cell(70,6,"".$scpar['kodedosen']." - ".$scpar['nama']."",0,0,"L");$pdf->Cell(42,6,"".$scpar['kodemk']."",0,0,"C");$pdf->Cell(15,6,"".number_format($scpar['total'],2)."",0,0,"C");$pdf->Cell(12,6,"".number_format($scpar['A'],2)."",0,0,"C");$pdf->Cell(12,6,"".number_format($scpar['B'],2)."",0,0,"C");$pdf->Cell(12,6,"".number_format($scpar['C'],2)."",0,1,"C");	

if($no==33){
$pdf->SetFont('Arial','',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(3);

$pdf->SetFont('Arial','B',9);
$pdf->SetDrawColor(168,168,168);$pdf-> SetFillColor(54,105,201);$pdf->SetTextColor(255,255,255);
$pdf->Cell(140,5,"",0,0,"L");$pdf->Cell(30,5,"Score*",0,1,"C",1);$pdf->SetDrawColor(255,255,255);$pdf->Line(160,50,190,50);
$pdf->Cell(140,5,"",0,0,"L");$pdf->Cell(30,5,number_format($r['totscor'],2),0,1,"C",1);
$pdf->SetDrawColor(168,168,168);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(20,5,"Nama Prodi : ",0,0,"L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,5,"".$sdata['namaprodi']."",0,0,"L");$pdf->Cell(100,5,"",0,0,"L");
$pdf->SetFont('Arial','I',8);
$pdf->Cell(30,5,"* Skala 5",0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(168,168,168);
$pdf-> SetFillColor(190,206,238);
$y=$pdf->getY();
$pdf->Line(20,$y+3,190,$y+3);
$pdf->ln(4);
$pdf->Cell(7,6,"No",0,0,"C",1);$pdf->Cell(70,6,"Kode - Nama Dosen",0,0,"L",1);$pdf->Cell(42,6,"Kode MK",0,0,"C",1);$pdf->Cell(15,6,"Score",0,0,"C",1);$pdf->Cell(12,6,"A*",0,0,"C",1);$pdf->Cell(12,6,"B*",0,0,"C",1);$pdf->Cell(12,6,"C*",0,1,"C",1);
$pdf->ln(4);
$pdf->Line(20,$y+11,190,$y+11);	
}
	$no++;	
}
$pdf->ln(4);
$pdf->SetLeftMargin(20);
$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(70,$tgi,'',0,0,"L");$pdf->Cell(52,$tgi,'',0,0,"L");$pdf->Cell(70,$tgi,'Keterangan : ',0,1,"L");
$pdf->Cell(70,$tgi,'',0,0,"L");$pdf->Cell(52,$tgi,'',0,0,"L");$pdf->Cell(70,$tgi,'A : Perencanaan PBM',0,1,"L");
$pdf->Cell(70,$tgi,'',0,0,"L");$pdf->Cell(52,$tgi,'',0,0,"L");$pdf->Cell(70,$tgi,'B : Pelaksanaan PBM',0,1,"L");
$pdf->Cell(70,$tgi,'',0,0,"L");$pdf->Cell(52,$tgi,'',0,0,"L");$pdf->Cell(70,$tgi,'C : Evaluasi PBM',0,1,"L");
$pdf->Cell(70,$tgi,ucwords(strtolower($_SESSION['kota_pt'])).', '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'   - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,strtoupper($_SESSION['unit']),0,1,"L");
$pdf->Cell(70,$tgi,'',0,0,"L");

if($_SESSION['perta'] != $sta){
	mysqli_query($Open, "RENAME TABLE edopdata TO edopdata$sta");
	mysqli_query($Open, "RENAME TABLE exoxpotensi TO exoxpotensi$sta");
	mysqli_query($Open, "RENAME TABLE edopdata_ori TO edopdata");
	mysqli_query($Open, "RENAME TABLE exoxpotensi_ori TO exoxpotensi");
}


mysqli_close($Open);




//$filename="test1.pdf";
$filename="pdfoutput/edopr2-".$xkode."-".$singper.".pdf";
$filename2="edopr2-".$xkode."-".$singper.".pdf";

$pdf->Output($filename2,'D');
//$pdf->Output($filename,'F');
//echo'<a href="test1.pdf">Download your Invoice</a>';

$pdf->output()

?>