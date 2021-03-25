<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ePOD Monitoring</title>
<style type="text/css">
<!--
.style10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #336799;
}
.style12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}
.style17 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #CCCCCC; }
.style20 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.style22 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #000000; font-weight: bold; }
.style23 {color: #000000}
-->
</style>
</head>

<body bgcolor="#E3E3E3">
<?php
// definisi nama database dan tabel 
$db_name2="stpband01_spm";
// koneksi ke mysql
$connection2=@mysql_connect("localhost","stpban01","M#T)TzSh]R{H") or die(mysql_error());
$dbase=@mysql_select_db("stpban01_spm",$connection2) or die(msql_error());

$hasil=mysql_query("select exoxpotensi.kodedosen, exoxpotensi.idprogstudi, count(exoxpotensi.kodedosen) as potensi,  count(epoddata.id_potensi)/10 as diisi from exoxpotensi left join epoddata on exoxpotensi.id = epoddata.id_potensi group by exoxpotensi.kodedosen,exoxpotensi.idprogstudi" ) or die("error:".mysql_error());
$hasil2=mysql_query("select kodedosen from exoxpotensi");


$nou=0;
$i=mysql_num_rows($hasil2);
?>
<table width="300" border=0 cellpadding="1" cellspacing="1" align="center">
<!--<tr>
  <td width="300"  height="25" align="center"  bgcolor="#FAFAFA"><span class="style10">Total Registrasi </span></td>
</tr> -->
<tr>
  <td width="300"  height="25" align="center"  bgcolor="#FAFAFA"><span class="style10">Berdasarkan ePOD Potensi :_<?php echo $i ?></span></span></td>
</tr>
</table> 

<tr> </tr>
<table width="300" bordercolor="#CCCCCC" border="0"  cellpadding="1" cellspacing="1" align="center"> 
<tr bgcolor="#425F89" > 
<td width="40" align=center><span class="style17"> No. Urut </span></td>
<td width="40" align=center><span class="style17"> Dosen </span></td>
<td width="40" align=center><span class="style17"> Prodi </span></td>
<td width="45" align=center><span class="style17"> Diisi</span></td>

</tr>
<?php while($data=mysql_fetch_array($hasil)) { ?>
<?php $nou=$nou+1 ?>
<td align=left>  
  <div align="center"><span class="style20"><?php echo $nou ?></span>
  </div></td>

 <td align=left> 
  <span class="style20"><?php echo strtolower($data[kodedosen]) ?></span>
</td>
<td align=center> 
  <span class="style20"><?php echo strtoupper($data[idprogstudi]) ?></span>
</td>
<td align=center> 
<?php if ($data[diisi]>0) { ?>
 <span class="style20"><?php echo "sudah" ?></span>
<?php
}
?>
</td>
<tr></tr>
<?php
}
?>

</table>


</body>
</html>
