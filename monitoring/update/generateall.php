<?php
include "./../../include/koneksi.php";

// ------ update EDOM DATA
$status 	= '';
include "tedomoverall.php";
include "tnilaiedom.php";
$a=0;
$berhasil = 0;
$gagal = 0;
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_edomfinaltotal group by kode, ta, per");
$row = mysqli_num_rows($sql_edop);
if ($row > 0) {
		
		mysqli_query($plm_edom, "DELETE FROM edomdata_es where ta = '".$_SESSION['pertan']."'");
		mysqli_query($plm_edom, "ALTER TABLE edomdata_es AUTO_INCREMENT = 1");

		$sql_edops=mysqli_query($plm_edom, "SELECT * from v_edomfinaltotal group by kode, ta, per");
		while($r_edop=mysqli_fetch_array($sql_edops)){

			$sql = mysqli_query($plm_edom, "insert into edomdata_es (kode,kode2,kodedosen,namadosen,kodemk,idprogstudi,kelas,ta,per,utsuas,A,B,C,D,total) values ('$r_edop[kode]','$r_edop[kode2]','$r_edop[kodedosen]','$r_edop[namadosen]','$r_edop[kodemk]','$r_edop[idprogstudi]','$r_edop[kelas]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]','$r_edop[A]','$r_edop[B]','$r_edop[C]','$r_edop[D]','$r_edop[total]')");	
			$a=$a+1;
			if(!$sql){
				$gagal++;
				// $status .= "Update EDOM DATA <b style='color:red'>error di ".$r_edop['kodedosen']." - ".$r_edop['kelas']." - ".$r_edop['kodemk']."</b><br>";
			}else{
				$berhasil++;
				// $status .= "Update <b>EDOM DATA</b> <b style='color:green'>Sukses</b><br>";
			}
		}

		if($berhasil > $gagal++){
			$status .= "Update <b>EDOM DATA</b> <b style='color:green'>Sukses</b><br>";
		}else{
			$status .= "Update <b>EDOM DATA</b> <b style='color:red'>Gagal</b><br>";
		}
}else{
	$status .= "Data <b>EDOM DATA</b> belum ada<br>";
}

// ------ update EDOM ES

$a=0;
$berhasil = 0;
$gagal = 0;
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_edom_diagram_es_final where ta = '".$_SESSION['pertan']."'");
$row = mysqli_num_rows($sql_edop);
if ($row > 0) {
	mysqli_query($plm_edom, "DELETE FROM edom_diagram_es where ta = '".$_SESSION['pertan']."'");
	mysqli_query($plm_edom, "ALTER TABLE edom_diagram_es AUTO_INCREMENT = 1");
// mysqli_query($plm_edom, 'TRUNCATE TABLE edom_diagram_es');
	$sql_edop=mysqli_query($plm_edom, "SELECT * from v_edom_diagram_es_final");

	while($r_edop=mysqli_fetch_array($sql_edop)){
		$sql = mysqli_query($plm_edom, "insert into edom_diagram_es (keterangan,jumlah,total,persen,ta,per,utsuas) values ('$r_edop[keterangan]','$r_edop[jumlah]','$r_edop[total]','$r_edop[persen]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]')");	
		$a=$a+1;
		if(!$sql){
			$gagal++;
			// $status .= "Update EDOM ES<b style='color:red'>error</b>";
		}else{
			$berhasil++;
			// $status .= "Update <b>EDOM ES</b> <b style='color:green'>Sukses</b><br>";

		}

	}

	if($berhasil > $gagal++){
		$status .= "Update <b>EDOM ES</b> <b style='color:green'>Sukses</b><br>";
	}else{
		$status .= "Update <b>EDOM ES</b> <b style='color:red'>Gagal</b><br>";
	}
}else{
		$status .= "Data <b>EDOM ES</b> belum ada<br>";
	}



// ------ update EPOM DATA

$qry=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter"));
$jpar=$qry['vjpar'];

