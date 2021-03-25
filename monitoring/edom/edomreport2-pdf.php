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


$kunci2 =$_POST["kode2"];
$pprodi=substr($kunci2,0,3);
$pkls=substr($kunci2,3,2);

/*if (strlen($kunci2) == 6) {
   $pprodi=substr($kunci2,0,3);
   $pkls=substr($kunci2,3,3);
} 
if (strlen($kunci2) == 5) {
   $pprodi=substr($kunci2,0,4);
   $pkls=trim(substr($kunci2,4,3));
}
if (strlen($kunci2) == 4) {
   $pprodi=substr($kunci2,0,3);
   $pkls=trim(substr($kunci2,3,1));
}
if (strlen($kunci2) == 3) {
   $pprodi=substr($kunci2,0,2);
   $pkls=trim(substr($kunci2,2,1));
}*/
$kunci='%'.$kunci2;
$title='e-DOM Report.02';

//$pdf=new FPDF();
$pdf=new PDF_onet();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','',8);
$pdf->SetLeftMargin(20);
$tgi=4;
$tgi=5;
$tgi1=5;
$tgiaspek=5;
$lbraspek=75;
$spm='@2017-Pusat Penjaminan Mutu Poltekpar Palembang';
$judul="EVALUASI DOSEN OLEH MAHASISWA";
$subjudul="LAPORAN DOSEN PROGRAM STUDI";
$pdf->SetDrawColor(168,168,168);

//--hitung siswa / kelas
$qsiswa=mysqli_query($plm, "select count(a.nim) as jskls from t_kelas a, dbsiswa b where (a.idprogstudi = '$pprodi' and kelas_id = '$pkls' and perta = '".$_SESSION['pertan']."') and (b.nim = a.nim)");
$qskls=mysqli_fetch_assoc($qsiswa);
$jsiswakls=$qskls['jskls'];

