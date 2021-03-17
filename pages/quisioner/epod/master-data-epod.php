<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$nourut 	= $_POST['nourut'];
		$aspek 		= $_POST['aspek'];
		$parameter 	= $_POST['parameter'];
		$jenis 		= $_POST['jenis'];		
		include "../config/koneksi.php";

	   
	    	$query = "INSERT INTO epodparameter (
	    	nourut,
	    	aspek,
	    	parameter,
	    	jenis) VALUES (
	    	'$nourut',
	    	'$aspek',
	    	'$parameter',
	    	'$jenis')";
	    	$hasil = mysqli_query($Open,$query);
	    	if(!$hasil){
	    		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	    	}else{
				$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
				header("location:index.php?page=form-view-data-epod");
	    	}
	}
?>
</div>