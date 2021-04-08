<?php
session_start();
define('FPDF_FONTPATH','fpdf17/font/');
require('fpdf17/edopclassonet.php');
include "../../config/koneksi.php";

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

$xkode = $_GET["kode"];
$xjnspar=2;
$jmlaspek=3;

mysqli_query($Open, "TRUNCATE TABLE edoptemp02");
mysqli_query($Open, "insert into edoptemp02 (id_parameter, parameter, aspek, jenis) 
(select id, parameter, aspek, jenis from edopparameter$sta where deleted=0)") ;
//mysqli_query($Open, "update edoptemp02 set kode='$xkode'");
mysqli_query($Open, "update edoptemp02 set kode='$xkode'");

$qscpar=mysqli_query($Open, "select id_parameter, kodedosen, aspek, jenis, round(avg(v1),2) as vv1 from edopdata$sta where jenis='$xjnspar' and kodedp='$xkode' group by id_parameter") or die ("qry scorepar : ".mysqli_error()); 
//echo mysql_num_rows($qscpar)."<br>";
while ($scpar=mysqli_fetch_array($qscpar)) {
	$sidp=$scpar['id_parameter'];
	$sv1=$scpar['vv1'];
//	echo $sidp." - ".$sv1."<br>";
	mysqli_query($Open, "update edoptemp02 set scorepar='$sv1' where id_parameter='$sidp'") ;
}

$qscpar1=mysqli_query($Open, "select id_parameter, kodedosen, aspek, jenis, round(avg(v1),2) as vv11 from edopdata$sta where jenis=3 and kodedp='$xkode' group by id_parameter") or die ("qry scorepar : ".mysqli_error()); 
//echo mysql_num_rows($qscpar)."<br>";
while ($scpar1=mysqli_fetch_array($qscpar1)) {
	$sidp1=$scpar1['id_parameter'];
	$sv11=$scpar1['vv11'];
//	echo $sidp." - ".$sv1."<br>";
	mysqli_query($Open, "update edoptemp02 set scorepar='$sv11' where id_parameter='$sidp1'") ;
}

mysqli_query($Open, "update edoptemp02 t1 inner join (select id_parameter, aspek, jenis, round(avg(scorepar),2) as vas from edoptemp02 where jenis='$xjnspar' group by aspek) as t2 
on t1.id_parameter=t2.id_parameter set t1.scoreas = t2.vas") or die("error scoreas2:".mysqli_error());

mysqli_query($Open, "update edoptemp02 t11 inner join (select id_parameter, aspek, jenis, round(sum(scoreas)/'$jmlaspek',2) as vcas from edoptemp02 where jenis='$xjnspar') as t21 
on t11.id_parameter=t21.id_parameter set t11.scoredos = t21.vcas") or die("error scoredos:".mysqli_error());


//--- end of hitung

$title='e-DOP Report.02';
$pdf = new PDF_onet();
$pdf->SetLeftMargin(20);
$pdf->AliasNbPages();

$que=mysqli_fetch_assoc(mysqli_query($Open, "select scoredos from edoptemp02 where scoredos > 0")) ;
$sscored=$que['scoredos'];

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
$subjudul="LAPORAN DOSEN per PRODI";
$pdf->SetTitle($title);
$pdf->SetDrawColor(168,168,168);

$quepot=mysqli_query($Open, "select ta, per, utsuas, kodedosen, namadosen, idprogstudi, kodemk, namamk from exoxpotensi$sta where kodedp='$xkode'") or die("error quepot : ".mysqli_error());
$sdata=mysqli_fetch_array($quepot);
$skddsn=$sdata['kodedosen'];
$snmdsn=$sdata['namadosen'];
$skdmk=$sdata['kodemk'];
$snmmk=$sdata['namamk'];
$sidp=$sdata['idprogstudi'];
$sper=$sdata['per'];
$sutsuas=$sdata['utsuas'];

$periode="Periode ".$singper;


$queprodi=mysqli_query($Open, "select kodeprodi,namaprodi, jurprodi from m_prodi where kodeprodi='$sidp'") or die(mysqli_error());
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
$pdf->ln(3);

// -- Data Dosen

$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Nama Dosen',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(97,$tgi1,$skddsn.' - '.$snmdsn,0,0,"L");
$pdf->TotalScore('Score*');
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Program Studi ',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(97,$tgi1,$sidp.' - '.$snmprodi,0,0,"L");
$pdf->TotalScore(number_format($sscored, 2, '.', ''));
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'',0,0,"L");
$pdf->cell(3,$tgi1,'',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(119,$tgi1,'',0,0,'L');		
$pdf->SetFont('Arial','I',8);
$pdf->cell(25,$tgi1,'* Skala 5',0,1,"C");
$pdf->SetFont('Arial','',9);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(5);
$pdf->SetLeftMargin(20);

$pdf->HLevel1('Aspek dan Parameter','Score');
$y=$pdf->getY();

// --- data nilai
$que1=mysqli_query($Open, "select id_parameter, parameter, aspek, scorepar, scoreas, scoredos from edoptemp02")  or die("error que1 :".mysqli_error());

while ($list=mysqli_fetch_array($que1)){
	$sid= $list['id_parameter'];
	$saspek=$list['aspek'];
	$sscorea=$list['scoreas'];
	$sscorep=$list['scorepar'];
	
    if ($sid == 1) {
		$pdf->HLevel2($saspek,number_format($sscorea, 2, '.', ''));
    }
    if ($sid == 4) {
        $pdf->ln(1);
		$pdf->HLevel2($saspek,number_format($sscorea, 2, '.', ''));
    }
    if ($sid == 9) {
        $pdf->ln(1);
		$pdf->HLevel2($saspek,number_format($sscorea, 2, '.', ''));
    }

	$pdf->SetFont('Arial','',9);
	$pdf->Cell(10,$tgi,'',0,0,"L");
	$pdf->Cell(5,$tgi,$sid.'.',0,0,"R");
	$spara=$list['parameter'];
	if (strlen($spara) > 80) {
		$spara1=substr($spara,0,strpos($spara," ",70));
		$spara2=substr($spara,strpos($spara," ",70));
		$pdf->Cell(124,$tgi,$spara1,0,0,"L");
		$pdf->Cell(25,$tgi,number_format($sscorep, 2, '.', ''),0,1,"R");
		$pdf->Cell(14,$tgi,'',0,0,"L");
		$pdf->Cell(115,$tgi,$spara2,0,1,"L");
	} else {
		$pdf->Cell(124,$tgi,$spara,0,0,"L");
		if ($sid == 6) {
		$pdf->Cell(25,$tgi,number_format($sscorep, 2, '.', '').' %',0,1,"R");
		} else {
		$pdf->Cell(25,$tgi,number_format($sscorep, 2, '.', ''),0,1,"R");
		}
	}
}

$pdf->SetDrawColor(168,168,168);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// --- 

$pdf->HLevel1('Grafik Aspek','');
$pdf->ln(1);

// --- LineGraph
$gque=mysqli_query($Open, "select distinct aspek, scoreas as nilai from edoptemp02 where scoreas > 0 order by aspek")  or die("error as:".mysqli_error());
$abc=mysqli_num_rows($gque);
$nomor=0;
$nil1 = 0;
$nil2 = 0;
$nil3 = 0;
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
}

$pdf->SetFont('Arial','',8);
$data = array(
	'Group 1' => array(
		'Perenc. PBM' => $nil1,
		'Pelaks. PBM' => $nil2,
		'Eavluasi PBM' => $nil3
	)
);
$colors = array(
	'Group 1' => array(26,109,203),
	'Group 2' => array(163,36,153)
);


///$pdf->AddPage();
$pdf->LineGraph(180,50,$data,'VHkBvB',$colors,5,10);
$pdf->SetLineWidth(0);


// -- header

$pdf->ln(60);

// --- komentar
//$pdf->AddPage();
$pdf->HLevel1('Komentar','');
$pdf->ln(1);

$pdf->SetFont('Arial','',9);
$quekom=mysqli_query($Open, "select kedop, komentar_d from exoxpotensi where kodedosen='$xkode' and komentar_d <> ''")  or die("error quekom :".mysqli_error());
$nou=0;
while ($listkom=mysqli_fetch_array($quekom)){
	$skom=$listkom['komentar_d'];
	if (strlen($skom) > 4) {
		$nou=$nou+1;
		$pdf->Cell(10,$tgi,'',0,0,"L");
		$pdf->Cell(5,$tgi,$nou.'.',0,0,"R");
		if (strlen($skom) > 95) {
			$skom1=substr($skom,0,strpos($skom," ",85));
			$skom2=substr($skom,strpos($skom," ",85));
			$pdf->Cell(110,$tgi,$skom1,0,1,"L");
			if (strlen($skom2) > 95) {
				$skom21=substr($skom2,0,strpos($skom2," ",85));
				$skom22=substr($skom2,strpos($skom2," ",85));
				$pdf->Cell(110,$tgi,$skom21,0,1,"L");
				$pdf->Cell(14,$tgi,'',0,0,"L");
				$pdf->Cell(110,$tgi,$skom22,0,1,"L");
			} else {
				$pdf->Cell(14,$tgi,'',0,0,"L");
				$pdf->Cell(110,$tgi,$skom2,0,1,"L");
			}
		} else {
			$pdf->Cell(150,$tgi,$skom,0,1,"L");
		}
	}

}

$pdf->SetDrawColor(168,168,168);
$y=$pdf->getY();
$pdf->Line(20,$y+3,190,$y+3);

$pdf->ln(4);

$pdf->SetLeftMargin(20);
$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(70,$tgi,ucwords(strtolower($_SESSION['kota_pt'])).', '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'   - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,strtoupper($_SESSION['unit']),0,1,"L");

mysqli_close($Open);

$filename="pdfoutput/edopr2-".$xkode."-".$singper.".pdf";
$filename2="edopr2-".$xkode."-".$singper.".pdf";

$pdf->Output($filename2,'D');

$pdf->output()

?>