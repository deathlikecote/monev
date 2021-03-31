<?php
session_start();
define('FPDF_FONTPATH','fpdf17/font/');
require('fpdf17/edomclassonet.php');
include "../../config/koneksi.php";

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


$title='e-DOM Report.01';
//$pdf = new PDF();
$pdf = new PDF_onet();
$pdf->AliasNbPages();
$xkode = $_GET['kode'];
$perta = $_GET['perta'];
$pertaberjalan = $_SESSION['perta'];
if($perta == $pertaberjalan){
$edomdatas = "edomdata";
$edompotensis = "edompotensi";
}else{
$edompotensis = "edompotensi".$perta;
$edomdatas = "edomdata".$perta;
}
//- hitung jumlah parameter kuesioner
$qryp=mysqli_fetch_assoc(mysqli_query($Open, "SELECT count(parameter) AS vjpar FROM edomparameter"));
$jpar=$qryp['vjpar'];


//-edomtemp01
mysqli_query($Open, "TRUNCATE TABLE edomtemp01");
$qry01=mysqli_query($Open, "SELECT kode, id_parameter, parameter, jenis, aspek, sum(v1) AS jumlah FROM ".$edomdatas." WHERE kode='$xkode' GROUP BY kode,id_parameter") OR die("error as:".mysql_error());
while ($list=mysqli_fetch_array($qry01)) {
	$vkode=$list['kode'];
	$vid=$list['id_parameter'];
	$vpar=$list['parameter'];
	$vaspek=$list['aspek'];
	$vjml=$list['jumlah'];
	$vjenis=$list['jenis'];
	mysqli_query($Open, "INSERT INTO edomtemp01 (kode,id_parameter,parameter,aspek,jumlah,jenis) VALUES ('$vkode', '$vid', '$vpar', '$vaspek', '$vjml', '$vjenis')") or die("error insert:".mysql_error());
}

mysqli_query($Open, "update edomtemp01 t1 inner join (SELECT kode, count(kode)/'$jpar' as jsiswa from ".$edomdatas." where kode='$xkode') t2 on t1.kode = t2.kode set jmlmhs=jsiswa") or die("error jsiswa:".mysql_error());
//hitung score : par/as/dos pada tabel edomtemp01
mysqli_query($Open, "update edomtemp01 set scorepar=jumlah/jmlmhs") or die("error scorepar:".mysql_error());
mysqli_query($Open, "update edomtemp01 tt1 inner join (SELECT kode, aspek, avg(scorepar) as vscoreas from edomtemp01 where kode='$xkode' and jenis !='3' group by aspek) tt2 on tt1.aspek = tt2.aspek set tt1.scoreas = tt2.vscoreas")  or die("error as:".mysql_error());
mysqli_query($Open, "update edomtemp01 ttt1 inner join (SELECT kode, avg(scoreas) as vscoredos from edomtemp01 where kode='$xkode' ) ttt2 on ttt1.kode = ttt2.kode set ttt1.scoredos = ttt2.vscoredos")  or die("error as:".mysql_error());

$que2 = mysqli_query($Open, "SELECT sum(scoreas)/count(*) as scoredosx from (SELECT scoreas from edomtemp01 group by aspek) as tt")  or die("error as:".mysql_error());
$quetem2=mysqli_fetch_array($que2);

$que=mysqli_query($Open, "SELECT id, parameter, aspek, scorepar, scoreas, scoredos, kode, jmlmhs from edomtemp01 where kode='$xkode' order by id")  or die("error as:".mysql_error());
$quetem=mysqli_fetch_array($que);
$skodedsn=$quetem['kode'];
$sjmlmhs=$quetem['jmlmhs'];
$sscored=$quetem['scoredos'];

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
$judul="EVALUASI DOSEN OLEH MAHASISWA";
$subjudul="LAPORAN PER MATA KULIAH";
$pdf->SetTitle($title);
$pdf->SetDrawColor(168,168,168);