//-edomtemp02
$qpar=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter where jenis != '3'"));
$jpar=$qpar['vjpar'];
mysqli_query($plm_edom, "TRUNCATE TABLE edomtemp02");
mysqli_query($plm_edom, "INSERT INTO edomtemp02 (kode) (select distinct(kode) from edomdata where kode like '$kunci')") or die(mysql_error());
mysqli_query($plm_edom, "UPDATE edomtemp02 INNER JOIN edompotensi ON edomtemp02.kode = edompotensi.kode SET edomtemp02.namadosen = edompotensi.namadosen, edomtemp02.namamk = edompotensi.namamk, edomtemp02.idprogstudi = edompotensi.idprogstudi, edomtemp02.kelas = edompotensi.kelas") or die(mysql_error());
mysqli_query($plm_edom, "update edomtemp02 t1 inner join (select kode, count(kode)/'$jpar' as Jsiswa from edomdata group by kode) t2 on t1.kode = t2.kode set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysql_error());
mysqli_query($plm_edom, "update edomtemp02 t1 inner join (select kode, sum(v1) as Jsc from edomdata where jenis != '3' group by kode) t2 on t1.kode = t2.kode set t1.jumlah = t2.Jsc") or die("error jumlah:".mysql_error());
mysqli_query($plm_edom, "update edomtemp02 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysql_error());


$quepot=mysqli_fetch_assoc(mysqli_query($plm_edom, "select ta, per, utsuas, kodedosen, namadosen, idprogstudi, kodemk, namamk, kelas from edompotensi where id='1'"));
$sta=$_SESSION['pertan'];
$sper=$quepot['per'];
$sutsuas=$quepot['utsuas'];
$singper=$_SESSION['pertan'];
$periode="Periode ".$sta;

$queprodi=mysqli_query($plm, "select kodeprodi,namaprodi,jurprodi from m_prodi where kodeprodi='$pprodi'") or die(mysql_error());
$squeprodi1=mysqli_fetch_array($queprodi);
$snmprodi=$squeprodi1['namaprodi'];
$snmjur=$squeprodi1['jurprodi'];

// -- header
$pdf->SetFont('Arial','',11);
$pdf->Cell(170,6,$judul,0,1,"C");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(170,6,$subjudul,0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->Cell(170,5,$periode,0,1,"C");
//$y=$pdf->getY();
//$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(4);

// -- Judul

$pdf->SetFont('Arial','',9);
$pdf->cell(25,$tgi1,'Kelas',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(100,$tgi1,$pkls.'  ('.$jsiswakls.' siswa)',0,0,"L");
$pdf->TotalScore('Score*');
$pdf->SetFont('Arial','',9);
$pdf->cell(25,$tgi1,'Program Studi',0,0,"L");
$pdf->cell(3,$tgi1,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(25,$tgi1,$snmprodi,0,0,"L");
//$qscore=mysqli_fetch_assoc(mysqli_query("select avg(score) as jrata from edomtemp02 where idprogstudi='$pprodi' and kelas='$pkls'"));
$qscore=mysqli_fetch_assoc(mysqli_query($plm_edom, "select sum(v1)/count(kode) as jrata from edomdata where idprogstudi='$pprodi' and kelas='$pkls' and jenis !='3'"));
$sscoreprodi=$qscore['jrata'];
$pdf->TotalScore(number_format($sscoreprodi, 2, '.', ''));
//$pdf->cell(25,$tgi1,number_format($sscoreprodi, 2, '.', ''),0,1,"L");
$pdf->SetFont('Arial','',9);
$pdf->cell(25,$tgi1+2,'Jurusan ',0,0,"L");
$pdf->cell(3,$tgi1+2,':',0,0,"C");
$pdf->SetFont('Arial','B',9);
$pdf->cell(115,$tgi1+2,$snmjur,0,0,"L");
$pdf->SetFont('Arial','',8);
$pdf->cell(25,$tgi1+2,'*skala 5',0,1,"C");
$pdf->SetFont('Arial','',9);
$pdf->ln(2);
$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(3);
$pdf->HLevel3('No.','Nama   Dosen','Nama Mata Kuliah','Score(#mhs)');
$pdf->ln(7);
$pdf->SetLeftMargin(20);

// --- data nilai
$nou=0;
$jscore=0;
$que1=mysqli_query($plm_edom, "select namadosen, namamk, score, jmlmhs from edomtemp02 where idprogstudi='$pprodi' and kelas='$pkls' order by score desc")  or die("error as:".mysql_error());
while ($list=mysqli_fetch_array($que1)){
	$nou=$nou+1;
	$snd=$list['namadosen'];
	$snmk=$list['namamk'];
	$sscore=$list['score'];
	$sjsiswa=$list['jmlmhs'];
	$jscore=$jscore+$sscore;
	
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(5,$tgiaspek,$nou.'.',0,0,"R");
	if (strlen($snd) > 45) {
//		$pdf->Cell($lbraspek,10,$snd,0,0,"L");
		$snd1=substr($snd,0,strpos($snd," ",40));
		$snd2=substr($snd,strpos($snd," ",40));
		$pdf->Cell($lbraspek,$tgiaspek,$snd1,0,0,"L");
		$pdf->Cell($lbraspek,$tgiaspek,$snmk,0,0,"L");
		$pdf->Cell(8,$tgiaspek,number_format($sscore, 2, '.', ''),0,0,"C");
		$pdf->Cell(8,$tgiaspek,'('.number_format($sjsiswa, 0, '.', '').')',0,1,"C");
		$pdf->Cell($lbraspek,$tgiaspek-3,"     ".$snd2,0,1,"L");
	} else {
		$pdf->Cell($lbraspek,$tgiaspek,$snd,0,0,"L");
		$pdf->Cell($lbraspek,$tgiaspek,$snmk,0,0,"L");
		$pdf->Cell(8,$tgiaspek,number_format($sscore, 2, '.', ''),0,0,"C");
		$pdf->Cell(8,$tgiaspek,'('.number_format($sjsiswa, 0, '.', '').')',0,1,"C");
	}
	
//	$pdf->Cell($lbraspek-7,$tgiaspek,$snmk,0,0,"L");
//	$pdf->Cell(10,$tgiaspek,number_format($sscore, 2, '.', ''),0,0,"C");
//	$pdf->Cell(8,$tgiaspek,'('.number_format($sjsiswa, 0, '.', '').')',0,1,"C");
	
}


$y=$pdf->getY();
$pdf->Line(20,$y+2,190,$y+2);
$pdf->ln(5);

$tgl=konversi_tanggal(" j M Y").".";
$pdf->ln(7);
$pdf->Cell(110,$tgi,'Palembang, '.$tgl,0,1,"L");
$pdf->ln(5);
$pdf->Cell(110,$tgi,'            - ttd -',0,1,"L");
$pdf->ln(5);
$pdf->Cell(110,$tgi,'PPM Poltekpar Palembang',0,1,"L");

mysqli_close($plm_edom);

//$filename="test1.pdf";
$filename="pdfoutput/edomr2-".$pprodi.$pkls."-".$singper.".pdf";
$filename2="edomr2-".$pprodi.$pkls."-".$singper.".pdf";

$pdf->Output($filename2,'D');
//$pdf->Output($filename,'F');
//echo'<a href="test1.pdf">Download your Invoice</a>';

$pdf->output()


//header("Location:edomreport1.php")


?>