<?php
include "include/header.php";
if(isset($_POST['perta'])){
        $perta = $_POST['perta']; 
    }else{
        $perta = $_SESSION['pertan']; 
    }
?>
<script>
$(document).ready(function(){
     $("#slide").hide();

});

function exportedom(){
    var perta = $('#perta').val();
    window.location = "exportedom.php?perta="+perta;
}


		</script>
	

	<div class="col-md-2 nopadding">Kriteria<br>
		<select name="seldos" class="filter" style="width:100%;" onchange="filteredom()">
			<option value="!=''">All</option>
			<option value=">=4.51">x>=4.51</option>
			<option value="BETWEEN 4.00 AND 4.50">4.0 - 4.5</option>
			<option value="BETWEEN 3.50 AND 3.99">3.5 - 3.9</option>
			<option value="BETWEEN 3.00 AND 3.49">3.0 - 3.4</option>
			<option value="<3.00"><3.0</option>
		</select>
	</div>
	
	<div class="col-md-1 nopadding">
		&nbsp;
	</div>
	
	<div class="col-md-2 nopadding" style="min-width:200px;">Cari Dosen<br>
		<input type="text" class="cari" name="cari" id="ipt" style="width:80%;float:left" >&nbsp;
		<input type="button" class="search" onclick="cariedom()">
		<!--<input type="submit" name="cari" value="" class="search"  >-->
	</div>
	
	<div class="col-md-2 " style="min-width:200px;float:right;text-align:right;">
	<a href="#" onclick="exportedom()">Export (.xls)</a>
	</div>
</div>

	<div class="col-md-12 nopadding">
		Keterangan:<br>
		A. Kompetensi Pedagogik<br>
		B. Kompetensi Professional<br>
		C. Kompetensi Kepribadian<br>
		D. Kompetensi Sosial<br><br>
	</div>

<div class="col-md-12" id="data">
<table class="tabel">
<div  id="data">


<?php
$pembagi=0;
$a=0;
$totals=0;
$No=1;
$sql=mysqli_query($plm_edom, 'select * from edomdata_es where ta = "'.$perta.'" order by namadosen,kodemk,kelas asc');
while($r=mysqli_fetch_array($sql)){


if($a==0){
$kdosen=strtoupper($r['kodedosen']);
$sql1=mysqli_query($plm_edom,'select SUM(total) as total from edomdata_es where kodedosen= "'.$kdosen.'" and ta = "'.$perta.'"');
$tots=mysqli_fetch_array($sql1);

$sql2=mysqli_query($plm_edom,'select * from edomdata_es where kodedosen= "'.$kdosen.'" and ta = "'.$perta.'"');
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
		$sql1=mysqli_query($plm_edom,'select SUM(total) as total from edomdata_es where kodedosen= "'.$r['kodedosen'].'" and ta = "'.$perta.'" ');
        $tots=mysqli_fetch_array($sql1);
        
        $sql2=mysqli_query($plm_edom,'select * from edomdata_es where kodedosen= "'.$r['kodedosen'].'" and ta = "'.$perta.'"');
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
		/*echo"
		<td></td><td></td>
		";*/
	}
}

echo"<tr >
<td style='border-bottom:solid 1px #CCCCCC'>".$r['kodemk']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['idprogstudi']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['kelas']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['A']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['B']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['C']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['D']."</td>
<td style='border-bottom:solid 1px #CCCCCC'>".$r['total']."</td>
</tr>

";

}

?>

</tr>
</table>
<br>
</div></div>
