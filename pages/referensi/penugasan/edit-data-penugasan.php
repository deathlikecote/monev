<div class="row">
<?php
	if (isset($_GET['id'])) {
	$id = $_GET['id'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../config/koneksi.php";
				
	if ($_POST['edit'] == "edit") {
	$perta		= $_POST['perta'];
	$kdprodi	= $_POST['kdprodi'];
	$kelas		= $_POST['kelas'];
	$kodemk		= $_POST['kodemk'];
	$kodedosen	= $_POST['kodedosen'];

		$update= mysqli_query ($Open,"UPDATE t_penugasan SET 
			perta	= '$perta',
			kdprodi	= '$kdprodi',
			kelas	= '$kelas',
			kodemk	= '$kodemk',
			kodedosen	= '$kodedosen'
			WHERE id='$id'");
		if($update){
			
				$_SESSION['pesan'] = "Good! Data berhasil diperbaharui ...";
				header("location:index.php?page=form-view-data-penugasan");
			
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
			
?>
</div>