//echo " truncate & insert....<br>";
mysqli_query($plm_edom, "TRUNCATE TABLE epomtemp03");

mysqli_query($plm_edom, "INSERT INTO epomtemp03 (idprogstudi, aspek) 
(select idprogstudi, aspek from epomdata group by idprogstudi, aspek)") ;

//echo " update nama prodi & nama jurusan ...<br>";
$sqlx = mysqli_query($plm, "SELECT kodeprodi, namaprodi, jurprodi FROM m_prodi GROUP BY kodeprodi");
while ( $rx = mysqli_fetch_array($sqlx)) {
	mysqli_query($plm_edom, "UPDATE epomtemp03 SET namaprodi='".$rx['namaprodi']."', jurprodi='".$rx['jurprodi']."' WHERE idprogstudi = '".$rx['kodeprodi']."'");
}


//echo " update jumlah point & jumlah mhs ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t1 join (select idprogstudi, aspek, sum(v1) as jSC , count(id) as jSis from epomdata group by idprogstudi, aspek) t2 
on t1.idprogstudi = t2.idprogstudi and t1.aspek=t2.aspek set t1.jumlah=t2.jSC, t1.jmlmhs=t2.jSis");

//echo " update score aspek ...<br>";
mysqli_query($plm_edom, "update epomtemp03 set scoreas=jumlah/jmlmhs");

//echo " update score prodi ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t11 join (select idprogstudi, avg(scoreas) as jtot from epomtemp03 group by idprogstudi) t12 
on t11.idprogstudi = t12.idprogstudi set t11.scorep=t12.jtot") ;

//echo " update score jurusan ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t21 join (select jurprodi, avg(scorep) as jtotp from epomtemp03 group by jurprodi) t22 
on t21.jurprodi = t22.jurprodi set t21.scorej=t22.jtotp") ;

include "tepomoverall.php";
include "tnilaiepom.php";
$a=0;
$berhasil = 0;
$gagal = 0;
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epom_es");
$row = mysqli_num_rows($sql_edop);
if ($row > 0) {

mysqli_query($plm_edom, "DELETE FROM epomdata_es where ta = '".$_SESSION['pertan']."'");
mysqli_query($plm_edom, "ALTER TABLE epomdata_es AUTO_INCREMENT = 1");
$sql_edops=mysqli_query($plm_edom, "SELECT * from v_epom_es");

while($r_edop=mysqli_fetch_array($sql_edops)){
	$sql = mysqli_query($plm_edom, "insert into epomdata_es (ta,per,utsuas,idprogstudi,namaprodi,jurprodi,A,B,C,D,total) values ('$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]','$r_edop[idprogstudi]','$r_edop[namaprodi]','$r_edop[jurprodi]','$r_edop[A]','$r_edop[B]','$r_edop[C]','$r_edop[D]','$r_edop[total]')");	
	$a=$a+1;
	if(!$sql){
		$gagal++;
		// $status .= "Update EPOM DATA <b style='color:red'> error di ".$r_edop['idprogstudi']."</b><br>";
	}else{
		$berhasil++;
		// $status .= "Update <b>EPOM DATA</b> <b style='color:green'>Sukses</b><br>";

	}
}

if($berhasil > $gagal++){
	$status .= "Update <b>EPOM DATA</b> <b style='color:green'>Sukses</b><br>";
}else{
	$status .= "Update <b>EPOM DATA</b> <b style='color:red'>Gagal</b><br>";
}

}else{
	$status .= "Data <b>EPOM DATA</b> belum ada<br>";
}

// ------ update EPOM ES

$a=0;
$berhasil = 0;
$gagal = 0;
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epom_diagram_es_final where ta = '".$_SESSION['pertan']."'");
$row = mysqli_num_rows($sql_edop);
if ($row > 0) {
	mysqli_query($plm_edom, "DELETE FROM epom_diagram_es where ta = '".$_SESSION['pertan']."'");
	mysqli_query($plm_edom, "ALTER TABLE epom_diagram_es AUTO_INCREMENT = 1");

	$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epom_diagram_es_final");

	while($r_edop=mysqli_fetch_array($sql_edop)){

		$sql = mysqli_query($plm_edom, "insert into epom_diagram_es (keterangan,jumlah,total,persen,ta,per,utsuas) values ('$r_edop[keterangan]','$r_edop[jumlah]','$r_edop[total]','$r_edop[persen]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]')");	
		$a=$a+1;
		if(!$sql){
			$gagal++;
			// $status .= "Update EPOM ES<b style='color:red'>error</b>";
		}else{
			$berhasil++;
			// $status .= "Update <b>EPOM ES</b> <b style='color:green'>Sukses</b><br>";
		}

	}

	if($berhasil > $gagal++){
		$status .= "Update <b>EPOM ES</b> <b style='color:green'>Sukses</b><br>";
	}else{
		$status .= "Update <b>EPOM ES</b> <b style='color:red'>Gagal</b><br>";
	}

}else{
	$status .= "Data <b>EPOM ES</b> belum ada<br>";
}

// ------ update EDOP DATA

include "tedopoverall.php";
include "tnilaiedop.php";
include "tedoppresentasi.php";
$a=0;
$berhasil = 0;
$gagal = 0;

$sql_edop=mysqli_query($plm_edom, "SELECT * from v_edop_es ");
$row = mysqli_num_rows($sql_edop);
if ($row > 0) {

mysqli_query($plm_edom, "DELETE FROM edopdata_es where ta = '".$_SESSION['pertan']."'");
mysqli_query($plm_edom, "ALTER TABLE edopdata_es AUTO_INCREMENT = 1");

$sql_edops=mysqli_query($plm_edom, "SELECT * from v_edop_es");

while($r_edop=mysqli_fetch_array($sql_edops)){

		$sql = mysqli_query($plm_edom, "insert into edopdata_es (kedop,kodedosen,namadosen,kodemk,idprogstudi,ta,per,utsuas,A,B,C,total) values ('$r_edop[kedop]','$r_edop[kodedosen]','$r_edop[namadosen]','$r_edop[kodemk]','$r_edop[idprogstudi]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]','$r_edop[A]','$r_edop[B]','$r_edop[C]','$r_edop[total]')");	
		$a=$a+1;
		if(!$sql){
			$gagal++;
			// $status .= "Update EDOP DATA <b style='color:red'>error di ".$r_edop['kodedosen']." - ".$r_edop['kelas']." - ".$r_edop['kodemk']."</b><br>";
		}else{
			$berhasil++;
			// $status .= "Update <b>EDOP DATA</b> <b style='color:green'>Sukses</b><br>";

		}
	}

	if($berhasil > $gagal++){
		$status .= "Update <b>EPOD DATA</b> <b style='color:green'>Sukses</b><br>";
	}else{
		$status .= "Update <b>EPOD DATA</b> <b style='color:red'>Gagal</b><br>";
	}

}else{
	$status .= "Data <b>EDOP DATA</b> belum ada<br>";
}


// ------ update EDOP ES

$a=0;
$berhasil = 0;
$gagal = 0;
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_edop_diagram_es_final where ta = '".$_SESSION['pertan']."'");
$row = mysqli_num_rows($sql_edop);
if ($row > 0) {
	mysqli_query($plm_edom, "DELETE FROM edop_diagram_es where ta = '".$_SESSION['pertan']."'");
	mysqli_query($plm_edom, "ALTER TABLE edop_diagram_es AUTO_INCREMENT = 1");

	$sql_edop=mysqli_query($plm_edom, "SELECT * from v_edop_diagram_es_final");

	while($r_edop=mysqli_fetch_array($sql_edop)){

		$sql = mysqli_query($plm_edom, "insert into edop_diagram_es (keterangan,jumlah,total,persen,ta,per,utsuas) values ('$r_edop[keterangan]','$r_edop[jumlah]','$r_edop[total]','$r_edop[persen]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]')");	
		$a=$a+1;
		if(!$sql){
			$gagal++;
			// $status .= "Update EDOP ES<b style='color:red'>error</b>";

		}else{	
			$berhasil++;	
			// $status .= "Update <b>EDOP ES</b> <b style='color:green'>Sukses</b><br>";
		}

	}
	if($berhasil > $gagal++){
		$status .= "Update <b>EDOP ES</b> <b style='color:green'>Sukses</b><br>";
	}else{
		$status .= "Update <b>EDOP ES</b> <b style='color:red'>Gagal</b><br>";
	}
}else{
	$status .= "Data <b>EDOP ES</b> belum ada<br>";
}
// ------ update EPOD DATA

include "tepodoverall.php";
include "tnilaiepod.php";
$a=0;
$berhasil = 0;
$gagal = 0;
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epod_es");
$row = mysqli_num_rows($sql_edop);
if ($row > 0) {

	mysqli_query($plm_edom, "DELETE FROM epoddata_es where ta = '".$_SESSION['pertan']."'");
	mysqli_query($plm_edom, "ALTER TABLE epoddata_es AUTO_INCREMENT = 1");

	$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epod_es");

	while($r_edop=mysqli_fetch_array($sql_edop)){
		$sql = mysqli_query($plm_edom, "insert into epoddata_es (idprogstudi,namaprodi,jurprodi,ta,per,utsuas,A,B,C,total) values ('$r_edop[idprogstudi]','$r_edop[namaprodi]','$r_edop[jurprodi]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]','$r_edop[A]','$r_edop[B]','$r_edop[C]','$r_edop[total]')");	
		$a=$a+1;
		if(!$sql){
			$gagal++;
			// $status .= "Update EPOD DATA <b style='color:red'>error di ".$r_edop['idprogstudi']."</b><br>";
		}else{
			$berhasil++;	
			// $status .= "Update <b>EPOD DATA</b> <b style='color:green'>Sukses</b><br>";
		}
	}

	if($berhasil > $gagal++){
		$status .= "Update <b>EPOD DATA</b> <b style='color:green'>Sukses</b><br>";
	}else{
		$status .= "Update <b>EPOD DATA</b> <b style='color:red'>Gagal</b><br>";
	}

}else{
	$status .= "Data <b>EPOD DATA</b> belum ada<br>";
}

// ------ update EPOD ES

$a=0;
$berhasil = 0;
$gagal = 0;
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epod_diagram_es_final where ta = '".$_SESSION['pertan']."'");
$row = mysqli_num_rows($sql_edop);
if ($row > 0) {
		mysqli_query($plm_edom, "DELETE FROM epod_diagram_es where ta = '".$_SESSION['pertan']."'");
		mysqli_query($plm_edom, "ALTER TABLE epod_diagram_es AUTO_INCREMENT = 1");
	$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epod_diagram_es_final");

	while($r_edop=mysqli_fetch_array($sql_edop)){
		$sql = mysqli_query($plm_edom, "insert into epod_diagram_es (keterangan,jumlah,total,persen,ta,per,utsuas) values ('$r_edop[keterangan]','$r_edop[jumlah]','$r_edop[total]','$r_edop[persen]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]')");	
		$a=$a+1;
		if(!$sql){
			$gagal++;
			// $status .= "Update EPOD ES<b style='color:red'>error</b>";
		}else{
			$berhasil++;	
			// $status .= "Update <b>EPOD ES</b> <b style='color:green'>Sukses</b><br>";
		}

	}

	if($berhasil > $gagal++){
		$status .= "Update <b>EPOD ES</b> <b style='color:green'>Sukses</b><br>";
	}else{
		$status .= "Update <b>EPOD ES</b> <b style='color:red'>Gagal</b><br>";
	}
}else{
	$status .= "Data <b>EPOD ES</b> belum ada<br>";
}


echo $status;	
	
		
?>
<script src="../../assets/jquery-3.1.1.min.js"></script>
<script>
 $(document).ready(function(){
		$('.loading').css({'visibility':'hidden','display':'none'});
 	});
</script>