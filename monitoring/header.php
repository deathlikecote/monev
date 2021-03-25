<?php
include "../include/koneksi.php";
include "../include/MyFunction.php";
/*if($_SESSION['hak_akses']!=''){
  if($_SESSION['hak_akses']!="Admin" && $_SESSION['hak_akses']!="Operator"){
    header("Location: ../");
  }
  
}else{
  header("Location: ../");
}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" contentx="IE=edge">
    <meta name="viewport" contentx="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head contentx must come *after* these tags -->
    <title>MONITORING</title>
    
    <!-- CSS -->
    <script src="../assets/mystyle/js/jquery-3.2.1.min.js"></script>
    <!-- ======================== -->

    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  
   
  </head>
  <script type="text/javascript">
    function gantijudul (judul){
      var judul = judul;
      $('#judul').html('');
       $('<p>'+judul+'</p>').appendTo('#judul');
    }

    function generateEdom(){
         $('.loading').css({'visibility':'visible','display':'inline'});
         //$('.persen').css({'visibility':'visible','display':'inline'});
          var generateEdom = 'a';
          $.post("../process/cek.php", {generateEdom:generateEdom}, function(data){
          $(".jav").html(data);
           //if($('.persen').html()=='100%'){
            $('.loading').css({'visibility':'hidden','display':'none'});
            $('.persen').css({'visibility':'hidden','display':'none'});
          // }
        });
    }

    function generateAllEs(judul){
         $('.loading').css({'visibility':'visible','display':'inline'});
          var judul = judul;
        $('#judul').html('');
         $('<p>'+judul+'</p>').appendTo('#judul');
    }
  </script>

  
  <style type="text/css">
  body{
    background-color: #E4E7E8;
  }
    .fileContainer {
    overflow: hidden;
    position: relative;
    font-weight: 400;
    font-size: 11pt;
}

.fileContainer [type=file] {
    cursor: inherit;
    display: block;
    filter: alpha(opacity=0);
    min-height: 100%;
    min-width: 100%;
    opacity: 0;
    position: absolute;
    right: 0;
    text-align: right;
    top: 0;
}

/* Example styDaftaric flourishes */

.fileContainer {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
    border-radius: .3em;
    float: left;
    padding: .5em;
}

.fileContainer:hover {
  color: #fff;
  background-color: #449d44;
  border-color: #398439;
}

.fileContainer [type=file] {
    cursor: pointer;
}

.loading{
  width:100%;
  background:rgba(51,51,51, 0.7);
  position: absolute;
  z-index: 9999;
  left: 0;
  height: 100vh;
  text-align: center;
  line-height: 100vh;
  display:none;
  visibility: hidden;
}
.persen{
  position: absolute;top: 53%;left:48.5%;z-index: 999;color: white;
  display:none;
  visibility: hidden;
}
}
  </style>
  <body>
    
<div class="jav"></div>
  <div class="container-fluid" >
    <div class="loading" style="">
      <img src="../assets/img/Blocks.gif" style="width: 100px;height:100px;" />
      <h3 class="persen" style="">0 %</h3>
    </div>

    <div class="row">
         <div class="col-md-12 " style="background-color: #111111;height: 40px;color: white;line-height: 40px;font-size: 14pt">
           Monitoring
         </div>
    </div>
    <div class="row">
