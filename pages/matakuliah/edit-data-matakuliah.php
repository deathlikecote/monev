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
	$idmk 		= $id;
	$kodemk 	= strtoupper($_POST['kodemk']);
	$namamk 	= $_POST['namamk'];
	$namemk 	= $_POST['namemk'];
	$skst 		= $_POST['skst'];
	$sksp 		= $_POST['sksp'];
	$sks 		= $_POST['sks'];
	$kelmk 		= strtoupper($_POST['kelmk']);
	$kodemk_old	=$_POST['kodemk_old'];
	
	$tampilUsr	= mysqli_query($Open,"SELECT id FROM m_user WHERE nama_user='$kodedosen_old'");
	$hasil	= mysqli_fetch_assoc ($tampilUsr);

		 if (empty($_POST['kodemk']) || empty($_POST['namamk'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-edit-data-matakuliah&id=$id");

		}else{
			$cekuser	=mysqli_num_rows (mysqli_query($Open,"SELECT kodemk FROM m_matakuliah WHERE kodemk='$_POST[kodemk]'"));

			 if($cekuser > 0 && $kodemk != $kodemk_old) {
					$_SESSION['pesan'] = "Oops! Data sudah ada ...";
					header("location:index.php?page=form-edit-data-matakuliah&id=$id");
			 	
			 }else{
				$update= mysqli_query ($Open,"UPDATE m_matakuliah SET 
				kodemk = '$kodemk',
				namamk = '$namamk',
				namemk = '$namemk',
				skst = '$skst',
				sksp = '$sksp',
				sks = '$sks',
				kelmk = '$kelmk'
				where id = '$idmk'");
				if($update){
					$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
					header("location:index.php?page=form-view-data-matakuliah");
				}
				else {
					echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
				}
			}
			
			
		}
	}
?>
</div>