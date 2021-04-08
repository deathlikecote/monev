<?php
// session_start();
include "./../../include/koneksi.php";
//---------------- LOGIN -----------------
if(isset($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];


$hasil = mysqli_query ($plm, "SELECT * FROM m_user WHERE BINARY username='$username' AND password='".md5($password)."' AND status='1'");
if($bar = mysqli_fetch_array($hasil)){
	$_SESSION['jabatan']= $bar['jabatan'];
	
	if($_SESSION['jabatan']=='operator' or $_SESSION['jabatan']=='pejabat'){
		header ('location:../');
}
	else{
		header ('location:../../');
	}
	

}else{
		echo"
			<script>
			alert('Maaf user dan password tidak ditemukan');
			</script>
		";
		echo "<meta http-equiv='refresh' content='0;../'>";
	}
}

//--------------- LOGOUT ------------------
if(isset($_GET['logout'])==1){
	session_destroy();
	echo "<meta http-equiv='refresh' content='0;../'>";
}

//--------------- cariedom ------------------
if(isset($_REQUEST['cari']) or isset($_REQUEST['filter'])){
echo '<table class="tabel">';
	$a=0;
$No=1;
if(isset($_REQUEST['cari'])){
$sql=mysqli_query($plm_edom, "select * from edomdata_es where namadosen like '%".$_REQUEST['cari']."%' and ta ='".$_REQUEST['perta']."' order by namadosen,kodemk,kelas asc");
$filter='';
}

if(isset($_REQUEST['filter'])){
$sql=mysqli_query($plm_edom, "select * from edomdata_es where total ".$_REQUEST['filter']." and ta ='".$_REQUEST['perta']."' order by namadosen,kodemk,kelas asc");
$filter=$_REQUEST['filter'];
}


while($r=mysqli_fetch_array($sql)){


if($a==0){
$kdosen=strtoupper($r['kodedosen']);
$sql1=mysqli_query($plm_edom,'select SUM(total) as total from edomdata_es where kodedosen= "'.$kdosen.'" and total '.$filter.' and ta ="'.$_REQUEST['perta'].'" ');
$tots=mysqli_fetch_array($sql1);

$sql2=mysqli_query($plm_edom,'select * from edomdata_es where kodedosen= "'.$kdosen.'" and total '.$filter.' and ta ="'.$_REQUEST['perta'].'"');
$pemba=mysqli_num_rows($sql2);
$totalasli = $tots['total']/$pemba;
echo"
<tr>
<thead>
<td colspan='8' style='text-align:left;padding:5px 10px'>$No. ".strtoupper($r['namadosen'])." <font style='float:right'>TOTAL ".number_format($totalasli,2)."</font></td>
</thead>
</tr>

<tr style='background-color:#9DD0E9;'>
<td>MK</td>
<td>PRODI</td>
<td>KLS</td>
<td>A</td>
<td>B</td>
<td>C</td>
<td>D</td>
<td>NA</td>
</tr>

";

$a=1;
}else{
	if(strtoupper($r['kodedosen'])!=$kdosen){
		$No=$No+1;
		$sql1=mysqli_query($plm_edom,'select SUM(total) as total from edomdata_es where kodedosen= "'.$r['kodedosen'].'" and total '.$_REQUEST["filter"].' and ta ="'.$_REQUEST['perta'].'" ');
        $tots=mysqli_fetch_array($sql1);
        
        $sql2=mysqli_query($plm_edom,'select * from edomdata_es where kodedosen= "'.$r['kodedosen'].'" and total '.$_REQUEST["filter"].' and ta ="'.$_REQUEST['perta'].'"');
        $pemba=mysqli_num_rows($sql2);
        $totalasli = $tots['total']/$pemba;
		echo"
			<tr>
			<thead>
			<td colspan='8' style='text-align:left;padding:5px 10px'>$No. ".strtoupper($r['namadosen'])." <font style='float:right'>TOTAL ".number_format($totalasli,2)."</font></td>
			</thead>
			</tr>
			<tr style='background-color:#9DD0E9;'>
			<td>MK</td>
			<td>PRODI</td>
			<td>KLS</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>
			<td>NA</td>
			</tr>
			";
		$kdosen=strtoupper($r['kodedosen']);
	}else{
	
	}
}
echo"<tr >
<td style='border-bottom:solid 1px #CCCCCC'>".$r['kodemk']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['idprogstudi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['kelas']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['A'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['B'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['C'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['D'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['total'],2)."</td>
</tr>

";

}
echo'<tbody>
</tr>
</table><br>';
}

