<?
// definisi nama database dan tabel 
$db_name="spm";
// koneksi ke mysql
$connection=@mysql_connect("localhost","root","root") or die(mysql_error());
$db=@mysql_select_db($db_name,$connection) or die(msql_error());


?>