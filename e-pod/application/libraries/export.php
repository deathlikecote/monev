<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Export{
    
	// Function penanda awal file (Begin Of File) Excel
	function xlsBOF($filename) {
		
		ob_start();

		header("Pragma: public");
		header("Expires: 0");
		
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");

		// header untuk nama file
		header("Content-Disposition: attachment;
				filename=".$filename.".xls");
		header("Content-Transfer-Encoding: binary ");		
		echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
		return;
	}

	// Function penanda akhir file (End Of File) Excel
	function xlsEOF() {
		
		echo pack("ss", 0x0A, 0x00);
		ob_flush();
		exit();	
	}

	// Function untuk menulis data (angka) ke cell excel
	function xlsWriteNumber($Row, $Col, $Value) {
		echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
		echo pack("d", $Value);
		return;
	}

	// Function untuk menulis data (text) ke cell excel
	function xlsWriteLabel($Row, $Col, $Value ) {
		$L = strlen($Value);
		echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
		echo $Value;
		return;
	}

	function que_to_excel( $que, $filename, $dataheader = array()) {
						
		if ($que->num_rows()){
			
			$databody = $que->result_array();				
			if ( ! count($dataheader[0])){
				$dataheader[0] = $que->list_fields();			
			}
		}else{
			
			$databody =  array();
			$dataheader[0] = array();
		}
		
		$this->arr_to_excel($databody, $filename, $dataheader); 		
	}
	
	
	function arr_to_excel($array, $filename, $dataheader = array()) {
				
		// excel Begin Of File
		$this->xlsBOF($filename);
		
		// SET TO ROW no 1
		$nobarisheader=0;
		
		// write TITLE
		$this->xlsWriteLabel($nobarisheader,0,"POLTEKPAR PALEMBANG");               
		
		// count SUB TITLE
		$rowhead = count($dataheader);
		
		// ada SUB TITLE?
		if ($rowhead){
			
			//YES!!! ADA
			
			// generate SUB TITLE
			for ($x=1; $x<$rowhead; $x++){
				$this->xlsWriteLabel($nobarisheader+$x,0,$dataheader[$x]);               		
			}			
			
			// prepare TABLE HEADER
			$nobarisheader = $nobarisheader + $rowhead + 1;			
			$numcols = count($dataheader[0]);
			
			// generate TABLE HEADER
			for ($x=0; $x<$numcols; $x++){
				$this->xlsWriteLabel($nobarisheader,$x, str_replace('_',' ',strtoupper($dataheader[0][$x])));               		
			}						
		}
		
		// prepare TABLE DATA
		$nobarisheader = $nobarisheader + 1;
		$rowdata = count($array);
		
		// ada TABLE DATA?
		if ($rowdata){
			
			//YES!!! ADA
			
			// untuk setiap ROW dalam TABLE DATA
			$rawpos = $nobarisheader;
			foreach ($array as $raw) {
				
				// untuk setiap FIELD dalam ROW
				$calpos = 0;
				foreach ($raw as $kolom) {
					
					// apakah data NUMERIC ??
					if (is_numeric($kolom)) {
						
						//YES!
						$this->xlsWriteNumber($rawpos,$calpos,$kolom);               											
					} else {
						
						//NO!
						$this->xlsWriteLabel($rawpos,$calpos,$kolom);               						
					} 
					
					$calpos++;
				} 
				
				$rawpos++;
			}
		}else{
			
			//NO!!! ADA
			$this->xlsWriteLabel($nobarisheader,0,'DATA BELUM ADA');               					
		}
		
		// excel End Of File
		$this->xlsEOF();
	}
}