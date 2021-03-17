<?php
session_start();
		use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
		use PhpOffice\PhpSpreadsheet\Spreadsheet;
		use PhpOffice\PhpSpreadsheet\Reader\Csv;
		require_once "../../assets/plugins/importexcel/autoload.php";
		include "../../config/koneksi.php";

		    $allowedFileType = [
		        'application/vnd.ms-excel',
		        'text/xls',
		        'text/xlsx',
		        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		    ];

		    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

		        $targetPath = '../../assets/file/import/'.$_FILES['file']['name'];
		        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

		        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

		        $spreadSheet = $Reader->load($targetPath);
		        $excelSheet = $spreadSheet->getActiveSheet();
		        $spreadSheetAry = $excelSheet->toArray();
		        $sheetCount = count($spreadSheetAry);

		        $berhasil =0;
		        $gagal=0;
		        for ($i = 4; $i < $sheetCount; $i ++) {
					$nim		= $spreadSheetAry[$i]['1'];
					$nama		= $spreadSheetAry[$i]['2'];
					$sex		= $spreadSheetAry[$i]['3'];
					$tgllahir	= $spreadSheetAry[$i]['4'];
					$thnmasuk	= $spreadSheetAry[$i]['5'];
					$nemail		= $spreadSheetAry[$i]['6'];
			        
			        $cek=mysqli_num_rows (mysqli_query($Open,"SELECT * FROM m_siswa WHERE nim='$nim'"));
					
					if($cek > 0) {
						$query = mysqli_query($Open,"UPDATE m_siswa SET 
							nama = '$nama',
							sex = '$sex',
							tgllahir = '$tgllahir',
							thnmasuk = '$thnmasuk',
							nemail = '$nemail'
							where nim = '$nim'
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
						$insert = mysqli_query($Open,"INSERT INTO m_siswa (
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
						'$nemail')");

						if($insert){
							$berhasil++;
						}else {
							$gagal++;
						}
					}
				}
			       $_SESSION['pesan'] = "Import berhasil!<br>Berhasil : ".$berhasil." | Gagal : ".$gagal."  ...";
				   header("location:../index.php?page=form-view-data-mahasiswa");
		        }else {
			        $type = "error";
			        $message = "File harus .xls / .xlsx.";
			    }
	
?>
