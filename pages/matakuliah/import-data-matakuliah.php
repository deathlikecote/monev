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
		            $kodemk		= $spreadSheetAry[$i]['1'];
					$namamk		= $spreadSheetAry[$i]['2'];
					$namemk		= $spreadSheetAry[$i]['3'];
					$skst		= $spreadSheetAry[$i]['4'];
					$sksp		= $spreadSheetAry[$i]['5'];
					$sks		= $spreadSheetAry[$i]['6'];
					$kelmk		= $spreadSheetAry[$i]['7'];
			        
			        $cek=mysqli_num_rows (mysqli_query($Open,"SELECT * FROM m_matakuliah WHERE kodemk='$kodemk'"));
					
					if($cek > 0) {
						$query = mysqli_query($Open,"UPDATE m_matakuliah SET 
							namamk = '$namamk',
							namemk = '$namemk',
							skst = '$skst',
							sksp = '$sksp',
							sks = '$sks',
							kelmk = '$kelmk'
							where kodemk = '$kodemk'
							");

						if($query){
							$berhasil++;
						}else{
							$gagal++;
						}

					}else{
						$insert = mysqli_query($Open,"INSERT INTO m_matakuliah (
				    	kodemk,
				    	namamk,
				    	namemk,
				    	skst,
				    	sksp,
				    	sks,
				    	kelmk
				    	) VALUES (
				    	'$kodemk',
				    	'$namamk',
				    	'$namemk',
				    	'$skst',
				    	'$sksp',
				    	'$sks',
				    	'$kelmk')");

						if($insert){
							$berhasil++;
						}else {
							$gagal++;
						}
					}
				}
			       $_SESSION['pesan'] = "Import berhasil!<br>Berhasil : ".$berhasil." | Gagal : ".$gagal."  ...";
				   header("location:../index.php?page=form-view-data-matakuliah");
		        }else {
			        $type = "error";
			        $message = "File harus .xls / .xlsx.";
			    }
	
?>
