<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>eDOP-List Nilai</title>
	<link rel="stylesheet" type="text/css" href="jquery/jquery.tablescroll.css"/>
</head>
<body>
<?php
// definisi nama database dan tabel 
include("dbspmconn.php");
$hasil=mysql_query("select idprogstudi, kelas_id, avg(spote) as rata2 from epompotensi where spote > 0 group by idprogstudi, kelas_id" ) or die("error:".mysql_error());
$nou=0;
$isi=0;
?>
<span class="tablescroll">ePOM List Nilai</span>
	<br/>
	<table id="thetable" cellspacing="0">
	<thead>
		<tr>
		  <td align=center>No</td>
		  <td align=center>Prodi</td>
		  <td align=center>kelas</td>
		  <td align=center>Nilai</td>
		</tr>
	</thead>
	<tbody>
		<tr class="first">
<?php while($data=mysql_fetch_array($hasil)) { ?>
<?php $nou=$nou+1 ?>
<td align=left>  
  <?php echo $nou ?></span>
</td>
<td align=left> 
  <?php echo strtoupper($data[idprogstudi]) ?></span>
</td>
<td align=left> 
  <?php echo strtoupper($data[kelas_id]) ?></span>
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