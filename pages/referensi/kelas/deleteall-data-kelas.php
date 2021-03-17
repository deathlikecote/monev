<div class="row">
<?php
include "../config/koneksi.php";
if (isset($_GET['perta'])) {
		$perta = $_GET['perta'];
	}
	else {
		die ("404 Error Server");	
	}
	
	if ($perta != '' or !empty($perta)) {
		$qr=mysqli_query($Open,"SELECT nim FROM t_kelas WHERE perta='$perta'") ;
		while($r=mysqli_fetch_array($qr)){
			mysqli_query($Open,"DELETE FROM m_user WHERE nama_user='".$r['nim']."'");	
		}
		$delete		=mysqli_query($Open,"DELETE FROM t_kelas WHERE perta='$perta'");
		if($delete){
			
			$_SESSION['pesan'] = "Good! Data berhasil dihapus ...";
			header("location:index.php?page=form-view-data-kelas");
		
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>