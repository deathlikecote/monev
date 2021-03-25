<?php
include("../dbsql/dbspmconn.php");
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<title>EDOP Report1</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="../css/spmstyle.css"/>

</head>

<body>

<span class="jdl1">e-DOP Report 03 / Dosen Prodi</span>

<form method="post" action="edopreport3-pdf.php" > 
<select name="dkode" >
<option value=""> Choose</option>

<?php
	$query = mysql_query("SELECT idprogstudi from v_edop_overall_totalscore order by idprogstudi asc") or die(mysql_error());
	while($row = mysql_fetch_assoc($query)){
		$skode = $row["idprogstudi"];
?>
<option value="<?php echo $skode ?>" > <?php echo $skode ?> </option>
<?php
}
?>
</select>
<input type="submit"></p>
</form>
</body>
</html>
