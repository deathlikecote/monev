<?php
session_start();
define('FPDF_FONTPATH','../fpdf17/font/');
require('../fpdf17/epomclassonet.php');
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
}else{
	$sta='';
}
$kode = $_GET["kodex"];
mysqli_query($Open, "truncate table epomtemp01");

//hitung jumlah parameter
$qjpar=mysqli_fetch_assoc(mysqli_query($Open, "select count(id) as jmlpar from epomparameter$sta where deleted=0"));
$vjpar=$qjpar['jmlpar'];

//hitung jumlah siswa yang mengisi quesioner
$qjsis=mysqli_fetch_assoc(mysqli_query($Open, "select count(id) as jmlsis from epomdata$sta where kode='$kode'"));
$vjsis=$qjsis['jmlsis']/$vjpar;

mysqli_query($Open, "INSERT INTO epomtemp01 (kode, id_parameter, parameter, aspek, jumlah) 
(select kode, id_parameter, parameter, aspek, sum(v1) as jumlah from epomdata$sta where kode='$kode' group by id_parameter)");

mysqli_query($Open, "UPDATE epomtemp01 SET jmlmhs='$vjsis', scorepar=jumlah/'$vjsis'");
//-ok mysqli_query("update edomtemp01 tt1 inner join (select kode, aspek, avg(scorepar) as vscoreas from edomtemp01 group by kode, aspek) tt2 on tt1.aspek = tt2.aspek set tt1.scoreas = tt2.vscoreas")  or die("error as:".mysql_error());

mysqli_query($Open, "UPDATE epomtemp01 t11 
INNER JOIN (select aspek, AVG(scorepar) as vspar FROM epomtemp01 GROUP BY aspek) t21 ON t11.aspek=t21.aspek SET t11.scoreas=t21.vspar");

mysqli_query($Open, "UPDATE epomtemp01 t111 
INNER JOIN (select aspek, AVG(scoreas) as vsas FROM epomtemp01) t211 SET t111.scorekls=t211.vsas");

//--- end of epomtemp01

$title="e-POM Report.01";

//$pdf = new PDF();
$pdf = new PDF_onet();
$pdf->AliasNbPages();

$xkode = $_GET["kodex"];

if (strlen($xkode) == 6) {
   $pprodi=substr($xkode,0,3);
   $pkls=substr($xkode,3,3);
} 
if (strlen($xkode) == 5) {
   $pprodi=substr($xkode,0,4);
   $pkls=trim(substr($xkode,4,3));
}
if (strlen($xkode) == 4) {
   $pprodi=substr($xkode,0,3);
   $pkls=trim(substr($xkode,3,1));
}

$que=mysqli_query($Open, "select id, parameter, aspek, scorepar, scoreas, scorekls, kode, jmlmhs from epomtemp01 where kode='$xkode' order by id");
$quetem=mysqli_fetch_array($que);
$skodedsn=$quetem['kode'];
$sjmlmhs=$quetem['jmlmhs'];
$sscorek=$quetem['scorekls'];

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
$judul="EVALUASI PROGRAM STUDI OLEH MAHASISWA";
$subjudul="LAPORAN per KELAS";
$pdf->SetTitle($title);
$pdf->SetDrawColor(168,168,168);

$quepot=mysqli_query($Open, "select ta, per, utsuas, idprogstudi, kelas_id from epompotensi$sta where kode='$xkode'");
$sdata=mysqli_fetch_array($quepot);
$skls=$sdata['kelas_id'];
$sidp=$sdata['idprogstudi'];
$sper=$sdata['per'];
$sutsuas=$sdata['utsuas'];
$periode="Periode ".$singper;

$queprodi=mysqli_query($plm, "select kodeprodi,namaprodi, jurprodi from m_prodi where kodeprodi='$sidp'");
$squeprodi1=mysqli_fetch_array($queprodi);
$snmprodi=$squeprodi1['namaprodi'];
$sjur=$squeprodi1['jurprodi'];

// -- logo + title 
$pdf->SetFont('Arial','',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
//$y=$pdf->getY();
//$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// -- Header Kelas
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Program Studi',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(119,$tgi1,$snmprodi,0,0,'L');		
$pdf->TotalScore('Score*');
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Jurusan',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(119,$tgi1,$sjur,0,0,'L');	
$pdf->TotalScore(number_format($sscorek, 2, '.', ''));
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Kelas',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(118,$tgi1,$sidp.' / '.$skls,0,0,"L");
$pdf->SetFont('Arial','I',8);
$pdf->cell(25,$tgi1,'* Skala 5',0,1,"C");
$pdf->SetFont('Arial','',9);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(4);
$pdf->SetLeftMargin(20);
//---

//-rencana pengganti header $pdf->HEpomR01($snmprodi,$sjur,$sidp.' / '.$skls,$sscorek);
$pdf->HLevel1('Aspek & Parameter', 'Score');


// --- data nilai
$que1=mysqli_query($Open, "select id_parameter, parameter, aspek, scorepar, scoreas, kode, jmlmhs from epomtemp01 where kode='$xkode' order by id_parameter");
while ($list=mysqli_fetch_array($que1)){
	$sid= $list['id_parameter'];
	$saspek=$list['aspek'];
	$sscorea=$list['scoreas'];
	$sscorep=$list['scorepar'];
	$skodedosen=$list['kode'];

	$pdf->SetLeftMargin(25);
	
    if ($sid == 1) {
		$pdf->HLevel2($saspek,number_format($sscorea, 2, '.', ''));
    }
    if ($sid == 10) {
        $pdf->ln(1);
		$pdf->HLevel2($saspek,number_format($sscorea, 2, '.', ''));
//		$pdf->Cell($lbraspek,$tgiaspek,$saspek,0,0,"L");
//		$pdf->Cell(8,$tgiaspek,number_format($sscorea, 2, '.', ''),0,1,"L");
    }
    if ($sid == 17) {
        $pdf->ln(1);
		$pdf->HLevel2($saspek,number_format($sscorea, 2, '.', ''));
    }
    if ($sid == 22) {
        $pdf->ln(1);
		$pdf->HLevel2($saspek,number_format($sscorea, 2, '.', ''));
    }

	$pdf->SetLeftMargin(30);

	$pdf->SetFont('Arial','',9);
	$pdf->Cell(5,$tgi,$sid.'.',0,0,"R");
	$spara=$list['parameter'];
	if (strlen($spara) > 80) {
		$spara1=substr($spara,0,strpos($spara," ",70));
		$spara2=substr($spara,strpos($spara," ",70));
		$pdf->Cell(124,$tgi,$spara1,0,0,"L");
		$pdf->Cell(25,$tgi,number_format($sscorep, 2, '.', ''),0,1,"R");
		$pdf->setx(34);
		$pdf->Cell(115,$tgi,$spara2,0,1,"L");
		$pdf->SetLeftMargin(30);

	} else {
		$pdf->Cell(124,$tgi,$spara,0,0,"L");
		$pdf->Cell(25,$tgi,number_format($sscorep, 2, '.', ''),0,1,"R");
	}
}

$pdf->SetDrawColor(168,168,168);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// --- 

// -- header

$pdf->SetLeftMargin(20);
$pdf->AddPage('P','A4');
$pdf->setx(10);
$pdf->SetLeftMargin(20);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
//$pdf->SetDrawColor(168,168,168);
//$y=$pdf->getY();
//$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// -- Header Kelas

$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Program Studi',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(119,$tgi1,$snmprodi,0,0,'L');		
$pdf->TotalScore('Score*');
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Jurusan',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(119,$tgi1,$sjur,0,0,'L');	
$pdf->TotalScore(number_format($sscorek, 2, '.', ''));
$pdf->SetFont('Arial','B',9);
$pdf->cell(23,$tgi1,'Kelas',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','',9);
$pdf->cell(118,$tgi1,$sidp.' / '.$skls,0,0,"L");
$pdf->SetFont('Arial','I',8);
$pdf->cell(25,$tgi1,'* Skala 5',0,1,"C");
$pdf->SetFont('Arial','',9);
$y=$pdf->getY();
$pdf->SetDrawColor(168,168,168);
$pdf->Line(20,$y+2,190,$y+2);

$pdf->ln(4);

$pdf->HLevel1('Grafik Aspek','');
$pdf->ln(1);

$pdf->setx(10);
$pdf->SetLeftMargin(30);
// --- LineGraph
$gque=mysqli_query($Open, "select distinct aspek, scoreas as nilai from epomtemp01 where kode='$xkode'");
$abc=mysqli_num_rows($gque);
$nomor=0;
while ($lque=mysqli_fetch_array($gque)) {
	$saspek=substr($lque['aspek'],0,1);
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
		'Administrasi' => $nil1,
		'Kompetensi Profesional' => $nil2,
		'Sarana & Prasarana' => $nil3,
		'Program' => $nil4
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
//pdf->Cell(150,$tgi,' Score [ Adm. ( '.number_format($nil1, 2, '.', '').' ) - Kom.Prof. ( '.number_format($nil2, 2, '.', '').' ) - SarPras ( '.number_format($nil3, 2, '.', '').' ) - Program ( '.number_format($nil4, 2, '.', '').' ) ]',0,1,"L");
$pdf->Cell(42,$tgi,'('.number_format($nil1, 2, '.', '').')',0,0,"L");
$pdf->Cell(43,$tgi,'('.number_format($nil2, 2, '.', '').')',0,0,"L");
$pdf->Cell(41,$tgi,'('.number_format($nil3, 2, '.', '').')',0,0,"L");
$pdf->Cell(10,$tgi,'('.number_format($nil4, 2, '.', '').')',0,0,"L");

// --- komentar
$pdf->ln(7);
$pdf->HLevel1('Komentar','');
$pdf->ln(1);

$pdf->SetLeftMargin(30);
$pdf->SetFont('Arial','',9);
$quekom=mysqli_query($Open, "select kode, komentar from epompotensi$sta where idprogstudi='$pprodi' and kelas_id='$pkls' and komentar <> ''");
$nou=0;
while ($listkom=mysqli_fetch_array($quekom)){
    $cekline=$pdf->getY();

if ($cekline > 250) {

	// -- header
	$pdf->SetLeftMargin(20);
	$pdf->AddPage('P','A4');
	$pdf->SetLeftMargin(20);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(170,6,$judul,0,1,"C");
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(170,6,$subjudul,0,1,"C");
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(170,5,$periode,0,1,"C");
	$pdf->ln(3);

	// -- Header Kelas
	$pdf->SetFont('Arial','',9);
	$pdf->cell(23,$tgi1,'Program Studi',0,0,"L");
	$pdf->cell(3,$tgi1,':',0,0,"C");
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(119,$tgi1,$snmprodi,0,0,'L');		
	$pdf->TotalScore('Score*');
	$pdf->SetFont('Arial','',9);
	$pdf->cell(23,$tgi1,'Jurusan',0,0,"L");
	$pdf->cell(3,$tgi1,':',0,0,"C");
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(119,$tgi1,$sjur,0,0,'L');	
	$pdf->TotalScore(number_format($sscorek, 2, '.', ''));
	$pdf->SetFont('Arial','',9);
	$pdf->cell(23,$tgi1,'Kelas',0,0,"L");
	$pdf->cell(3,$tgi1,':',0,0,"C");
	$pdf->SetFont('Arial','B',9);
	$pdf->cell(118,$tgi1,$sidp.' / '.$skls,0,0,"L");
	$pdf->SetFont('Arial','I',8);
	$pdf->cell(25,$tgi1,'* Skala 5',0,1,"C");
	$pdf->SetFont('Arial','',9);
	$y=$pdf->getY();
	$pdf->SetDrawColor(168,168,168);
	$pdf->Line(20,$y+2,190,$y+2);
	$pdf->ln(4);
    
}

	$pdf->SetLeftMargin(30);
	$skom=$listkom['komentar'];
	if (strlen($skom) > 4) {
		$pdf->SetLeftMargin(30);
		$nou=$nou+1;
		$pdf->Cell(5,$tgi,$nou.'.',0,0,"R");
		if (strlen($skom) > 95) {
			$skom1=substr($skom,0,strpos($skom," ",85));
			$skom2=substr($skom,strpos($skom," ",85));
			$pdf->Cell(110,$tgi,$skom1,0,1,"L");
			//$pdf->setx(34);
			if (strlen($skom2) > 95) {
				$skom21=substr($skom2,0,strpos($skom2," ",85));
				$skom22=substr($skom2,strpos($skom2," ",85));
				$pdf->Cell(4,$tgi,'',0,0,"R");
				$pdf->Cell(110,$tgi,$skom21,0,1,"L");
			if (strlen($skom22) > 95) {
				$skom221=substr($skom22,0,strpos($skom22," ",85));
				$skom222=substr($skom22,strpos($skom22," ",85));
				$pdf->Cell(110,$tgi,$skom221,0,1,"L");
				$pdf->Cell(4,$tgi,'',0,0,"R");
				$pdf->Cell(110,$tgi,$skom222,0,1,"L");
			} else {
				$pdf->Cell(4,$tgi,'',0,0,"R");
				$pdf->Cell(110,$tgi,$skom22,0,1,"L");
			}
			} else {
				$pdf->Cell(4,$tgi,'',0,0,"R");
				$pdf->Cell(110,$tgi,$skom2,0,1,"L");
			}
		} else {
			$pdf->Cell(150,$tgi,$skom,0,1,"L");
		}
	}

}
$pdf->SetDrawColor(168,168,168);
$y=$pdf->getY();
$pdf->Line(20,$y+3,190,$y+2);

$pdf->ln(3);

$pdf->SetLeftMargin(20);
$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(70,$tgi,ucwords(strtolower($_SESSION['kota_pt'])).', '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'   - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,strtoupper($_SESSION['unit']),0,1,"L");


mysqli_close($Open);

$filename="pdfoutput/epomr1-".$skodedsn."-".$singper.".pdf";
$filename2="epomr1-".$skodedsn."-".$singper.".pdf";

$pdf->Output($filename2,'D');

$pdf->output()


?>