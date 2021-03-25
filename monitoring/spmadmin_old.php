<?php
include('header.php');
?>

<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script> -->
   
</head>
<body>
<div id='cssmenu'>
<ul>
<!--	<li><img src="images/logocolor.jpg" height="50" width="50" alt="PPM STPB"></li> -->
  

</ul>
</div>
<div id='cssmenu'>

<ul>
   <li class='active'><a href='./../main.php'>Home</a></li>
    <li class='has-sub'><a href='#'>ES</a>
      <ul>
           <li><a href='update/edom_data.php' target='content'>EDOM data</a></li>
           <li><a href='update/edop_data.php' target='content'>EDOP data</a></li>
           <li><a href='update/epom_data.php' target='content'>EPOM data</a></li>
           <li><a href='update/epod_data.php' target='content'>EPOD data</a></li>
         <li><a href='update/edom_es.php' target='content'>EDOM diagram </a></li>
          <li><a href='update/edop_es.php' target='content'>EDOP diagram </a></li>
           <li><a href='update/epom_es.php' target='content'>EPOM diagram </a></li>
            <li><a href='update/epod_es.php' target='content'>EPOD diagram </a></li>
        </ul>
   <li class='has-sub'><a href='#'>ePOD</a>
      <ul>
         <!-- <li><a href='epod/epod-init.php' target='content'>Update Data </a> -->
         <li ><a href='spm/epodbrowsepotensi.php' target='content'>List Potensi </a>
          <!--   <ul>
               <li><a href='spm/epodbrowsepotensi.php' target='content'>List Potensi</a></li>
               <li><a href='belum.html' target='content'>Rekap Potensi</a></li>
            </ul> -->
         </li>
         <li class='has-sub'><a href='#'>Report</a>
            <ul>
               <li><a href='epod/epodreport1.php' target='content'>R.01 - Prodi</a></li>
               <li><a href='epod/epodreport2-pdf.php' target='content'>R.02 - Jurusan</a></li>
               <li><a href='spm/epodbrowsenilai.php' target='content'>List Nilai</a></li>
               <li><a href='spm/epodrekapnilai.php' target='content'>Rekapitulasi</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'>eDOP</a>
      <ul>
         <!-- <li><a href='edop/edop-init.php' target='content'>Update Data </a> -->
         <li ><a target='content' href='spm/edopbrowsepotensi.php'>List Potensi </a>
            <!-- <ul>
               <li><a href='spm/edopbrowsepotensi.php' target='content'>List Potensi</a></li>
               <li><a href='belum.html' target='content'>Rekap Potensi</a></li>
            </ul> -->
         </li>
         <li class='has-sub'><a href='#'>Report</a>
            <ul>
               <li><a href='edop/edopreport1.php' target='content'>R.01 - DosenMkProdi</a></li>
               <li><a href='edop/edopreport2.php' target='content'>R.02 - Dosen Prodi</a></li>
               <li><a href='edop/edopreport3-pdf.php' target='content'>R.03 - RekapProdi</a></li>
                <li><a href='edop/edopreport4.php' target='content'>R.04 - DosenProdi</a></li>
               <li><a href='spm/edoprekapnilai.php' target='content'>Rekapitulasi</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'>eDOM</a>
      <ul>
         <li class='has-sub'><a href='edom/edomreport2-hitung.php'>Update Data</a>
            <ul>
           <!--  <li><a href='update/updateedom.php' target='content'>Update Edomdata</a></li> -->
               <li><a href='edom/edom-distinct.php' target='content'>List Dosen-distinct</a></li>
              <!--  <li><a href='edom/edomreport2-hitung.php' target='content'>Persiapan R.02 (4")</a></li> -->
               <!-- <li><a href='edom/edomreport3-hitung.php' target='content'>Persiapan R.03 (1")</a></li> -->
               <!-- <li><a href='edom/edomreport4-hitung.php' target='content'>Persiapan R.04 (2")</a></li> -->
               <!-- <li><a href='edom/edomreport5-hitung.php' target='content'>Persiapan R.05 (2")</a></li> -->
                <li><a href='update/pmuser.php' target='content'>Update User PM</a></li>
            </ul>
         </li>

         <li class='has-sub'><a href='#'>Potensi </a>
            <ul>
               <li><a href='spm/edombrowsepotensi.php' target='content'>List Potensi</a></li>
               <li><a href='edom/edomrekapitulasi.php' target='content'>Rekap Potensi</a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'>Report</a>
            <ul>
               <li><a href='edom/edomreport1.php' target='content'>R.01 - DPMK</a></li>
               <li><a href='edom/edomreport2.php' target='content'>R.02 - KP</a></li>
               <li><a href='edom/edomreport3-pdf.php' target='content'>R.03 - Prodi</a></li>
               <li><a href='edom/edomreport4-pdf.php' target='content'>R.04 - Prodi kelas</a></li>
               <li><a href='edom/edomreport5-pdf.php' target='content'>R.05 - Rek. Dosen</a></li>
            </ul>
         </li>
      </ul>
   </li>

   <li class='has-sub'><a href='#'>ePOM</a>
      <ul>
         <!-- <li class='has-sub'><a href='edom/tes.php'>Update Data 10"</a>
            <ul>
            <li><a href='update/updateepom.php' target='content'>Update Epomdata</a></li>
               <li><a href='#' target='content'>Persiapan ePOM (10")</a></li>
               <li><a href='epom/epomreport3-hitung.php' target='_blank'>Update ePOM (3")</a></li>
            </ul>
         </li> -->
      
         <li class='has-sub'><a href='#'>Potensi </a>
            <ul>
               <li><a href='spm/epombrowsepotensi.php' target='content'>List Potensi</a></li>
               <li><a href='epom/epomrekapitulasi.php' target='content'>Rekap Potensi</a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'>Report</a>
            <ul>
               <li><a href='epom/epomreport1.php' target='content'>R.01 Kelas-Par</a></li>
               <li><a href='epom/epomreport2.php' target='content'>R.02 Prodi-Par</a></li>
               <li><a href='epom/epomreport3-pdf.php' target='content'>R.03 Jurusan</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <!-- <li><a href='index.php'>Logout</a></li> -->
</ul>
</div>

<div id="blank"><iframe name="blank" src="start.html" frameborder=0 height=70 width=500></iframe></div>
<div id="content"><iframe name="content" src="start.html" frameborder=0 height=500 width=500></iframe></div>

</body>
<html>