<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$nim		= $_POST['nim'];
		$nama		= strtoupper($_POST['nama']);
		$sex		= $_POST['sex'];
		$tgllahir	= $_POST['tgllahir'];
		$thnmasuk	= $_POST['thnmasuk'];
		$nemail		= strtolower($_POST['nemail']);
		
		include "../config/koneksi.php";
		$cari=mysqli_query($Open,"SELECT * FROM m_siswa WHERE nim='".$nim."'") ;
	    $datas=mysqli_num_rows($cari);

	    if (empty($_POST['nim']) || empty($_POST['nama']) || empty($_POST['tgllahir'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-master-data-mahasiswa");

		}else if($datas<1){
	    	$query = "INSERT INTO m_siswa (
	    	nim,
	    	nama,
	    	sex,
	    	tgllahir,
	    	thnmasuk,
	    	nemail
	    	) VALUES (
	    	'$nim',
	    	'$nama',
	    	'$sex',
	    	'$tgllahir',
	    	'$thnmasuk',
	    	'$nemail')";
	    	$hasil = mysqli_query($Open,$query);
	    	if(!$hasil){
	    		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	    	}else{
				$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
				header("location:index.php?page=form-view-data-mahasiswa");
	    	}

	    }else{
	    		$_SESSION['pesan'] = "Oops! Data sudah ada ...";
				header("location:index.php?page=form-master-data-mahasiswa");
	    }
	}
?>
</div>