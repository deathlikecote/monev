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

mysqli_query($Open, "TRUNCATE TABLE edompotensi");
mysqli_query($Open, "TRUNCATE TABLE edomdata");

$totalpotensi = 0;
$t_kelas=mysqli_query($Open,"select * from t_kelas where perta = '".$_SESSION['perta']."' AND status ='Aktif'") ;
while($data_t_kelas=mysqli_fetch_array($t_kelas)){
	$potensi=mysqli_query($Open,"
	SELECT 
		a.*, b.namamk
	FROM 
		t_penugasan a, m_matakuliah b
	WHERE
		(a.perta = '".$_SESSION['perta']."' and 
		a.kdprodi='".$data_t_kelas['kdprodi']."' and 
		a.kelas = '".$data_t_kelas['kelas']."') and
		(b.kodemk = a.kodemk)
		GROUP BY a.kdprodi, a.kelas, a.kodemk, a.kodedosen");

	while($data_potensi=mysqli_fetch_array($potensi)){
		$dosenosplit = $data_potensi['kodedosen'];
		$myArray = explode('/', $dosenosplit);
		foreach($myArray as $dosensplit){
			$totalpotensi++;
		}
		
	}

}

$row=mysqli_query($Open,"select * from t_kelas where perta = '".$_SESSION['perta']."' AND status ='Aktif'") ;
while($data=mysqli_fetch_array($row)){
	$cari=mysqli_query($Open,"
		SELECT 
			a.*, b.namamk
		FROM 
			t_penugasan a, m_matakuliah b
		WHERE
			(a.perta = '".$_SESSION['perta']."' and 
			a.kdprodi='".$data['kdprodi']."' and 
			a.kelas = '".$data['kelas']."') and
			(b.kodemk = a.kodemk)
			GROUP BY a.kdprodi, a.kelas, a.kodemk, a.kodedosen order by a.kodedosen asc");

		while($kur=mysqli_fetch_array($cari)){
		

		$dosenosplit = $kur['kodedosen'];
		$myArray = explode('/', $dosenosplit);
		foreach($myArray as $dosensplit){

		$kodex 	= $dosensplit."".$kur['kodemk']."".$kur['kdprodi']."".$kur['kelas'];
		$kodex2 = $dosensplit."".$kur['kdprodi'];

		$caripot=mysqli_query($Open,"select * from edompotensi where ta='".$_SESSION['perta']."' and nim='".$data['nim']."' and kodemk = '".$kur['kodemk']."' and idprogstudi = '".$data['kdprodi']."' and kelas = '".$data['kelas']."' and kodedosen = '".$dosensplit."'") ;
		$datapot=mysqli_num_rows($caripot);
		if($datapot<1){
			
			$nmdosen=mysqli_query($Open,"select nama from m_dosen where kodedosen = '".$dosensplit."'") ;
			$data_nmdosen=mysqli_fetch_assoc($nmdosen);
			if(empty($data_nmdosen['nama'])){
				$data_nmdosen['nama'] = '?';
			}
			$query = "INSERT INTO edompotensi 
			(
				ta,
				per,
				utsuas,
				nim,
				kodemk,
				kodedosen,
				idprogstudi,
				done,
				namamk,
				namadosen,
				spote,
				kelas,
				kode,
				kode2
			)
			 VALUES (
			 	'".$data['perta']."',
				'".$pertext."',
				'".$utsuas."',
				'".$data['nim']."',
				'".$kur['kodemk']."',
				'".$dosensplit."',
				'".$kur['kdprodi']."',
				'0',
				'".$kur['namamk']."',
				'".$data_nmdosen['nama']."',
				'0',
				'".$data['kelas']."',
				'".$kodex."',
				'".$kodex2."'
			 	)";
			$hasil = mysqli_query($Open,$query);
			if(!$hasil){
				$_SESSION['gagal']++;
				$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
				 echo '<script>
				 	parent.document.getElementById("edom_bar").style.width ="'.$percent.'";
					parent.document.getElementById("edom_bar").innerHTML ="'.$percent.'";
					parent.document.getElementById("edom_bar_no").innerHTML ="'.$_SESSION['gagal'].'";
					parent.document.getElementById("edom_bar_total").innerHTML ="'. $totalpotensi.'";
					</script>';
				ob_flush(); 
				flush();
			}else{
				
				$_SESSION['berhasil']++;
				$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
				 echo '<script>
					parent.document.getElementById("edom_bar").style.width ="'.$percent.'";
					parent.document.getElementById("edom_bar").innerHTML ="'.$percent.'";
					parent.document.getElementById("edom_bar_ok").innerHTML ="'.$_SESSION['berhasil'].'";
					parent.document.getElementById("edom_bar_total").innerHTML ="'. $totalpotensi.'";
					</script>';
				ob_flush(); 
				flush();
			}
		}else{
			$_SESSION['duplikat']++;
			$percent = intval( ($_SESSION['berhasil'] + $_SESSION['gagal'] + $_SESSION['duplikat']) / $totalpotensi * 100)."%";
			 echo '<script>
			 	parent.document.getElementById("edom_bar").style.width ="'.$percent.'";
				parent.document.getElementById("edom_bar").innerHTML ="'.$percent.'";
				parent.document.getElementById("edom_bar_dup").innerHTML ="'.$_SESSION['duplikat'].'";
				parent.document.getElementById("edom_bar_total").innerHTML ="'. $totalpotensi.'";
				</script>';
			ob_flush(); 
			flush();
		}


	} //eof split dosen

	}
}

$cek=mysqli_query($Open,"select * from t_generate where perta = '".$_SESSION['perta']."' and generate ='edompotensi'") ;
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
				'edompotensi', 
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
						generate 		= 'edompotensi'";


	$hasil = mysqli_query($Open,$query);
}

$lgenerate=mysqli_query($Open,"select waktu from t_generate where perta = '".$_SESSION['perta']."' and generate ='edompotensi'") ;
$data_lgenerate=mysqli_fetch_assoc($lgenerate);

 echo '<script>
			parent.document.getElementById("edom_bar").style.width ="100%";
			parent.document.getElementById("edom_bar").innerHTML ="Selesai";
			parent.document.getElementById("edom_bar_lastgenerate").innerHTML ="'.$data_lgenerate['waktu'].'";
			if(parent.document.getElementById("edom_bar").innerHTML ="Selesai"){
				parent.location.reload();
			}
	   </script>';

unset($_SESSION["berhasil"]);
unset($_SESSION["duplikat"]);
unset($_SESSION["gagal"]);

		 

?>