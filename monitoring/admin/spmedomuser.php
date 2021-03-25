<?php
require_once("../conf.php");      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpGrid Edit Form Layout</title>
</head>
<body> 

<?php
$db_name="stpban01_spm";
$connection=@mysql_connect("localhost","stpban01","M#T)TzSh]R{H") or die(mysql_error());
$db=@mysql_select_db($db_name,$connection) or die(msql_error());

$dg = new C_DataGrid("SELECT id, nim, nama, idprogstudi, tgllahir FROM edomuser", "id", "edomuser"); 

// change column titles
// $dg -> set_col_title("idprogstudi", "Prodi");
// $dg -> set_col_title("znama", "Nama");
// $dg -> set_col_title("kloter", "Prog");

// hide a column
$dg -> set_col_hidden("recordno");

// enable edit
$dg -> enable_edit("FORM", "CRUD"); 

// $dg -> set_col_property("nim", array("formoptions"=>array("rowpos"=>1,"colpos"=>1)));
// $dg -> set_col_property("znama", array("formoptions"=>array("rowpos"=>1,"colpos"=>2)));
// $dg -> set_col_property("kelas_id", array("formoptions"=>array("rowpos"=>2,"colpos"=>1)));
// $dg -> set_col_property("kloter", array("formoptions"=>array("rowpos"=>2,"colpos"=>2)));
// $dg -> set_col_property("ppno", array("formoptions"=>array("rowpos"=>3,"colpos"=>1)));
$dg->enable_advanced_search(true);
$dg->enable_export('EXCEL');
$dg->set_form_dimension(500, 350);

$dg -> display();
?>

</body>
</html>