$quepot=mysqli_query($Open, "SELECT ta, per, utsuas, kodedosen, namadosen, idprogstudi, kodemk, namamk, kelas from ".$edompotensis." where kode='$xkode'") or die(mysql_error());
$sdata=mysqli_fetch_array($quepot);
$skddsn=$sdata['kodedosen'];
$snmdsn=$sdata['namadosen'];
$skdmk=$sdata['kodemk'];
$snmmk=$sdata['namamk'];
$skls=$sdata['kelas'];
$sidp=$sdata['idprogstudi'];
$sta=$sdata['ta'];
$sper=$sdata['per'];
$sutsuas=$sdata['utsuas'];
$singper=$_SESSION['perta'];

$periode="T.A. ".$perta;

$queprodi=mysqli_query($plm, "SELECT kodeprodi,namaprodi from m_prodi where kodeprodi='$sidp'") or die(mysql_error());
$squeprodi1=mysqli_fetch_array($queprodi);
$snmprodi=$squeprodi1['namaprodi'];

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
$pdf->Cell(119,$tgi1,$snmprodi,0,0,'L');		
$pdf->SetFont('Arial','I',8);
$pdf->cell(25,$tgi1,'* Skala 5',0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi1,'Kelas',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(103,$tgi1,$sidp.' / '.$skls,0,0,"L");
$pdf->SetFont('Arial','',9);
$pdf->cell(25,$tgi1,'Jml. Pengisi',0,0,"R");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(25,$tgi1,$sjmlmhs." siswa",0,1,"L");
$pdf->SetFont('Arial','',9);
//$pdf->SetDrawColor(168,168,168);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);

$pdf->ln(5);
$pdf->SetLeftMargin(20);

//$pdf->SetFont('Arial','B',9);
//$pdf->cell(145,$tgi+4,'Aspek dan Parameter',0,0,"L");
//$pdf->cell(25,$tgi+4,'Score',0,1,"C");
$pdf->HLevel1('Aspek dan Parameter','Score');

$y=$pdf->getY();

// --- data nilai
$que1=mysqli_query($Open, "SELECT id_parameter, jenis, parameter, aspek, scorepar, scoreas, scoredos, kode, jmlmhs from edomtemp01 where kode='$xkode' order by id_parameter")  or die("error as:".mysql_error());

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
	/*if (strlen($spara) > 80) {
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
	}*/
	$sjenis=$list['jenis'];
	if (strlen($spara) > 80) {
		$spara1=substr($spara,0,strpos($spara," ",70));
		$spara2=substr($spara,strpos($spara," ",70));
		$pdf->Cell(124,$tgi,$spara1,0,0,"L");
		if($sjenis == '3'){
			$pdf->Cell(25,$tgi,number_format($sscorep, 2, '.', '').' %',0,1,"R");
		}else{
		$pdf->Cell(25,$tgi,number_format($sscorep, 2, '.', ''),0,1,"R");	
		}
		
		$pdf->setx(34);
		$pdf->Cell(115,$tgi,$spara2,0,1,"L");
		$pdf->SetLeftMargin(30);

	} else {
		$pdf->Cell(124,$tgi,$spara,0,0,"L");
		if($sjenis == '3'){
			$pdf->Cell(29,$tgi,number_format($sscorep, 2, '.', '').' %',0,1,"R");
		}else{
		$pdf->Cell(25,$tgi,number_format($sscorep, 2, '.', ''),0,1,"R");
	}
	}
}

$pdf->SetDrawColor(168,168,168);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);

// --- 

$pdf->setx(10);
$pdf->HLevel1('Grafik Aspek','');
$pdf->ln(1);

$pdf->setx(10);
$pdf->SetLeftMargin(30);
// --- LineGraph
$gque=mysqli_query($Open, "SELECT distinct aspek, scoreas as nilai from edomtemp01 where kode='$xkode'")  or die("error as:".mysql_error());
$abc=mysqli_num_rows($gque);
$nomor=0;
$nil1 = 0;
$nil2 = 0;
$nil3 = 0;
$nil4 = 0;
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
		'pedagogik' => $nil1,
		'professional' => $nil2,
		'kepribadian' => $nil3,
		'sosial' => $nil4
	)
);
$colors = array(
	'Group 1' => array(26,109,203),
	'Group 2' => array(163,36,153)
);

$pdf->SetLeftMargin(20);

