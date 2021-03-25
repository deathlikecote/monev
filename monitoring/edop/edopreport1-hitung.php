<?php
// 	definisi nama database dan tabel 
include("dbspmconn.php");

// update 'kode' di epompotensi(kode=idprogstudi,kelas)
//-ok mysql_query("UPDATE epoddata t1 join (select id, idprogstudi from exoxpotensi) t2 on t1.id_potensi=t2.id SET t1.idprogstudi=t2.idprogstudi") or die("error:".mysql_error());

//----

$xkode='acpBIDMPI';

mysql_query("TRUNCATE TABLE edoptemp01");

//-- ambil id dari exox
$qryid=mysql_fetch_assoc(mysql_query("select id as vid from exoxpotensi where kedop='$xkode'")) or die("select id from exox : ".mysql_error());
$xid=$qryid['vid'];

echo $xid."<br>";

$xjnspar=2;
$qhitpar=mysql_fetch_assoc(mysql_query("select count(parameter) as vjpar from edopparameter where jenis='$xjnspar' and deleted=0")) or die("select id from exox : ".mysql_error());
$xjpar=$qhitpar['vjpar'];

echo $xjpar."<br>";


//--- insert total nilai (sum) berd. parameter dari epoddata
mysql_query("INSERT INTO edoptemp01 (id_parameter, parameter, aspek, jenis, jumlah) 
(select id_parameter, parameter, aspek, jenis, sum(v1) as jumlah from edopdata where id_potensi='$xid' group by id_parameter)") or die("error insert:".mysql_error());

// scorepar
mysql_query("update edoptemp01 set scorepar=jumlah");

// scoreas
mysql_query("update edoptemp01 t1 inner join (select id_parameter, aspek, jenis, round(avg(jumlah),2) as vas from edoptemp01 where jenis='$xjnspar' group by aspek) as t2 
on t1.id_parameter=t2.id_parameter set t1.scoreas = t2.vas") or die("error scoreas2:".mysql_error());

// scoreas
mysql_query("update edoptemp01 t11 inner join (select id_parameter, aspek, jenis, round(sum(scoreas)/3,2) as vdos from edoptemp01 where jenis='$xjnspar') as t21 
on t11.id_parameter=t21.id_parameter set t11.scoredos = t21.vdos") or die("error scoreas21:".mysql_error());

//mysql_query("update epoddata t1 join (select id, idprogstudi from exoxpotensi) t2 
//on t1.id_potensi = t2.id set t1.idprogstudi=t2.idprogstudi") or die("update epoddata : ".mysql_error());




?>
