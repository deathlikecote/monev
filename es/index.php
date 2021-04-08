<?php include "include/header.php"; ?>
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->

<style type="text/css">
${demo.css}
body{

}
li{
font-size:100%;
}
</style>

<script type="text/javascript">
function tampilkan(){
    //var perta = $('#pertan').val();
    $(".loader").fadeOut("slow");
    $('#konten').load("grafik.php");
}

function tampilkan2(){
    var perta = $('#perta').val();

    if($('#juduls').text() == "GRAFIK"){
        $.post("grafik.php",{perta:perta},function (data){
            $(".loader").fadeOut("slow");
            $('#konten').slideDown().html(data);
        })    
    }else if($('#juduls').text() == "EVALUASI DOSEN OLEH MAHASISWA"){
        $.post("edom.php",{perta:perta},function (data){
            $(".loader").fadeOut("slow");
            $('#konten').slideDown().html(data);
        })    
    }else if($('#juduls').text() == "EVALUASI DOSEN OLEH PRODI"){
        $.post("edop.php",{perta:perta},function (data){
            $(".loader").fadeOut("slow");
            $('#konten').slideDown().html(data);
        })    
    }else if($('#juduls').text() == "EVALUASI PRODI OLEH MAHASISWA"){
        $.post("epom.php",{perta:perta},function (data){
            $(".loader").fadeOut("slow");
            $('#konten').slideDown().html(data);
        })    
    }else if($('#juduls').text() == "EVALUASI PRODI OLEH DOSEN"){
        $.post("epod.php",{perta:perta},function (data){
            $(".loader").fadeOut("slow");
            $('#konten').slideDown().html(data);
        })    
    }

    
}

$(document).ready(function(){
    tampilkan();
	$(".loader").fadeOut("slow");
    $("#juduls").html("");
    $("#juduls").append("GRAFIK");

    $(".home").click(function(){
        window.location = "./";
    });


    
    $(".edom").click(function(){
    $(".loader").fadeIn("slow");
    $("#juduls").html("");
    $("#juduls").append("EVALUASI DOSEN OLEH MAHASISWA");
    	$("#konten").slideUp().hide(function(){
     		$("#konten").load("edom.php",function(){
     			$(".loader").fadeOut("slow");
     			$("#konten").slideDown();
     		})
    	});     
    });
    
    $(".edop").click(function(){
    $(".loader").fadeIn("slow");
    $("#juduls").html("");
    $("#juduls").append("EVALUASI DOSEN OLEH PRODI");
    	$("#konten").slideUp().hide(function(){
     		$("#konten").load("edop.php",function(){
     			$(".loader").fadeOut("slow");
     			$("#konten").slideDown();
     		})
    	});     
    });
    
    $(".epom").click(function(){
    $(".loader").fadeIn("slow");
    $("#juduls").html("");
    $("#juduls").append("EVALUASI PRODI OLEH MAHASISWA");
    	$("#konten").slideUp().hide(function(){
     		$("#konten").load("epom.php",function(){
     			$(".loader").fadeOut("slow");
     			$("#konten").slideDown();
     		})
    	});     
    });
    
    $(".epod").click(function(){
    $(".loader").fadeIn("slow");
    $("#juduls").html("");
    $("#juduls").append("EVALUASI PRODI OLEH DOSEN");
    	$("#konten").slideUp().hide(function(){
     		$("#konten").load("epod.php",function(){
     			$(".loader").fadeOut("slow");
     			$("#konten").slideDown();
     		})
    	});     
    });

   
});


  function filteredom(){
  	 $(".loader").fadeIn("slow");
  	var filter=$(".filter option:selected").val();
    var perta = $('#perta').val();
	$('#data').slideUp();
	$.post("process/function.php",{filter:filter, perta:perta},function (data){
	$(".loader").fadeOut("slow");
	$('#data').slideDown().html(data);
	
	});			

	}
	function cariedom(){
	$(".loader").fadeIn("slow");
	var cari=$(".cari").val();
    var perta = $('#perta').val();
	$('#data').slideUp();
	$.post("process/function.php",{cari:cari, perta:perta},function (data){
	$(".loader").fadeOut("slow");
	$('#data').slideDown().html(data);
	});			

	}
	
	 function filteredop(){
  	 $(".loader").fadeIn("slow");
  	var filteredop=$(".filteredop option:selected").val();
    var perta = $('#perta').val();
	$('#data').slideUp();
	$.post("process/function.php",{filteredop:filteredop, perta:perta},function (data){
	$(".loader").fadeOut("slow");
	$('#data').slideDown().html(data);
	
	});			

	}
	function cariedop(){
	$(".loader").fadeIn("slow");
	var cariedop=$(".cariedop").val();
    var perta = $('#perta').val();
	$('#data').slideUp(function(){
		$.post("process/function.php",{cariedop:cariedop, perta:perta},function (data){
			$(".loader").fadeOut("slow");
			$('#data').slideDown().html(data);
		});			
	});
	}
	
	 function filterepom(){
  	 $(".loader").fadeIn("slow");
  	var filterepom=$(".filterepom option:selected").val();
    var perta = $('#perta').val();
	$('#data').slideUp(function(){
		$.post("process/function.php",{filterepom:filterepom, perta:perta},function (data){
			$(".loader").fadeOut("slow");
			$('#data').slideDown().html(data);
		});
	});			

	}
	
	 function filterepod(){
  	 $(".loader").fadeIn("slow");
  	var filterepod=$(".filterepod option:selected").val();
    var perta = $('#perta').val();
	$('#data').slideUp(function(){
		$.post("process/function.php",{filterepod:filterepod, perta:perta},function (data){
			$(".loader").fadeOut("slow");
			$('#data').slideDown().html(data);
		});
	});			

	}
		</script>
