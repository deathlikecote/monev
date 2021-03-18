<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$perta		= $_POST['perta'];
		$kdprodi	= $_POST['kdprodi'];
		$kelas		= $_POST['kelas'];
		$status		= $_POST['status'];
		$nimnama	= $_POST['nim'];
		$exnimnama	= explode('|', $nimnama);
		$nim 		= $exnimnama[0];
		$nama 		= $exnimnama[1];

		include "../config/koneksi.php";
		$cari=mysqli_query($Open,"select * from t_kelas where nim='".$nim."' and perta = '".$perta."'") ;
	    $datas=mysqli_num_rows($cari);
	    $qr=mysqli_query($Open,"SELECT nama, tgllahir FROM m_siswa WHERE nim='".$nim."'") ;
		$r=mysqli_fetch_assoc($qr);
		$tgllahir = str_replace('-', '', $r['tgllahir']);
	    if($datas<1){
	    	$query = "INSERT INTO t_kelas (
	    	perta,
	    	kdprodi,
			kelas,
			nim,
			nama,
			status
	    	) VALUES (
	    	'$perta',
	    	'$kdprodi',
			'$kelas',
			'$nim',
			'".$r['nama']."',
			'$status'
	    	)";
	    	$hasil = mysqli_query($Open,$query);
	    	if(!$hasil){
	    		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	    	}else{

	    		$cari=mysqli_query($Open,"SELECT * FROM m_user WHERE nama_user='".$nim."'") ;
	    		$datas=mysqli_num_rows($cari);

	    		if($datas<1){
	    			$insert = "INSERT INTO m_user (nama_user, nama, passtext, password, hak_akses, avatar, status) VALUES ('$nim', '".(ucwords(strtolower($r['nama'])))."', '$tgllahir', '".(md5($tgllahir))."', 'Mahasiswa', '', '1')";
					$query = mysqli_query ($Open,$insert);
					
					if($query){
						$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
						header("location:index.php?page=form-view-data-kelas");
					}
					else {
						echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
					}
	    		}else{
	    			$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
					header("location:index.php?page=form-view-data-kelas");
	    		}
	    	}

	    }else{
	    		$_SESSION['pesan'] = "Oops! Data sudah ada ...";
				header("location:index.php?page=form-master-data-kelas");
	    }
	}
?>
</div>