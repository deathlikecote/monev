<!-- begin page-header -->
<h1 class="page-header">Backup <small>Database </small></h1>
<!-- end page-header -->
<div class="profile-container">
	<?php
	$file = '../assets/backup/esurvei-'.date('Ymd').'.sql';
		backupDatabaseTables('localhost','root','','ekuisioner');

		function backupDatabaseTables($dbHost,$dbUsername,$dbPassword,$dbName,$tables = '*'){
		  //menghubungkan & memilih DB
		  $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
		 //Mendapatkan semua Table
		 if($tables == '*'){
		  $tables = array();
		  $result = $db->query("SHOW TABLES");
		  while($row = $result->fetch_row()){
		   $tables[] = $row[0];
		  }
		 }else{
		  $tables = is_array($tables)?$tables:explode(',',$tables);
		 }
		 $return = '';
		 //Loop melalui Table
		 foreach($tables as $table){
		  $result = $db->query("SELECT * FROM $table");
		  $numColumns = $result->field_count;
		  $return .= "DROP TABLE $table;";
		        $result2 = $db->query("SHOW CREATE TABLE $table");
		        $row2 = $result2->fetch_row();
		  $return .= "\n\n".$row2[1].";\n\n";
		  for($i = 0; $i < $numColumns; $i++){
		   while($row = $result->fetch_row()){
		    $return .= "INSERT INTO $table VALUES(";
		    for($j=0; $j < $numColumns; $j++){
		     $row[$j] = addslashes($row[$j]);
		     $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
		     if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
		     if ($j < ($numColumns-1)) { $return.= ','; }
		    }
		    $return .= ");\n";
		   }
		  }
		  $return .= "\n\n\n";
		 }
		 //simpan file
		 $handle = fopen('../assets/backup/esurvei-'.date('Ymd').'.sql','w+');
		 fwrite($handle,$return);
		 fclose($handle);
		}
	?>
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="panel-body">
			<div class="form-group">
				<p align="center">Backup Database Berhasil ! Silahkan download ...</p>
			</div>
			<div class="form-group">
				<br />
			</div>
			<div class="form-group">
				<p align="center">
					<a type="button" href="<?=$file?>" title="Download" target="_blank" class="btn btn-success" download><i class="fa-lg ion-ios-cloud-download-outline"></i> &nbsp;Download</a>
				</p>
			</div>
		</div>
	</div>
	
</div>