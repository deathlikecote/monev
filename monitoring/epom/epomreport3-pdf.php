<?php
define('FPDF_FONTPATH','fpdf17/font/');
//require('fpdf17/fpdf.php');//fpdf path
require('fpdf17/epomclassonet.php');
include "../../include/koneksi.php";

function konversi_tanggal($format, $tanggal="now", $bahasa="id"){
 $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
 
 $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
 "Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September",
 "Oktober","Nopember","Desember");
 
 // tambahan untuk bahasa prancis
 // sumber http://w.blankon.in/6V
 $fr = array("dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi",
 "janvier","février","mars","avril","Mei","mai","juillet","aoùt","septembre",
 "octobre","novembre","décembre");
 
 // mengganti kata yang berada pada array en dengan array id, fr (default id)
 return str_replace($en,$$bahasa,date($format,strtotime($tanggal)));
}

// --- persiapan epomtemp03
//-- hitung juml parameter
$qry=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from epomparameter"));
$jpar=$qry['vjpar'];

$qryaspek=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(aspek) as vjaspek from epomparameter group by aspek"));
$jaspek=$qryaspek['vjaspek'];

//echo " truncate & insert....<br>";
mysqli_query($plm_edom, "TRUNCATE TABLE epomtemp03");

mysqli_query($plm_edom, "INSERT INTO epomtemp03 (idprogstudi, aspek) 
(select idprogstudi, aspek from epomdata group by idprogstudi, aspek)") or die("error insert:".mysqli_error());

//echo " update nama prodi & nama jurusan ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t31 inner join (select kodeprodi, namaprodi, jurprodi from plm.m_prodi group by kodeprodi) t32 
on t31.idprogstudi = t32.kodeprodi set t31.namaprodi=t32.namaprodi, t31.jurprodi=t32.jurprodi") or die("update prodi: ".mysqli_error());

//echo " update jumlah point & jumlah mhs ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t1 join (select idprogstudi, aspek, sum(v1) as jSC , count(id) as jSis from epomdata group by idprogstudi, aspek) t2 
on t1.idprogstudi = t2.idprogstudi and t1.aspek=t2.aspek set t1.jumlah=t2.jSC, t1.jmlmhs=t2.jSis") or die("update : ".mysqli_error());

//echo " update score aspek ...<br>";
mysqli_query($plm_edom, "update epomtemp03 set scoreas=round(jumlah/jmlmhs,2)");

//echo " update score prodi ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t1 join (select idprogstudi, aspek, sum(v1) as jSC , count(id) as jSis from epomdata group by idprogstudi) t2 
on t1.idprogstudi = t2.idprogstudi set t1.scorep=round(t2.jSC/t2.jSis,2)") or die("update : ".mysqli_error());


//echo " update score prodi ...<br>";
//mysqli_query("update epomtemp03 t11 join (select idprogstudi, round(avg(scoreas),2) as jtot from epomtemp03 group by idprogstudi) t12 
//on t11.idprogstudi = t12.idprogstudi set t11.scorep=t12.jtot") or die("update scorep : ".mysqli_error());


//echo " update score jurusan ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t21 join (select jurprodi, round(avg(scorep),2) as jtotp from epomtemp03 group by jurprodi) t22 
on t21.jurprodi = t22.jurprodi set t21.scorej=t22.jtotp") or die("update scorej : ".mysqli_error());

//--- end of epomtemp03

$title="e-POM Report.03";
//$pdf = new PDF();
$pdf = new PDF_onet();
$pdf->AliasNbPages();

$qpot=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(nim) as vpot from epompotensi where idprogstudi=''"))  or die("error as:".mysqli_error());
$spotsis=$qpot['vpot'];

$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','',9);
$pdf->SetLeftMargin(20);
$aspeka=1;
$aspekb=10;
$aspekc=17;
$aspekd=22;
$tgi=4;
$tgi1=5;
$tgiaspek=7;
$lbraspek=145;
$spm='@2017-Pusat Penjaminan Mutu Poltekpar Palembang';
$spmh='PUSAT PENJAMINAN MUTU';
$judul="EVALUASI PROGRAM STUDI OLEH MAHASISWA";
$subjudul="LAPORAN EVALUASI JURUSAN";
$pdf->SetTitle($title);
$pdf->SetDrawColor(168,168,168);

$quepot=mysqli_query($plm_edom, "select ta, per, utsuas, idprogstudi from epompotensi where id=1") or die("quepot : ".mysqli_error());
$sdata=mysqli_fetch_array($quepot);
$sidp=$sdata['idprogstudi'];
$sta=$_SESSION['pertan'];
$sper=$sdata['per'];
$sutsuas=$sdata['utsuas'];
$singper=$_SESSION['pertan'];

$periode="Periode ".$sta;

// -- logo + title 
$pdf->SetFont('Arial','',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(3);

// -- Header Kelas
//---

//-rencana pengganti header $pdf->HEpomR01($snmprodi,$sjur,$sidp.' / '.$skls,$sscorek);
$pdf->HLevel1('Nama Jurusan & Prodi', 'Score');

$anmjx='';
$anmpx='';
$anmax='';
$nom=0;
$lopaspek=0;
$scoreprodi=0;

// --- data nilai
$que1=mysqli_query($plm_edom, "select idprogstudi, namaprodi, jurprodi, aspek, scoreas, scorep, scorej from epomtemp03 order by jurprodi,idprogstudi,aspek")  or die("error que1:".mysqli_error());
while ($list=mysqli_fetch_array($que1)){
	$aidp= $list['idprogstudi'];
	$anmp=$list['namaprodi'];
	$anmj=$list['jurprodi'];
	$anma=$list['aspek'];
	$ascorea=$list['scoreas'];
	$ascorep=$list['scorep'];
	$ascorej=$list['scorej'];
	$lopaspek=$lopaspek+1;

	if ($ascorep <> 0) {
	$scoreprodi=$ascorep;
	}

	if ($anmj <> $anmjx) {
		$pdf->SetLeftMargin(25);
		$pdf->HLevel21($anmj,number_format($ascorej, 2, '.', ''),'A','B','C','D','TOT');
		$nom=1;
		$anmjx=$anmj;
		$nom=0;
	}
if ($anmp <> $anmpx) {
		$anmpx=$anmp;
		$nom=$nom+1;
		$pdf->Cell(5,$tgi1,'',0,0,"L");
		$pdf->Cell(5,$tgi1,$nom.'.',0,0,"R");
		$pdf->Cell(85,$tgi1,$anmp,0,0,"L");
		$que11=mysqli_query($plm_edom, "select * from v_epom_sum where idprogstudi='$aidp'")  or die("error que1:".mysqli_error());
		$list1=mysqli_fetch_array($que11);
		$nilaia=$list1['a'];
		$nilaib=$list1['b'];
		$nilaic=$list1['c'];
		$nilaid=$list1['d'];
	//}
	//if ($anmp = $anmpx) {
		//if ($lopaspek = 1) {
			$pdf->Cell(5,$tgi1,number_format($nilaia, 2, '.', ''),0,0,"C");
		//} elseif ($lopaspek = 2) {
			$pdf->Cell(5,$tgi1,'',0,0,"L");
			$pdf->Cell(5,$tgi1,number_format($nilaib, 2, '.', ''),0,0,"C");
		//} elseif ($lopaspek = 3) {
		//	$pdf->Cell(5,$tgi1,'',0,0,"L");
			$pdf->Cell(5,$tgi1,'',0,0,"L");
			$pdf->Cell(5,$tgi1,number_format($nilaic, 2, '.', ''),0,0,"C");
		//} elseif ($lopaspek = 4) {
		//	$pdf->Cell(5,$tgi1,'',0,0,"L");
		//	$pdf->Cell(5,$tgi1,'',0,0,"L");
			$pdf->Cell(5,$tgi1,'',0,0,"L");
			$pdf->Cell(5,$tgi1,number_format($nilaid, 2, '.', ''),0,0,"C");
			$pdf->Cell(5,$tgi1,'',0,0,"L");
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(10,$tgi1,number_format($scoreprodi, 2, '.', ''),0,1,"C");
			$pdf->SetFont('Arial','',9);
			$lopaspek=0;
		//}
	
	}

}

$pdf->Cell(5,$tgi,'',0,1,"L");
$ket='A - Administrasi | B - Kompetensi Profesional | C - Sarana dan Prasarana | D - Program (Teori & Praktek) | TOT - Total Score';
$pdf->SetFont('Arial','I',8);
$pdf->Cell(6,$tgi,'Ket',0,0,"L");
$pdf->Cell(155,$tgi,$ket,0,1,"L");
$pdf->Cell(6,$tgi,'',0,0,"L");
$pdf->Cell(154,$tgi,'Score adalah skala 5',0,1,"L");

$pdf->SetFont('Arial','',9);

$pdf->SetDrawColor(168,168,168);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// --- 

$pdf->ln(3);
$pdf->SetLeftMargin(20);
$pdf->HLevel1('Grafik Aspek','');
$pdf->ln(1);

$pdf->setx(10);
$pdf->SetLeftMargin(30);
// --- LineGraph
$gque=mysqli_query($plm_edom, "select distinct jurprodi, scorej as nilai from epomtemp03 order by jurprodi")  or die("error gque:".mysqli_error());
$abc=mysqli_num_rows($gque);
$nomor=0;
$nil1 =0;
$nil2 =0;
$nil3 =0;
$nil4 =0;
while ($lque=mysqli_fetch_array($gque)) {
	//$saspek=substr($lque['aspek'],0,1);
	$nomor=$nomor+1;
	if ($nomor==1) {
	$nil1=$lque['nilai'];
	}
	if ($nomor==2) {
	$nil2=$lque['nilai'];
	}
	if ($nomor==3) {
	$nil3=$lque['nilai'];
	}
	if ($nomor==4) {
	$nil4=$lque['nilai'];
	}
}

///$pdf = new PDF_LineGraph();
$pdf->SetFont('Arial','',8);
$data = array(
	'Group 1' => array(
		'Hospitaliti' => $nil1,
		'Kepariwisataan' => $nil2,
		'Pascasarjana' => $nil3,
		'Perjalanan' => $nil4,
		
	)
);
$colors = array(
	'Group 1' => array(26,109,203),
	'Group 2' => array(163,36,153)
);

$pdf->SetLeftMargin(20);
$pdf->LineGraph(180,50,$data,'VHkBvB',$colors,5,10);

$pdf->SetLineWidth(0);
$pdf->ln(52);
$pdf->Cell(19,$tgi,'',0,0,"L");
$pdf->Cell(42,$tgi,'('.number_format($nil1, 2, '.', '').')',0,0,"L");
$pdf->Cell(42,$tgi,'('.number_format($nil2, 2, '.', '').')',0,0,"L");
$pdf->Cell(42,$tgi,'('.number_format($nil3, 2, '.', '').')',0,0,"L");
$pdf->Cell(10,$tgi,'('.number_format($nil4, 2, '.', '').')',0,0,"R");

$pdf->SetDrawColor(168,168,168);
$y=$pdf->getY();
$pdf->Line(20,$y+5,190,$y+5);

$pdf->ln(3);

$pdf->SetLeftMargin(20);
$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(70,$tgi,'Palembang, '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'   - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'PPM Poltekpar Palembang',0,1,"L");


mysqli_close($plm_edom);

//$filename="test1.pdf";
$filename="pdfoutput/epomr3-".$singper.".pdf";
$filename2="epomr3-".$singper.".pdf";

$pdf->Output($filename2,'D');
//$pdf->Output($filename,'F');
//echo'<a href="test1.pdf">Download your Invoice</a>';

$pdf->output()

?>