///$pdf->AddPage();
/// Display options: all (horizontal and vertical lines, 4 bounding boxes)
/// Colors: fixed
/// Max ordinate: 6
/// Number of divisions: 3
///$pdf->LineGraph(190,100,$data,'VHkBvBgBdB',$colors,6,3);
$pdf->LineGraph(180,50,$data,'VHkBvB',$colors,5,10);
$pdf->SetLineWidth(0);


// -- header
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

// -- Data Dosen

$pdf->SetFont('Arial','',9);

$pdf->cell(23,$tgi,'Nama Dosen',0,0,"L");
$pdf->cell(3,$tgi,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(95,$tgi,$skddsn.' - '.$snmdsn,0,0,"L");
$pdf->SetFont('Arial','',9);
$pdf->cell(30,$tgi,'Kelas',0,0,"L");
$pdf->cell(3,$tgi,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(25,$tgi,$sidp.' / '.$skls,0,1,"L");
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi,'Mata Kuliah',0,0,"L");
$pdf->cell(3,$tgi,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(95,$tgi,$skdmk.' - '.$snmmk,0,0,"L");
$pdf->SetFont('Arial','',9);
$pdf->cell(30,$tgi,'Jml. Pengisi',0,0,"L");
$pdf->cell(3,$tgi,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(25,$tgi,$sjmlmhs." siswa",0,1,"L");
$pdf->SetFont('Arial','',9);
$pdf->cell(23,$tgi,'Program Studi',0,0,"L");
$pdf->cell(3,$tgi,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(95,$tgi,$snmprodi,0,0,'L');		
//$pdf->setx(143);
$pdf->SetFont('Arial','',9);
$pdf->cell(30,$tgi,'Score Total (skala 5)',0,0,"L");
$pdf->cell(3,$tgi,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(25,$tgi,number_format($sscored, 2, '.', ''),0,1,"L");

$y=$pdf->getY();
$pdf->SetDrawColor(168,168,168);
$pdf->Line(20,$y+2,190,$y+2);

$pdf->ln(4);


// --- komentar
//$pdf->AddPage();
$pdf->HLevel1('Komentar','');
$pdf->ln(1);

$pdf->SetLeftMargin(30);
$pdf->SetFont('Arial','',9);
$quekom=mysqli_query($Open, "SELECT kode, komentar from ".$edompotensis." where kode='$skodedsn' and komentar <> ''")  or die("error as:".mysql_error());
$nou=0;
while ($listkom=mysqli_fetch_array($quekom)){
	$skom=$listkom['komentar'];
	if (strlen($skom) > 4) {
		$nou=$nou+1;
		$pdf->Cell(5,$tgi,$nou.'.',0,0,"R");
		if (strlen($skom) > 95) {
			$skom1=substr($skom,0,strpos($skom," ",85));
			$skom2=substr($skom,strpos($skom," ",85));
			$pdf->Cell(110,$tgi,$skom1,0,1,"L");
			$pdf->setx(34);
			if (strlen($skom2) > 95) {
				$skom21=substr($skom2,0,strpos($skom2," ",85));
				$skom22=substr($skom2,strpos($skom2," ",85));
				$pdf->Cell(110,$tgi,$skom21,0,1,"L");
				$pdf->setx(34);
				$pdf->Cell(110,$tgi,$skom22,0,1,"L");
			} else {
				//$pdf->setx(10);
				$pdf->SetLeftMargin(30);
				$pdf->Cell(110,$tgi,$skom2,0,1,"L");
			}
		} else {
			//$pdf->setx(10);
			$pdf->SetLeftMargin(30);
			$pdf->Cell(150,$tgi,$skom,0,1,"L");
		}
	}

}
$y=$pdf->getY();
$pdf->Line(20,$y+3,190,$y+2);

$pdf->ln(4);

$pdf->SetLeftMargin(20);
$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(70,$tgi,'Bandung, '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'   - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,strtoupper($_SESSION['unit']),0,1,"L");


mysqli_close($Open);

$filename="pdfoutput/edomr1-".$skodedsn."-".$perta.".pdf";
$filename2="edomr1-".$skodedsn."-".$perta.".pdf";

$pdf->Output($filename2,'D');

$pdf->output()



?>