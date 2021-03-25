<?php
// 	definisi nama database dan tabel 
include("dbspmconn.php");

//---3
echo " hitung scoreas....<br>";
//mysql_query("update edomtemp01 t12 inner join (select kode, aspek, avg(scorepar) as vscoreas from edomtemp01 group by kode, aspek) t22 on t12.aspek = t22.aspek set t12.scoreas = t22.vscoreas")  or die("error as:".mysql_error());
// dari lain tabel
$qry=mysql_query("select kode, aspek, avg(scorepar) as vscoreas from edomtemp01 group by kode, aspek")  or die("error as:".mysql_error());
$jml=mysql_num_rows($qry);
//echo $jml."<br>";
$no=1;
while ($gb=mysql_fetch_array($qry)) {
    $no=$no+1;
    $skode=$gb['kode'];
    $saspek=$gb['aspek'];
    $sscoreaspek=$gb['vscoreas'];
//    echo $sscoreaspek."<br>";
    mysql_query("update edomtemp01 set scoreas='$sscoreaspek' where kode='$skode' and aspek='$saspek'");    
//    if ($no == 1000) {
//       break;
//    }
}


?>
