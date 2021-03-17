<?php
	session_start();
	include "../../config/koneksi.php";
	$nama 			= $_POST['projek'];
	$namabaru		= strtolower($nama);
	$nama_value		= str_replace(" ","_", $namabaru);
	$nama_domain	= str_replace(" ","-", $namabaru);
	$id_user 		= $_SESSION['id_user_kuis'];

	if($_POST['jenis'] == 'saveCv') {
		$editCv 		= $_POST['editCv'];
		$idPageDetail 	= $_POST['idPageDetail'];
		$idPage 		= $_POST['idPage'];
		$valuex 		= $_POST['valuex'];
		if(!empty($_POST['isianCv'])){
			$isianCv 		= $_POST['isianCv'];
		}else{
			$isianCv 		= '';
		}

		// echo $nama_value." ".$idPageDetail." ".$idPage." ".$editCv." ".$valuex." ".$isianCv ;
		if($editCv == ''){
			$insert = "INSERT INTO tb_".$nama_value."_answer (
				id_page,
				id_user,
				id_page_detail,
				valuex,
				lainnya
				) VALUES (
				'$idPage',
				'$id_user',
				'$idPageDetail',
				'$valuex',
				'$isianCv')";
			$query = mysqli_query ($Open, $insert);

			$rId=mysqli_fetch_assoc(mysqli_query($Open,"SELECT id FROM tb_".$nama_value."_answer WHERE id_page = '".$idPage."' and id_page_detail ='".$idPageDetail."' AND id_user='".$id_user."'"));

			echo $rId['id'];

		}else{
			$qry= "UPDATE tb_".$nama_value."_answer SET 
			valuex='$valuex',
			lainnya='$isianCv'
			WHERE id='$editCv'
			";
			$query = mysqli_query ($Open, $qry);

			echo $editCv;
		}

	}else if($_POST['jenis'] == 'saveTn') {
		$editTn 		= $_POST['editTn'];
		$idPageDetail 	= $_POST['idPageDetail'];
		$idPage 		= $_POST['idPage'];
		$valuex 		= $_POST['isianTn'];
		if($editTn == ''){
			$insert = "INSERT INTO tb_".$nama_value."_answer (
				id_page,
				id_user,
				id_page_detail,
				valuex
				) VALUES (
				'$idPage',
				'$id_user',
				'$idPageDetail',
				'$valuex')";
			$query = mysqli_query ($Open, $insert);

			$rId=mysqli_fetch_assoc(mysqli_query($Open,"SELECT id FROM tb_".$nama_value."_answer WHERE id_page = '".$idPage."' and id_page_detail ='".$idPageDetail."' AND id_user='".$id_user."'"));

			echo $rId['id'];

		}else{
			$qry= "UPDATE tb_".$nama_value."_answer SET 
			valuex='$valuex'
			WHERE id='$editTn'
			";
			$query = mysqli_query ($Open, $qry);

			echo $editTn;
		}

	}else if($_POST['jenis'] == 'saveTl') {
		$editTl 		= $_POST['editTl'];
		$idPageDetail 	= $_POST['idPageDetail'];
		$idPage 		= $_POST['idPage'];
		$valuex 		= $_POST['isianTl'];
		if($editTl == ''){
			$insert = "INSERT INTO tb_".$nama_value."_answer (
				id_page,
				id_user,
				id_page_detail,
				valuex
				) VALUES (
				'$idPage',
				'$id_user',
				'$idPageDetail',
				'$valuex')";
			$query = mysqli_query ($Open, $insert);

			$rId=mysqli_fetch_assoc(mysqli_query($Open,"SELECT id FROM tb_".$nama_value."_answer WHERE id_page = '".$idPage."' and id_page_detail ='".$idPageDetail."' AND id_user='".$id_user."'"));

			echo $rId['id'];

		}else{
			$qry= "UPDATE tb_".$nama_value."_answer SET 
			valuex='$valuex'
			WHERE id='$editTl'
			";
			$query = mysqli_query ($Open, $qry);

			echo $editTl;
		}

	}else if($_POST['jenis'] == 'saveMd') {
		$editMd 		= $_POST['editMd'];
		$idPageDetail 	= $_POST['idPageDetail'];
		$idPage 		= $_POST['idPage'];
		$valuex 		= $_POST['valuex'];
		if(!empty($_POST['isianMd'])){
			$isianMd 		= $_POST['isianMd'];
			$qry= "UPDATE tb_".$nama_value."_answer SET 
			lainnya='$isianMd'
			WHERE id='$editMd'
			";
			$query = mysqli_query ($Open, $qry);

			echo $editMd;
			break;
		}else{
			$isianMd 		= '';
		}

		// echo $nama_value." ".$idPageDetail." ".$idPage." ".$editMd." ".$valuex." ".$isianMd ;
		if($editMd == ''){
			$insert = "INSERT INTO tb_".$nama_value."_answer (
				id_page,
				id_user,
				id_page_detail,
				id_jwb,
				valuex,
				lainnya
				) VALUES (
				'$idPage',
				'$id_user',
				'$idPageDetail',
				'$valuex',
				'$valuex',
				'$isianMd')";
			$query = mysqli_query ($Open, $insert);

			$rId=mysqli_fetch_assoc(mysqli_query($Open,"SELECT id FROM tb_".$nama_value."_answer WHERE id_page = '".$idPage."' and id_page_detail ='".$idPageDetail."' and id_jwb ='".$valuex."' AND id_user='".$id_user."'"));

			echo $rId['id'];

		}else{
			$qry= "DELETE FROM tb_".$nama_value."_answer 
			WHERE id='$editMd'
			";
			$query = mysqli_query ($Open, $qry);

			echo '';
		}

	}else if($_POST['jenis'] == 'saveOr') {
		$editOr 		= $_POST['editOr'];
		$idPageDetail 	= $_POST['idPageDetail'];
		$idPage 		= $_POST['idPage'];
		$idJwb 			= $_POST['idJwb'];
		$valuex 		= $_POST['valuex'];

		if(!empty($_POST['isianOr'])){
			$isianOr 		= $_POST['isianOr'];
		}else{
			$isianOr 		= '';
		}

		// echo $nama_value." ".$idPageDetail." ".$idPage." ".$editOr." ".$valuex." ".$isianOr ;
		if($editOr == ''){
			$insert = "INSERT INTO tb_".$nama_value."_answer (
				id_page,
				id_user,
				id_page_detail,
				id_jwb,
				valuex,
				lainnya
				) VALUES (
				'$idPage',
				'$id_user',
				'$idPageDetail',
				'$idJwb',
				'$valuex',
				'$isianOr')";
			$query = mysqli_query ($Open, $insert);

			$rId=mysqli_fetch_assoc(mysqli_query($Open,"SELECT id FROM tb_".$nama_value."_answer WHERE id_page = '".$idPage."' and id_page_detail ='".$idPageDetail."' and id_jwb ='".$idJwb."' AND id_user='".$id_user."'"));

			echo $rId['id'];

		}else{
			$qry= "UPDATE tb_".$nama_value."_answer SET 
			id_jwb='$idJwb',
			valuex='$valuex'
			WHERE id='$editOr'
			";
			$query = mysqli_query ($Open, $qry);

			echo $editOr;
		}

	}else if($_POST['jenis'] == 'saveIsianOr') {
		$editOr 		= $_POST['editOr'];
		$isianOr 		= $_POST['isianOr'];

		$qry= "UPDATE tb_".$nama_value."_answer SET 
			lainnya='$isianOr'
			WHERE id='$editOr'
			";
		$query = mysqli_query ($Open, $qry);

		echo $editOr;
	}else {
		die ("Error.");	
	}
?>