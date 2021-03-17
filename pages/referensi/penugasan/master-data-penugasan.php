<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$perta		= $_POST['perta'];
		$kdprodi	= $_POST['kdprodi'];
		$kelas		= $_POST['kelas'];
		$kodemk		= $_POST['kodemk'];
		$kodedosen	= $_POST['kodedosen'];

		include "../config/koneksi.php";
		$cari=mysqli_query($Open,"SELECT * FROM t_penugasan WHERE 
			perta = '".$perta."' AND 
			kdprodi = '".$kdprodi."' AND 
			kelas = '".$kelas."' AND
			kodemk = '".$kodemk."' AND
			kodedosen = '".$kodedosen."'
			") ;
	    $datas=mysqli_num_rows($cari);
	    if($datas<1){
	    	$query = "INSERT INTO t_penugasan (
	    	perta,
	    	kdprodi,
			kelas,
			kodemk,
			kodedosen
	    	) VALUES (
			'$perta',
			'$kdprodi',
			'$kelas',
			'$kodemk',
			'$kodedosen'
	    	)";
	    	$hasil = mysqli_query($Open,$query);

	    	if(!$hasil){

	    		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	    		
	    	}else{

				$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
				header("location:index.php?page=form-view-data-penugasan");
	    	}

	    }else{
	    		$_SESSION['pesan'] = "Oops! Data sudah ada ...";
				header("location:index.php?page=form-master-data-penugasan");
	    }
	}
?>
</div>