<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../main.php">Menu</a>
    </div>

    <!-- Collect the nav links, forms, and other contentx for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">eDOM<span class="caret"></span></a>
          <ul class="dropdown-menu">
              <!-- <li class="dropdown-header">UPDATE DATA</li>   
                    <li><a href='edom/edom-distinct.php'  onclick="gantijudul('UPDATE DOSEN')" target='contentx'>&nbsp;&nbsp;Update Dosen-distinct</a>
              </li> -->
              
              <li class="dropdown-header">POTENSI</li>   
                     <li><a href='spm/edombrowsepotensi.php' onclick="gantijudul('Daftar Potensi EDOM')" target='contentx'>&nbsp;&nbsp;Daftar Potensi</a></li>
                     <li><a href='edom/edomrekapitulasi.php' onclick="gantijudul('Rekap Potensi EDOM')" target='contentx'>&nbsp;&nbsp;Rekap Potensi</a></li>
               

               <li class="dropdown-header">REPORT</li>   
                     <li><a href='edom/edomreport1.php' onclick="gantijudul('EDOM Report 01 / Dosen-Kelas')" target='contentx'>&nbsp;&nbsp;R.01 - DPMK</a></li>
                     <li><a href='edom/edomreport2.php' onclick="gantijudul('EDOM Report 02 / Kelas')" target='contentx'>&nbsp;&nbsp;R.02 - KP</a></li>
                     <li><a href='edom/edomreport3-pdf.php'  target='contentx'>&nbsp;&nbsp;R.03 - Prodi</a></li>
                     <li><a href='edom/edomreport4-pdf.php' target='contentx'>&nbsp;&nbsp;R.04 - Prodi kelas</a></li>
                     <li><a href='edom/edomreport5-pdf.php' target='contentx'>&nbsp;&nbsp;R.05 - Rek. Dosen</a></li>
           </ul>
        </li> 

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ePOM<span class="caret"></span></a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
               <li class="dropdown-header">POTENSI</li>   
               <li><a href='spm/epombrowsepotensi.php' target='contentx' onclick="gantijudul('Daftar Potensi EPOM')">&nbsp;&nbsp;Daftar Potensi</a></li>
               <li><a href='epom/epomrekapitulasi.php' target='contentx' onclick="gantijudul('Rekap Potensi EPOM')">&nbsp;&nbsp;Rekap Potensi</a></li>
               <li class="dropdown-header">REPORT</li>   
               <li><a href='epom/epomreport1.php' onclick="gantijudul('EPOM Report 01 / Kelas')" target='contentx'>&nbsp;&nbsp;R.01 Kelas</a></li>
               <li><a href='epom/epomreport2.php' onclick="gantijudul('EPOM Report 02 / Prodi')" target='contentx'>&nbsp;&nbsp;R.02 Prodi</a></li>
               <li><a href='epom/epomreport3-pdf.php'  target='contentx'>&nbsp;&nbsp;R.03 Jurusan</a></li>
           </ul>
        </li>
         

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ePOD<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">POTENSI</li>   
            <li ><a href='spm/epodbrowsepotensi.php' onclick="gantijudul('Daftar Potensi EPOD')" target='contentx'>&nbsp;&nbsp;Daftar Potensi </a></li>
           <li class="dropdown-header">REPORT</li>   
                 <li><a href='epod/epodreport1.php' onclick="gantijudul('EPOD Report 01 / Prodi')" target='contentx'>&nbsp;&nbsp;R.01 - Prodi</a></li>
                 <li><a href='epod/epodreport2-pdf.php' target='contentx'>&nbsp;&nbsp;R.02 - Prodi</a></li>
                 <li><a href='spm/epodbrowsenilai.php' onclick="gantijudul('EPOD Daftar Nilai')" target='contentx'>&nbsp;&nbsp;Daftar Nilai</a></li>
                 <li><a href='spm/epodrekapnilai.php' onclick="gantijudul('EPOD Rekapitulasi')" target='contentx'>&nbsp;&nbsp;Rekapitulasi</a></li>
              
          </ul>
        </li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">eDOP<span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li class="dropdown-header">POTENSI</li>   
              <li ><a target='contentx' onclick="gantijudul('Daftar Potensi EDOP')" href='spm/edopbrowsepotensi.php'>&nbsp;&nbsp;Daftar Potensi </a></li>
              <li class="dropdown-header">REPORT</li>   
                   <li><a href='edop/edopreport1.php' onclick="gantijudul('EDOP Report 01 / Dosen-MK-Prodi')" target='contentx'>&nbsp;&nbsp;R.01 - DosenMkProdi</a></li>
                   <li><a href='edop/edopreport2.php' onclick="gantijudul('EDOP Report 02 / Dosen-Prodi')" target='contentx'>&nbsp;&nbsp;R.02 - Dosen Prodi</a></li>
                   <li><a href='edop/edopreport3-pdf.php' target='contentx'>&nbsp;&nbsp;R.03 - RekapProdi</a></li>
                    <li><a href='edop/edopreport4.php' onclick="gantijudul('EDOP Report 04 / Dosen-Prodi')" target='contentx'>&nbsp;&nbsp;R.04 - DosenProdi</a></li>
                   <li><a href='spm/edoprekapnilai.php' onclick="gantijudul('EDOP Rekapitulasi')" target='contentx'>&nbsp;&nbsp;Rekapitulasi</a></li>
           </ul>
        </li> 

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Generate ES & Backup<span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href='update/generateall.php' onclick="generateAllEs('EDOM Data')" target='contentx'>Generate All Es</a></li>
              <li><a href='update/backuptable.php' onclick="gantijudul('Backup Table')" target='contentx'>Backup Table </a></li>
           </ul>
        </li> 

      </ul>
      
    </div><!-- /.navbar-collapse -->
</nav>
    </div>