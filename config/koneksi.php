<?php
	$HOST ='localhost';
	$USER ='root';
	$PASS ='';
	$DB = 'stpban01_monev';
	$Open = mysqli_connect($HOST,$USER,$PASS,$DB);
		if (!$Open){
		die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
	$db1 = new mysqli($HOST,$USER,$PASS,$DB);
	$GLOBALS['passTextDef'] = '123';
	$GLOBALS['passDef'] = md5('123');
?>