//--------------- cariedop ------------------
if(isset($_REQUEST['cariedop']) or isset($_REQUEST['filteredop'])){
echo '<table class="tabel">';
	$a=0;
$No=1;
if(isset($_REQUEST['cariedop'])){
$sql=mysqli_query($plm_edom, "select * from edopdata_es where namadosen like '%".$_REQUEST['cariedop']."%' and ta ='".$_REQUEST['perta']."' order by namadosen,kodemk asc");
$filter='';
}

if(isset($_REQUEST['filteredop'])){
$sql=mysqli_query($plm_edom, "select * from edopdata_es where total ".$_REQUEST['filteredop']." and ta ='".$_REQUEST['perta']."'  order by namadosen,kodemk asc");
$filter=$_REQUEST['filteredop'];
}


while($r=mysqli_fetch_array($sql)){


if($a==0){
$kdosen=strtoupper($r['kodedosen']);
$sql1=mysqli_query($plm_edom,'select SUM(total) as total from edopdata_es where kodedosen= "'.$kdosen.'" and total '.$filter.' and ta ="'.$_REQUEST['perta'].'" ');
$tots=mysqli_fetch_array($sql1);

$sql2=mysqli_query($plm_edom,'select * from edopdata_es where kodedosen= "'.$kdosen.'" and total '.$filter.' and ta ="'.$_REQUEST['perta'].'"');
$pemba=mysqli_num_rows($sql2);
$totalasli = $tots['total']/$pemba;
echo"
<tr>
<thead>
<td colspan='8' style='text-align:left;padding:5px 10px'>$No. ".strtoupper($r['namadosen'])." <font style='float:right'>TOTAL ".number_format($totalasli,2)."</font></td>
</thead>
</tr>

<tr style='background-color:#9DD0E9;'>
<td>MK</td>
<td>PRODI</td>
<td>A</td>
<td>B</td>
<td>C</td>
<td>NA</td>
</tr>

";

$a=1;
}else{
	if(strtoupper($r['kodedosen'])!=$kdosen){
		$No=$No+1;
		$sql1=mysqli_query($plm_edom,'select SUM(total) as total from edopdata_es where kodedosen= "'.$r['kodedosen'].'" and total '.$filter.' and ta ="'.$_REQUEST['perta'].'" ');
        $tots=mysqli_fetch_array($sql1);
        
        $sql2=mysqli_query($plm_edom,'select * from edopdata_es where kodedosen= "'.$r['kodedosen'].'" and total '.$filter.' and ta ="'.$_REQUEST['perta'].'"');
        $pemba=mysqli_num_rows($sql2);
        $totalasli = $tots['total']/$pemba;
		echo"
			<tr>
			<thead>
			<td colspan='8' style='text-align:left;padding:5px 10px'>$No. ".strtoupper($r['namadosen'])." <font style='float:right'>TOTAL ".number_format($totalasli,2)."</font></td>
			</thead>
			</tr>
			<tr style='background-color:#9DD0E9;'>
			<td>MK</td>
			<td>PRODI</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>NA</td>
			</tr>
			";
		$kdosen=strtoupper($r['kodedosen']);
	}else{
		/*echo"
		<td></td><td></td>
		";*/
	}
}
echo"<tr >
<td style='border-bottom:solid 1px #CCCCCC'>".$r['kodemk']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['idprogstudi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['A'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['B'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['C'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['total'],2)."</td>
</tr>

";

}
echo'<tbody>
</tr>
</table><br>';
}

//--------------- cariepom ------------------
if(isset($_REQUEST['filterepom'])){
echo '<table class="tabel">';
	$a=0;
$No=1;

$sql=mysqli_query($plm_edom, "select * from epomdata_es where total ".$_REQUEST['filterepom']." and ta ='".$_REQUEST['perta']."' order by namaprodi,total asc");

?>
<table class="tabel">
<tr>
<thead>
<td>No</td>
<td>Kode Prodi</td>
<td>Nama</td>
<td>Jurusan</td>
<td>A</td>
<td>B</td>
<td>C</td>
<td>D</td>
<td>NA</td>
</thead>
</tr>
<?php

while($r=mysqli_fetch_array($sql)){

echo"<tr >
<td style='border-bottom:solid 1px #CCCCCC'>".$No."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['idprogstudi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['namaprodi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['jurprodi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['A'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['B'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['C'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['D'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['total'],2)."</td>
</tr>

";
$No=$No+1;

}
echo'<tbody>
</tr>
</table><br>';
}

//--------------- cariepod ------------------
if(isset($_REQUEST['filterepod'])){
echo '<table class="tabel">';
	$a=0;
$No=1;

$sql=mysqli_query($plm_edom, "select * from epoddata_es where total ".$_REQUEST['filterepod']." and ta ='".$_REQUEST['perta']."' order by namaprodi,total asc");

?>
<table class="tabel">
<tr>
<thead>
<td>No</td>
<td>Kode Prodi</td>
<td>Nama</td>
<td>Jurusan</td>
<td>A</td>
<td>B</td>
<td>C</td>
<td>NA</td>
</thead>
</tr>
<?php

while($r=mysqli_fetch_array($sql)){

echo"<tr >
<td style='border-bottom:solid 1px #CCCCCC'>".$No."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['idprogstudi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['namaprodi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['jurprodi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['A'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['B'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['C'],2)."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".number_format($r['total'],2)."</td>
</tr>

";
$No=$No+1;

}
echo'<tbody>
</tr>
</table><br>';
}

?>