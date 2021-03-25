<?php
define('FPDF_FONTPATH','fpdf17/font/');
require('fpdf17/edomclassonet.php');
include "../../include/koneksi.php";

function konversi_tanggal($format, $tanggal="now", $bahasa="id"){
 $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
 
 $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
 "Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September",
 "Oktober","Nopember","Desember");
  
 // mengganti kata yang berada pada array en dengan array id, fr (default id)
 return str_replace($en,$$bahasa,date($format,strtotime($tanggal)));
}
$qry=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter where jenis != '3'"));
$jpar=$qry['vjpar'];

//--ok
mysqli_query($plm_edom, "TRUNCATE TABLE edomtemp03");
mysqli_query($plm_edom, "INSERT INTO edomtemp03 (idprogstudi) (select distinct(idprogstudi) from edomdata)") or die(mysqli_error());
mysqli_query($plm_edom, "UPDATE edomtemp03 INNER JOIN plm.m_prodi ON edomtemp03.idprogstudi = plm.m_prodi.kodeprodi SET edomtemp03.namaprodi = plm.m_prodi.namaprodi, edomtemp03.jurprodi = plm.m_prodi.jurprodi") or die(mysqli_error());
mysqli_query($plm_edom, "update edomtemp03 t1 inner join (select idprogstudi, count(idprogstudi)/'$jpar' as Jsiswa from edomdata group by idprogstudi) t2 on t1.idprogstudi = t2.idprogstudi set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp03 t1 inner join (select idprogstudi, sum(v1) as Jsc from edomdata where jenis !='3' group by idprogstudi) t2 on t1.idprogstudi = t2.idprogstudi set t1.jumlah = t2.Jsc") or die("error jumlah:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp03 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysqli_error());

$title='e-DOM Report.03';
$pdf=new PDF_onet();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','',8);
$pdf->SetLeftMargin(20);
$tgi=4;
$tgiaspek=5;
$spm='@2017-Pusat Penjaminan Mutu Poltekpar Palembang';
$judul="EVALUASI DOSEN OLEH MAHASISWA";
$subjudul="LAPORAN REKAPITULASI PRODI";
$pdf->SetDrawColor(168,168,168);

$quepot=mysqli_fetch_assoc(mysqli_query($plm_edom, "select ta, per, utsuas from edompotensi where id=861"));
$sta=$_SESSION['pertan'];
$sper=$quepot['per'];
$sutsuas=$quepot['utsuas'];
$singper=$_SESSION['pertan'];


	$periode="Periode ".$sta;



// -- header
$pdf->ln(4);
$pdf->SetFont('Arial','',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(2);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// -- Judul
$pdf->SetLeftMargin(20);

$pdf->HLevel3('No.','Nama Program Studi','Jurusan','Score #kues');
$y=$pdf->getY();
$pdf->Line(20,$y+7,190,$y+7);
$pdf->ln(7);

// --- data nilai prodi

$nou=0;
$jscore=0;
$que1=mysqli_query($plm_edom, "select idprogstudi, namaprodi, jurprodi, score, jmlmhs from edomtemp03 order by score desc")  or die("error as:".mysqli_error());
while ($list=mysqli_fetch_array($que1)){
	$nou=$nou+1;
	$sidp=$list['idprogstudi'];
	$snmp=$list['namaprodi'];
	$snmj=$list['jurprodi'];
	$sscore=$list['score'];
	$sjsiswa=$list['jmlmhs'];
	
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(5,$tgiaspek,$nou.'.',0,0,"R");
	$pdf->Cell(12,$tgiaspek,$sidp,0,0,"L");
	$pdf->Cell(80,$tgiaspek,$snmp,0,0,"L");
	$pdf->Cell(50,$tgiaspek,$snmj,0,0,"L");
	$pdf->Cell(10,$tgiaspek,number_format($sscore, 2, '.', ''),0,0,"C");
	$pdf->Cell(12,$tgiaspek,'('.number_format($sjsiswa, 0, '.', '').')',0,1,"C");
	
}

$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);

$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(110,$tgi,'Palembang, '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(110,$tgi,'            - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(110,$tgi,'PPM Poltekpar Palembang',0,1,"L");

mysqli_close($plm_edom);

//$filename="test1.pdf";
$filename="pdfoutput/edomr3-".$singper.".pdf";
$filename2="edomr3-".$singper.".pdf";

$pdf->Output($filename2,'D');
//$pdf->Output($filename,'F');
//echo'<a href="test1.pdf">Download your Invoice</a>';

$pdf->output()


//header("Location:edomreport1.php")


?>