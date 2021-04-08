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
}else{
	$sta='';
}

$xkode = $_GET["kodex"];
//$xkode='acpBIDMPI';

mysqli_query($Open, "TRUNCATE TABLE edoptemp01");


//-- ambil id dari exox
$qryid=mysqli_fetch_assoc(mysqli_query($Open, "select id as vid from exoxpotensi$sta where kedop='$xkode'")) or die("select id from exox : ".mysqli_error());
$xid=$qryid['vid'];

//echo $xid."<br>";

$xjnspar=2;
$qhitpar=mysqli_fetch_assoc(mysqli_query($Open, "select count(parameter) as vjpar from edopparameter$sta where jenis='$xjnspar' and deleted=0")) or die("select id from exox : ".mysqli_error());
$xjpar=$qhitpar['vjpar'];

//echo $xjpar."<br>";


//--- insert total nilai (sum) berd. parameter dari eedopdata$sta
mysqli_query($Open, "INSERT INTO edoptemp01 (id_parameter, parameter, aspek, jenis, jumlah) 
(select id_parameter, parameter, aspek, jenis, sum(v1) as jumlah from edopdata$sta where id_potensi='$xid' group by id_parameter)") or die("error insert:".mysqli_error());

// scorepar
mysqli_query($Open, "update edoptemp01 set scorepar=jumlah, kode='$xkode'");

// scoreas
mysqli_query($Open, "update edoptemp01 t1 inner join (select id_parameter, aspek, jenis, round(avg(jumlah),2) as vas from edoptemp01 where jenis='$xjnspar' group by aspek) as t2 
on t1.id_parameter=t2.id_parameter set t1.scoreas = t2.vas") or die("error scoreas2:".mysqli_error());

// scoreas
mysqli_query($Open, "update edoptemp01 t11 inner join (select id_parameter, aspek, jenis, round(sum(scoreas)/3,2) as vdos from edoptemp01 where jenis='$xjnspar') as t21 
on t11.id_parameter=t21.id_parameter set t11.scoredos = t21.vdos") or die("error scoredos:".mysqli_error());

//--- end of hitung

$title='e-DOP Report.01';
$pdf = new PDF_onet();
$pdf->SetLeftMargin(20);
$pdf->AliasNbPages();
$que=mysqli_fetch_assoc(mysqli_query($Open, "select scoredos from edoptemp01 where scoredos > 0")) or die("error que:".mysqli_error());
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
$subjudul="LAPORAN PER DOSEN";
$title="e-DOP";
$pdf->SetTitle($title);
$pdf->SetDrawColor(168,168,168);

$quepot=mysqli_query($Open, "select ta, per, utsuas, kodedosen, namadosen, idprogstudi, kodemk, namamk from exoxpotensi$sta where kedop='$xkode'") or die("error quepot : ".mysqli_error());
$sdata=mysqli_fetch_array($quepot);
$skddsn=$sdata['kodedosen'];
$snmdsn=$sdata['namadosen'];
$skdmk=$sdata['kodemk'];
$snmmk=$sdata['namamk'];
$sidp=$sdata['idprogstudi'];
$sper=$sdata['per'];
$sutsuas=$sdata['utsuas'];


	$periode="Periode ".$singper;


$queprodi=mysqli_query($plm, "select kodeprodi,namaprodi, jurprodi from m_prodi where kodeprodi='$sidp'") or die(mysqli_error());
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
$pdf->cell(23,$tgi1,'Mata Kuliah',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(97,$tgi1,$skdmk.' - '.$snmmk,0,0,"L");
$pdf->TotalScore(number_format($sscored, 2, '.', ''));
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Program Studi',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(119,$tgi1,$sidp.' - '.$snmprodi,0,0,'L');		
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
$que1=mysqli_query($Open, "select id_parameter, parameter, aspek, scorepar, scoreas, scoredos from edoptemp01")  or die("error que1 :".mysqli_error());

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
$gque=mysqli_query($Open, "select distinct aspek, scoreas as nilai from edoptemp01 where scoreas > 0 order by aspek")  or die("error as:".mysqli_error());
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
/// Display options: all (horizontal and vertical lines, 4 bounding boxes)
/// Colors: fixed
/// Max ordinate: 6
/// Number of divisions: 3
///$pdf->LineGraph(190,100,$data,'VHkBvBgBdB',$colors,6,3);
$pdf->LineGraph(180,50,$data,'VHkBvB',$colors,5,10);
$pdf->SetLineWidth(0);
$pdf->ln(52);
$pdf->Cell(19,$tgi,'',0,0,"L");
//pdf->Cell(150,$tgi,' Score [ Adm. ( '.number_format($nil1, 2, '.', '').' ) - Kom.Prof. ( '.number_format($nil2, 2, '.', '').' ) - SarPras ( '.number_format($nil3, 2, '.', '').' ) - Program ( '.number_format($nil4, 2, '.', '').' ) ]',0,1,"L");
$pdf->Cell(55,$tgi,'('.number_format($nil1, 2, '.', '').')',0,0,"L");
$pdf->Cell(55,$tgi,'('.number_format($nil2, 2, '.', '').')',0,0,"L");
$pdf->Cell(18,$tgi,'('.number_format($nil3, 2, '.', '').')',0,0,"R");

// -- header

$pdf->ln(80);

// --- komentar
$pdf->AddPage('P','A4');
$pdf->setx(10);
$pdf->SetLeftMargin(20);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
$pdf->ln(3);
$pdf->HLevel1('Komentar','');
$pdf->ln(1);

$pdf->SetFont('Arial','',9);
$quekom=mysqli_query($Open, "select kedop, komentar_d from exoxpotensi$sta where kedop='$xkode' and komentar_d <> ''")  or die("error quekom :".mysqli_error());
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




//$filename="test1.pdf";
$filename="pdfoutput/edopr1-".$xkode."-".$singper.".pdf";
$filename2="edopr1-".$xkode."-".$singper.".pdf";

$pdf->Output($filename2,'D');
//$pdf->Output($filename,'F');
//echo'<a href="test1.pdf">Download your Invoice</a>';

$pdf->output()

?>