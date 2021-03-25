
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>eDOM-Rekap Nilai</title>
	<link rel="stylesheet" type="text/css" href="jquery/jquery.tablescroll.css"/>
</head>
<body>
<?php
// definisi nama database dan tabel 
include("dbspmconn.php");
$hasil=mysql_query("select kodedosen, avg(spote) as rata2 from edompotensi where spote > 0 group by kodedosen" ) or die("error:".mysql_error());
$nou=0;
$isi=0;
?>
	<span class="tablescroll">eDOM Rekapitulasi Nilai</span>
	<br/>

	<table id="thetable" cellspacing="0">
	<thead>
		<tr>
		  <td align=center>No</td>
		  <td align=center>Dosen</td>
		  <td align=center>Score rata2</td>
		</tr>
	</thead>
	<tbody>
		<tr class="first">
<?php while($data=mysql_fetch_array($hasil)) { ?>
<?php $nou=$nou+1 ?>
<td align=left>  
  <?php echo $nou ?></span>
</td>
<td align=center> 
  <?php echo strtolower($data[kodedosen]) ?></span>
</td>
<td align=center> 
  <?php echo number_format($data[rata2],2,'.',',') ?></span>
</td>

<tr></tr>
<?php
}
?>
</td>
<tr></tr>
</tbody>
<tfoot>
		<tr>
		<td>.</td>
		<td>.</td>
		<td>.</td>
		</tr>
	</tfoot>
	
</table>

<span class="tablescroll">Untuk Pencarian : Gunakan Control-F atau Command-F</span>
	<br/>
	<br/>
	
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script type="text/javascript" src="jquery/jquery.tablescroll.js"></script>

<script>
/*<![CDATA[*/

jQuery(document).ready(function($)
{
	$('#thetable').tableScroll({height:300});

});

/*]]>*/
</script>

</body>
</html>