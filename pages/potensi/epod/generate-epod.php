<?php
session_start();
include "../../../config/koneksi.php";

date_default_timezone_set('Asia/Jakarta');
ini_set('max_execution_time', 0);

$_SESSION['berhasil'] = 0;
$_SESSION['duplikat'] = 0;
$_SESSION['gagal'] = 0;

$pertext = $_SESSION['perteks'];
$utsuas = $_SESSION['utsuas'];

mysqli_query($Open, "TRUNCATE TABLE exoxpotensi");
mysqli_query($Open, "TRUNCATE TABLE epoddata");
mysqli_query($Open, "TRUNCATE TABLE edopdata");

$totalpotensi = 0;
$dosen_prodi=mysqli_query($Open,"select a.*, b.namamk from t_penugasan a, m_matakuliah b where (a.perta = '".$_SESSION['perta']."') and (b.kodemk = a.kodemk) group by a.kodedosen, a.kdprodi, a.kodemk") ;
while($data_dosen_prodi=mysqli_fetch_array($dosen_prodi)){
		$dosenosplit = $data_dosen_prodi['kodedosen'];
		$myArray = explode('/', $dosenosplit);
		foreach($myArray as $dosensplit){
			$totalpotensi++;
		}
}

$row=mysqli_query($Open,"select a.*, b.namamk from t_penugasan a, m_matakuliah b where (a.perta = '".$_SESSION['perta']."') and (b.kodemk = a.kodemk) group by a.kodedosen, a.kdprodi, a.kodemk") ;

while($data=mysqli_fetch_array($row)){

		$dosenosplit = $data['kodedosen'];
		$myArray = explode('/', $dosenosplit);
		foreach($myArray as $dosensplit){

		$kedops 	= $dosensplit."".$data['kodemk']."".$data['kdprodi'];
		$kodedps	= $dosensplit."".$data['kdprodi'];

		$caripot=mysqli_query($Open,"select * from exoxpotensi where ta='".$_SESSION['perta']."' and concat(kodedosen,kodemk,idprogstudi) = '".$kedops."'") ;
		$datapot=mysqli_num_rows($caripot);
		if($datapot<1){

			$nmdosen=mysqli_query($Open,"select nama from m_dosen where kodedosen = '".$dosensplit."'") ;
			$data_nmdosen=mysqli_fetch_assoc($nmdosen);
			if(empty($data_nmdosen['nama'])){
				$data_nmdosen['nama'] = '?';
			}

			$query = "INSERT INTO exoxpotensi 
			(
				ta,
				per,
				utsuas,
				kodemk,
				kodedosen,
				idprogstudi,
				done_p,
				done_d,
				namamk,
				namadosen,
				spote_p,
				spote_d,
				epodpot,
				kedop,
				kodedp
			)
			 VALUES (
			 	'".$data['perta']."',
				'".$pertext."',
				'".$utsuas."',
				'".$data['kodemk']."',
				'".$dosensplit."',
				'".$data['kdprodi']."',
				'0',
				'0',
				'".$data['namamk']."',
				'".$data_nmdosen['nama']."',
				'0',
				'0',
				'0',
				'".$kedops."',
				'".$kodedps."'
			 	)";
			$hasil = mysqli_query($Open,$query);
			if(!$hasil){
				$_SESSION['gagal']++;
				$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
				 echo '<script>
				 	parent.document.getElementById("ee_bar").style.width ="'.$percent.'";
					parent.document.getElementById("ee_bar").innerHTML ="'.$percent.'";
					parent.document.getElementById("ee_bar_no").innerHTML ="'.$_SESSION['gagal'].'";
					parent.document.getElementById("ee_bar_total").innerHTML ="'. $totalpotensi.'";
					</script>';
				ob_flush(); 
				flush();
			}else{
				
				$berhasil++;
				$_SESSION['berhasil']++;
				$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
				 echo '<script>
					parent.document.getElementById("ee_bar").style.width ="'.$percent.'";
					parent.document.getElementById("ee_bar").innerHTML ="'.$percent.'";
					parent.document.getElementById("ee_bar_ok").innerHTML ="'.$_SESSION['berhasil'].'";
					parent.document.getElementById("ee_bar_total").innerHTML ="'. $totalpotensi.'";
					</script>';
				ob_flush(); 
				flush();
			}
		}else{
			$_SESSION['duplikat']++;
			$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
			 echo '<script>
			 	parent.document.getElementById("ee_bar").style.width ="'.$percent.'";
				parent.document.getElementById("ee_bar").innerHTML ="'.$percent.'";
				parent.document.getElementById("ee_bar_dup").innerHTML ="'.$_SESSION['duplikat'].'";
				parent.document.getElementById("ee_bar_total").innerHTML ="'. $totalpotensi.'";
				</script>';
			ob_flush(); 
			flush();
		}
	} //eof spitdosen
}

$query_update = mysqli_query($Open,"SELECT kodedp FROM exoxpotensi 
				WHERE kodedp NOT IN (SELECT kodedp FROM exoxpotensi GROUP BY kodedp HAVING COUNT(*) > 1)");

while($data_qu=mysqli_fetch_array($query_update)){
	mysqli_query($Open, "UPDATE exoxpotensi SET epodpot = '1' WHERE kodedp = '".$data_qu['kodedp']."' ");
}

$query_update = "UPDATE exoxpotensi AS t
		  JOIN 
		    ( SELECT MIN(id) MinID
		      FROM exoxpotensi
		      GROUP BY kodedp
		      HAVING COUNT(*) > 1
		    ) AS m 
		    ON t.id = m.MinID
		SET t.epodpot = '1'";


mysqli_query($Open,$query_update);

$cek=mysqli_query($Open,"select * from t_generate where perta = '".$_SESSION['perta']."' and generate ='eepotensi'") ;
$data_cek=mysqli_num_rows($cek);
if($data_cek < 1){
	$query = "INSERT INTO t_generate (
				perta,
				generate,
				total,
				berhasil,
				duplikat,
				gagal
        ) VALUES (
        		'".$_SESSION['perta']."', 
				'eepotensi', 
				'$totalpotensi', 
				'".$_SESSION['berhasil']."', 
				'".$_SESSION['duplikat']."', 
				'".$_SESSION['gagal']."'
    	)";
	$hasil = mysqli_query($Open,$query);

}else{

	$query = "UPDATE t_generate SET
						total			= '$totalpotensi',
						berhasil 		= '".$_SESSION['berhasil']."',
						duplikat 		= '".$_SESSION['duplikat']."',
						gagal			= '".$_SESSION['gagal']."',
						waktu			= '".date('Y-m-d H:i:s')."'
						where 
						perta 			= '".$_SESSION['perta']."' and 
						generate 		= 'eepotensi'";


	$hasil = mysqli_query($Open,$query);
}

$lgenerate=mysqli_query($Open,"select waktu from t_generate where perta = '".$_SESSION['perta']."' and generate ='eepotensi'") ;
$data_lgenerate=mysqli_fetch_assoc($lgenerate);

 echo '<script>
			parent.document.getElementById("ee_bar").style.width ="100%";
			parent.document.getElementById("ee_bar").innerHTML ="Selesai";
			parent.document.getElementById("ee_bar_lastgenerate").innerHTML ="'.$data_lgenerate['waktu'].'";
			if(parent.document.getElementById("ee_bar").innerHTML ="Selesai"){
				parent.location.reload();
			}
	   </script>';

unset($_SESSION["berhasil"]);
unset($_SESSION["gagal"]);
unset($_SESSION["duplikat"]);
		 

		 

?>