<?php include "../assets/clock.js"; ?>

<div class="container">
<div class="row">
  <br>
         <div class="col-md-6 " style="color: white;font-size: 14pt;height: 80px">
          <img src="../persiapan/images/logo.png" width="50" height="" style="float: left;margin-right: 10px">
           <h3 style="margin-top: 10px;color: #5E5E5F;text-shadow:2px 2px 3px grey;font-weight: 300;letter-spacing: 2px;color:#071C43;float: left; ">
            POLTEKPAR PALEMBANG
           </h3>
         </div>
         <div class="col-md-6 " style="color: black;font-size: 14pt;height: 80px;">
          <div class="clock" >
            <div id="Date" style="text-align: right;"></div>
            <ul class="clock" style="text-align: right;">
              <li id="hours"></li>
              <li id="point">:</li>
              <li id="min"></li>
              <li id="point">:</li>
              <li id="sec"></li>
            </ul>
          </div>
        </div>
    </div>

    <div class="row">
         <div class="col-md-12 " style="background-color: #337AB7;height: 40px;color: white;line-height: 40px;font-size: 14pt">
           MONITORING EVALUASI
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
        <li><a class="home" href="#GRAFIK" >GRAFIK</a></li> 
        <li><a class="edom" href="#EDOM" >EDOM</a></li> 
        <li><a class="edop" href="#EDOP" >EDOP</a></li> 
        <li><a class="epom" href="#EPOM" >EPOM</a></li> 
        <li><a class="epod" href="#EPOD" >EPOD</a></li> 
      </ul>
      
    </div><!-- /.navbar-collapse -->
</nav>
    </div>

    <div class="row">
        <div class="col-md-12 " style="border: 1px solid #E7E7E7;background-color: white">
            <div class="row">
                <div class="col-md-12 " id="juduls" style="background-color:#54B2F9;height:25px;line-height: 25px;color:white">
                </div>
            </div>
            <br>
            <script src="https://code.highcharts.com/highcharts.js"></script>
             <script src="https://code.highcharts.com/modules/exporting.js"></script> 
            <div class="row" ><div class="loader">Menunggu..</div>
            <div class="col-md-12" >
                <div class="col-md-12" >
            <select class="form-control" name="perta" id="perta" class="perta" required style="width:3.2cm;float:left;margin:0 10px 10px 0 ;">
              <?php
                $result = mysqli_query($plm_edom, "SELECT table_name, engine FROM information_schema.tables WHERE table_name like 'edomdata%' AND table_type = 'BASE TABLE' AND table_schema='plm_edom'  ORDER BY table_name DESC ");
                while($r = mysqli_fetch_array($result)){
                    if(is_numeric(substr($r[0],-5))){
                        echo"<option value='".substr($r[0],-5)."'>".substr($r[0],-5)."</option>";
                    }
                    
                }
              ?>
            </select>
            <input class="btn btn-primary" type="submit" value="Tampilkan"  name="caridpmk" onclick="tampilkan2()" style="margin-bottom:0px;">
        </div>
        </div>
            <div class="col-md-12" id="konten">
             
             
         
         </div>
         <div class="" id="konten2"></div>
     </div>  


 </div>
</div>





	
	

<?php include "include/footer.php" ?>