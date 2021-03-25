<?php
session_start();
if ($_SESSION['masuk'] == 1)
echo "";
else {
	header('Location:./../palembang');
   	exit;
}
?>

