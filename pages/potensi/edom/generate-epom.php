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

mysqli_query($Open, "TRUNCATE TABLE epompotensi");
mysqli_query($Open, "TRUNCATE TABLE epomdata");

$totalpotensi = 0;
$t_kelas=mysqli_query($Open,"SELECT * FROM t_kelas WHERE perta = '".$_SESSION['perta']."' AND status ='Aktif'") ;
while($data_t_kelas=mysqli_fetch_array($t_kelas)){
		$totalpotensi++;
}

$row=mysqli_query($Open,"SELECT * FROM t_kelas WHERE perta = '".$_SESSION['perta']."' AND status ='Aktif'") ;
while($data=mysqli_fetch_array($row)){
			$kodex 	= $data['kdprodi']."".$data['kelas'];

		$caripot=mysqli_query($Open,"SELECT * FROM epompotensi WHERE ta='".$_SESSION['perta']."' and nim='".$data['nim']."' and idprogstudi = '".$data['kdprodi']."' and kelas_id = '".$data['kelas']."'") ;
		$datapot=mysqli_num_rows($caripot);
		if($datapot<1){
			//echo "kosong<br>";
			$query = "INSERT INTO epompotensi 
			(
				ta,
				per,
				utsuas,
				nim,
				idprogstudi,
				done,
				spote,
				kelas_id,
				kode
			)
			 VALUES (
				'".$data['perta']."',
				'".$pertext."',
				'".$utsuas."',
				'".$data['nim']."',
				'".$data['kdprodi']."',
				'0',
				'0',
				'".$data['kelas']."',
				'".$kodex."'
			 	)";
			$hasil = mysqli_query($Open,$query);
			if(!$hasil){
				$_SESSION['gagal']++;
				$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
				 echo '<script>
				 	parent.document.getElementById("epom_bar").style.width ="'.$percent.'";
					parent.document.getElementById("epom_bar").innerHTML ="'.$percent.'";
					parent.document.getElementById("epom_bar_no").innerHTML ="'.$_SESSION['gagal'].'";
					parent.document.getElementById("epom_bar_total").innerHTML ="'. $totalpotensi.'";
					</script>';
				ob_flush(); 
				flush();
			}else{
				
				$_SESSION['berhasil']++;
				$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
				 echo '<script>
					parent.document.getElementById("epom_bar").style.width ="'.$percent.'";
					parent.document.getElementById("epom_bar").innerHTML ="'.$percent.'";
					parent.document.getElementById("epom_bar_ok").innerHTML ="'.$_SESSION['berhasil'].'";
					parent.document.getElementById("epom_bar_total").innerHTML ="'. $totalpotensi.'";
					</script>';
				ob_flush(); 
				flush();
			}
		}else{
			$_SESSION['duplikat']++;
			$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
			 echo '<script>
			 	parent.document.getElementById("epom_bar").style.width ="'.$percent.'";
				parent.document.getElementById("epom_bar").innerHTML ="'.$percent.'";
				parent.document.getElementById("epom_bar_dup").innerHTML ="'.$_SESSION['duplikat'].'";
				parent.document.getElementById("epom_bar_total").innerHTML ="'. $totalpotensi.'";
				</script>';
			ob_flush(); 
			flush();
		}

}

$cek=mysqli_query($Open,"select * from t_generate where perta = '".$_SESSION['perta']."' and generate ='epompotensi'") ;
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
				'epompotensi', 
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
						generate 		= 'epompotensi'";


	$hasil = mysqli_query($Open,$query);
}

$lgenerate=mysqli_query($Open,"select waktu from t_generate where perta = '".$_SESSION['perta']."' and generate ='epompotensi'") ;
$data_lgenerate=mysqli_fetch_assoc($lgenerate);

 echo '<script>
			parent.document.getElementById("epom_bar").style.width ="100%";
			parent.document.getElementById("epom_bar").innerHTML ="Selesai";
			parent.document.getElementById("epom_bar_lastgenerate").innerHTML ="'.$data_lgenerate['waktu'].'";
			if(parent.document.getElementById("epom_bar").innerHTML ="Selesai"){
				parent.location.reload();
			}
	   </script>';

unset($_SESSION["berhasil"]);
unset($_SESSION["gagal"]);
unset($_SESSION["duplikat"]);

		 

?>