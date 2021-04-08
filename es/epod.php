<?php
include "include/header.php";
if(isset($_POST['perta'])){
        $perta = $_POST['perta']; 
    }else{
        $perta = $_SESSION['pertan']; 
    }
?>
<script type="text/javascript">
	function exportepod(){
    var perta = $('#perta').val();
    window.location = "exportepod.php?perta="+perta;
}

</script>
	<div class="col-md-2">Kriteria<br>
		<select name="seldos" class="filterepod" style="width:100%;" onchange="filterepod()">
			<option value="!=''">All</option>
			<option value=">=4.51">x>=4.51</option>
			<option value="BETWEEN 4.00 AND 4.50">4.0 - 4.5</option>
			<option value="BETWEEN 3.50 AND 3.99">3.5 - 3.9</option>
			<option value="BETWEEN 3.00 AND 3.49">3.0 - 3.4</option>
			<option value="<3.00"><3.0</option>
		</select>
	</div>
	
	<div class="col-md-1">
		&nbsp;
	</div>
	
	<!--<div class="col-md-2" style="min-width:200px;">Cari Dosen<br>
		<input type="text" class="cariepom" name="cari" id="ipt" style="width:80%;float:left" >&nbsp;
		<input type="button" class="search" onclick="cariepom()">
		<input type="submit" name="cari" value="" class="search"  >
	</div> -->
	
	<div class="col-md-2 " style="min-width:200px;float:right;text-align:right;">
	<a href="#" onclick="exportepod()">Export (.xls)</a>
	</div>
</div>

	<div class="col-md-12">
		Keterangan:<br>
		A. Perencanaan PBM<br>
		B. Pelaksanaan PBM<br>
		C. Evaluasi PBM<br><br>
	</div>

<div class="col-md-12" id="data">

<div  id="data">
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
$a=0;
$No=1;
$sql=mysqli_query($plm_edom,'select * from epoddata_es where ta ="'.$perta.'" order by namaprodi,total asc');
while($r=mysqli_fetch_array($sql)){



$nprodi=strtoupper($r['namaprodi']);



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
?>

</tr>
</table><br>
</div>
</div>