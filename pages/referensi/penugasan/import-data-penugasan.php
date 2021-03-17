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
				$kodemk		= $spreadSheetAry[$i]['4'];
				$kodedosen	= $spreadSheetAry[$i]['5'];
		        
		        $cek=mysqli_num_rows (mysqli_query($Open,"SELECT * FROM t_penugasan WHERE perta ='".$perta."' AND
		        	 kdprodi ='".$kdprodi."' AND
		        	 kelas ='".$kelas."' AND
		        	 kodemk ='".$kodemk."' AND
		        	 kodedosen ='".$kodedosen."'
		        	"));
				
				if($cek > 0) {
					
					$gagal++;
					
				}else{

					$insert = mysqli_query($Open,"INSERT INTO t_penugasan (
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
			    	)");
					
					if($insert){
						$berhasil++;
					}else {
						$gagal++;
					}
				}
			}
		       $_SESSION['pesan'] = "Import berhasil!<br>Berhasil : ".$berhasil." | Gagal : ".$gagal."  ...";
			   header("location:../../index.php?page=form-view-data-penugasan");
	        }else {
		        $type = "error";
		        $message = "File harus .xls / .xlsx.";
		    }
	
?>
