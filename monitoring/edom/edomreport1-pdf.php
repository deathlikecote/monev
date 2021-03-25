<?php
define('FPDF_FONTPATH','fpdf17/font/');
require('fpdf17/edomclassonet.php');
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


$title='e-DOM Report.01';
//$pdf = new PDF();
$pdf = new PDF_onet();
$pdf->AliasNbPages();
$xkode = $_POST["kode"];
//- hitung jumlah parameter kuesioner
$qryp=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter"));
$jpar=$qryp['vjpar'];

//- edomdata
/*$qry=mysqli_query("select id, kodedosen, kodemk, idprogstudi, kelas from edompotensi where kode='$xkode' and done=1") or die("error as:".mysql_error());
while ($qrytem=mysqli_fetch_array($qry)) {
	$zid=$qrytem['id'];
	$zkdsn=$qrytem['kodedosen'];
	$zkmk=$qrytem['kodemk'];
	$zidp=$qrytem['idprogstudi'];
	$zkls=$qrytem['kelas'];
	mysqli_query("UPDATE edomdata SET kodedosen='$zkdsn', kodemk='$zkmk', idprogstudi='$zidp', kelas='$zkls', kode=CONCAT('$zkdsn','$zkmk','$zidp','$zkls') where id_potensi='$zid'") or die("error:".mysql_error());
}*/

//-edomtemp01
mysqli_query($plm_edom, "TRUNCATE TABLE edomtemp01");
$qry01=mysqli_query($plm_edom, "select kode, id_parameter, parameter, jenis, aspek, sum(v1) as jumlah from edomdata where kode='$xkode' group by kode,id_parameter") or die("error as:".mysql_error());
while ($list=mysqli_fetch_array($qry01)) {
	$vkode=$list['kode'];
	$vid=$list['id_parameter'];
	$vpar=$list['parameter'];
	$vaspek=$list['aspek'];
	$vjml=$list['jumlah'];
	$vjenis=$list['jenis'];
	mysqli_query($plm_edom, "INSERT INTO edomtemp01 (kode,id_parameter,parameter,aspek,jumlah,jenis) VALUES ('$vkode', '$vid', '$vpar', '$vaspek', '$vjml', '$vjenis')") or die("error insert:".mysql_error());
}

// hitung jumlah siswa dari edomdata
mysqli_query($plm_edom, "update edomtemp01 t1 inner join (select kode, count(kode)/'$jpar' as jsiswa from edomdata where kode='$xkode') t2 on t1.kode = t2.kode set jmlmhs=jsiswa") or die("error jsiswa:".mysql_error());
//hitung score : par/as/dos pada tabel edomtemp01
mysqli_query($plm_edom, "update edomtemp01 set scorepar=jumlah/jmlmhs") or die("error scorepar:".mysql_error());
mysqli_query($plm_edom, "update edomtemp01 tt1 inner join (select kode, aspek, avg(scorepar) as vscoreas from edomtemp01 where kode='$xkode' and jenis !='3' group by aspek) tt2 on tt1.aspek = tt2.aspek set tt1.scoreas = tt2.vscoreas")  or die("error as:".mysql_error());
mysqli_query($plm_edom, "update edomtemp01 ttt1 inner join (select kode, avg(scoreas) as vscoredos from edomtemp01 where kode='$xkode') ttt2 on ttt1.kode = ttt2.kode set ttt1.scoredos = ttt2.vscoredos")  or die("error as:".mysql_error());


$que=mysqli_query($plm_edom, "select id, parameter, aspek, scorepar, scoreas, scoredos, kode, jmlmhs from edomtemp01 where kode='$xkode' order by id")  or die("error as:".mysql_error());
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
$spm='@2017-Pusat Penjaminan Mutu Poltekpar Palembang';
$spmh='PUSAT PENJAMINAN MUTU';
$judul="EVALUASI DOSEN OLEH MAHASISWA";
$subjudul="LAPORAN PER MATA KULIAH";
$pdf->SetTitle($title);
$pdf->SetDrawColor(168,168,168);

$quepot=mysqli_query($plm_edom, "select ta, per, utsuas, kodedosen, namadosen, idprogstudi, kodemk, namamk, kelas from edompotensi where kode='$xkode'") or die(mysql_error());
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
$singper=$_SESSION['pertan'];

$periode="Periode ".$sta;

$queprodi=mysqli_query($plm, "select kodeprodi,namaprodi from m_prodi where kodeprodi='$sidp'") or die(mysql_error());
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
$pdf->cell(97,$tgi1,$skddsn.' - '.$snmdsn.' - ',0,0,"L");
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
$que1=mysqli_query($plm_edom, "select id_parameter, jenis, parameter, aspek, scorepar, scoreas, scoredos, kode, jmlmhs from edomtemp01 where kode='$xkode' order by id_parameter")  or die("error as:".mysql_error());
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
$gque=mysqli_query($plm_edom, "select distinct aspek, scoreas as nilai from edomtemp01 where kode='$xkode'")  or die("error as:".mysql_error());
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
$quekom=mysqli_query($plm_edom, "select kode, komentar from edompotensi where kode='$skodedsn' and komentar <> ''")  or die("error as:".mysql_error());
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
$pdf->Cell(70,$tgi,'Palembang, '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'   - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(70,$tgi,'PPM Poltekpar Palembang',0,1,"L");


mysqli_close($plm_edom);

//$filename="test1.pdf";
$filename="pdfoutput/edomr1-".$skodedsn."-".$singper.".pdf";
$filename2="edomr1-".$skodedsn."-".$singper.".pdf";

$pdf->Output($filename2,'D');
//$pdf->Output($filename,'F');
//echo'<a href="test1.pdf">Download your Invoice</a>';

$pdf->output()


//header("Location:edomreport1.php")


?>