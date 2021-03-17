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
		            $kodeprodi     	= $spreadSheetAry[$i]['1'];
		            $namaprodi     	= $spreadSheetAry[$i]['2'];
		            $jurprodi     	= $spreadSheetAry[$i]['3'];
		            $jenprodi		= $spreadSheetAry[$i]['4'];
			        
			        $cek=mysqli_num_rows (mysqli_query($Open,"SELECT * FROM m_prodi WHERE kodeprodi='$kodeprodi'"));
					
					if($cek > 0) {
						$query = mysqli_query($Open,"UPDATE m_prodi SET
							namaprodi ='$namaprodi',
							jurprodi ='$jurprodi',
							jenprodi ='$jenprodi'
							WHERE kodeprodi = '$kodeprodi'
							");

						$query = mysqli_query($Open,"UPDATE m_user SET
						nama ='".(ucwords(strtolower($namaprodi)))."'
						WHERE nama_user = '$kodeprodi'
						");

						if($query){
							$berhasil++;
						}else{
							$gagal++;
						}

					}else{
						$insert = mysqli_query($Open,"INSERT INTO m_prodi (
						kodeprodi,
						namaprodi,
						jurprodi,
						jenprodi
						) VALUES (
						'$kodeprodi',
						'$namaprodi',
						'$jurprodi',
						'$jenprodi')");
						
						$insert = mysqli_query($Open,"INSERT INTO m_user (
						nama_user, 
						nama,
						hak_akses,
						passtext,
						password,
						status) 
						VALUES (
						'$kodeprodi', 
						'".(ucwords(strtolower($namaprodi)))."',
						'Prodi',
						'".$GLOBALS['passTextDef']."',
						'".$GLOBALS['passDef']."', 
						'1')");

						if($insert){
							$berhasil++;
						}else {
							$gagal++;
						}
					}
				}
			       $_SESSION['pesan'] = "Import berhasil!<br>Berhasil : ".$berhasil." | Gagal : ".$gagal."  ...";
				   header("location:../index.php?page=form-view-data-prodi");
		        }else {
			        $type = "error";
			        $message = "File harus .xls / .xlsx.";
			    }
	
?>
