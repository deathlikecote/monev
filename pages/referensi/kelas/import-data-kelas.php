<?php
session_start();
		use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
		use PhpOffice\PhpSpreadsheet\Spreadsheet;
		use PhpOffice\PhpSpreadsheet\Reader\Csv;
		require_once "../../../assets/plugins/importexcel/autoload.php";
		include "../../../config/koneksi.php";

		    $allowedFileType = [
		        'application/vnd.ms-excel',
		        'text/xls',
		        'text/xlsx',
		        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		    ];

		    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

		        $targetPath = '../../../assets/file/import/'.$_FILES['file']['name'];
		        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

		        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

		        $spreadSheet = $Reader->load($targetPath);
		        $excelSheet = $spreadSheet->getActiveSheet();
		        $spreadSheetAry = $excelSheet->toArray();
		        $sheetCount = count($spreadSheetAry);

		        $berhasil =0;
		        $gagal=0;
		        for ($i = 4; $i < $sheetCount; $i ++) {
		            $perta		= $spreadSheetAry[$i]['1'];
					$kdprodi	= $spreadSheetAry[$i]['2'];
					$kelas		= $spreadSheetAry[$i]['3'];
					$nim		= $spreadSheetAry[$i]['4'];
					$nama		= $spreadSheetAry[$i]['5'];
					$status		= $spreadSheetAry[$i]['6'];
			        
			        $cek=mysqli_num_rows (mysqli_query($Open,"SELECT * FROM t_kelas WHERE nim='$nim' AND perta ='".$perta."'"));
			        $qr=mysqli_query($Open,"SELECT nama, tgllahir FROM m_siswa WHERE nim='".$nim."'") ;
					$r=mysqli_fetch_assoc($qr);
					$tgllahir = str_replace('-', '', $r['tgllahir']);
					
					if($cek > 0) {
						$query = mysqli_query($Open,"UPDATE t_kelas SET
							kdprodi ='$kdprodi',
							kelas ='$kelas',
							nama ='$nama',
							status ='$status'
							WHERE nim = '$nim' AND perta ='".$perta."'
							");

						$query = mysqli_query($Open,"UPDATE m_user SET
						nama ='".(ucwords(strtolower($nama)))."'
						WHERE nama_user = '$nim'
						");

						if($query){
							$berhasil++;
						}else{
							$gagal++;
						}

					}else{
						if(!empty($tgllahir) || $tgllahir != ""){

						$insert = mysqli_query($Open,"INSERT INTO t_kelas (
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
						'$nama',
						'$status')");
						
						$cari=mysqli_query($Open,"SELECT * FROM m_user WHERE nama_user='".$nim."'") ;
			    		$datas=mysqli_num_rows($cari);

			    		if($datas<1){
						$insert = mysqli_query ($Open,"INSERT INTO m_user (nama_user, nama, passtext, password, hak_akses, avatar, status) VALUES ('$nim', '".(ucwords(strtolower($nama)))."', '$tgllahir', '".(md5($tgllahir))."', 'Mahasiswa', '', '1')");

							if($insert){
								$berhasil++;
							}else {
								$gagal++;
							}
						}
						}else{
							$gagal++;
						}
					}
				}
			       $_SESSION['pesan'] = "Import berhasil!<br>Berhasil : ".$berhasil." | Gagal : ".$gagal."  ...";
				   header("location:../../index.php?page=form-view-data-kelas");
		        }else {
			        $type = "error";
			        $message = "File harus .xls / .xlsx.";
			    }
	
?>
