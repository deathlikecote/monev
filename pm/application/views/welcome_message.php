
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PORTAL MAHASISWA</title>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    	<link rel="icon" href="../favicon.ico" type="image/x-icon">
	<?php echo $assets; ?>
	<script src=""></script>


	<style type="text/css">

	
	html {
		
	}
	
	body {
		
		font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
		
		font-size: 12px;	

	}
	


	form {
		
		margin: 0;
		padding: 0;
	}
	
	form#formlogin {
		
	}
	
	form#formlogin input {
			
		font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
	
	}

	form#formlogin button {
		
		font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
		
	}
	
	form#formlogin button:hover {
		
		cursor: pointer;
	}
	
	
	.error{
		
		font-size: 1em;
		padding: 5px;
		margin-right: 5px;
	}

	.error span{
		
		font-weight: bold;
	}
	
	
	
	.wetasphalt {
		
		color: #ecf0f1;
		background-color: #34495e;
	}
	
	.midnightblue {
		
		color: #ecf0f1;
		background-color: #2c3e50;
	}
	
	.concrete {
		
		color: #ecf0f1;
		background-color: #95a5a6;
	}
	
	.asbestos {
		
		color: #ecf0f1;
		 /*background: rgba(38, 55, 65, 1);*/
background: #2d444f; /* Old browsers */
background: -moz-linear-gradient(-140deg, #2d444f 0%,#2d444f 50%,#273841 51%,#273841 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(-140deg, #2d444f 0%,#2d444f 50%,#273841 51%,#273841 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(-140deg, #2d444f 0%,#2d444f 50%,#273841 51%,#273841 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	}
	
	.amethyst {
		
		color: #ecf0f1;
		background-color: #9b59b6;
	}
	
	.westeria {
		
		color: #ecf0f1;
		background-color: #8e44ad;
	}
	
	
	
	.silver {
		
		color: #ecf0f1;
		background-color: #bdc3c7;
	}
	
	.peterriver {
		
		color: #ecf0f1;
		background-color: #3498db;
	}
	
	.belizehole {
		
		color: #ecf0f1;
		background: rgba(25, 105, 156, 1);;
	}
	.yellow{
		color: #ecf0f1;
	  	background: rgba(241, 151, 38, 1);
	}

	.orange{
		color: #ecf0f1;
  		background: rgba(221, 106, 29, 1);
	}

	.green{
		color: #ecf0f1;
  		background: rgba(107, 142, 35, 1);
	}
	
	.darkgrey{
	  background: rgba(38, 55, 65, 1);
	}
	.alizarin {
		
		color: #ecf0f1;
		 /*background: rgba(38, 55, 65, 1);*/
background: #2d444f; /* Old browsers */
background: -moz-linear-gradient(-140deg, #2d444f 0%,#2d444f 50%,#273841 51%,#273841 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(-140deg, #2d444f 0%,#2d444f 50%,#273841 51%,#273841 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(-140deg, #2d444f 0%,#2d444f 50%,#273841 51%,#273841 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	}
	
	.pomegranate {
		
		color: #ecf0f1;
		background-color: #c0392b;
	}
	
	.emerald {
		
		color: #ecf0f1;
		background-color: #2ecc71;
	}
	
	.nephritis {
		
		color: #ecf0f1;
		background-color: #27ae60;
	}
	
	.carrot {
		
		color: #ecf0f1;
		background-color: #e67e22;
	}
	
	.pumpkin {
		
		color: #ecf0f1;
		background-color: #d35400;
	}
	
	.torquoise {
		
		color: #ecf0f1;
		background-color: #1abc9c;
	}
	
	.greensea {
		
		color: #ecf0f1;
		background-color: #16a085;
	}
	
	.sunflower {
		
		color: #ecf0f1;
		background-color: #f1c40f;
	}
	
	#adec{
		text-decoration: none;
		color: white;
	}

	#li2item{
		float: none;height: auto;width: 97%;padding: 0; 
	}

	#iconmenu{
		float: left;width: 30%;height: 100%;margin-right: 10px;background:rgba(255,255,255,0.1);
		padding: 5px 0 5px 0;
	}

	#judulmenu{
		font-size: 23px;letter-spacing: 1px;text-align:left;line-height: 15px;
		padding:22px 0 0px 0  
	}

	#imgmenu{
		width: 80%;padding:3px 0 0px 0;  
	}

	#framebanner{
		width: 79.2%;margin-top: 6px;margin-left: 6px;
	}

	#framemenu{
		float: right;width: 20%;margin-right: 3px; 
	}

	#spansubjudul{
		font-size: 7pt;display: block;
	}

	.pp{
		border-radius:3px;background-color: white;
		height: 36px;margin-top: 2px;
	}
	
	#juduluser{
		text-align:right;color:white;letter-spacing:1px;
	}

	#spanjuduluser{
		display: block;font-size: 7pt;margin-top: -2px
	}

	#judulnav{

	}

	.navbar-brand{

	}

	.logbrand{
		width:32px;margin-top: -5px;cursor: pointer;
	}

	#liabsen{
			width:97%;
			float: none;
		}

	@media screen and (max-width : 1280px) {
		
		ul.kotak {
			
			width: 560px;
			margin: 50px auto;
		}

		#judulmenu{
			font-size: 24px;letter-spacing: 1px;text-align:left;line-height: 15px;
			padding:28px 0 0px 0  
		}

		#spansubjudul{
			font-size: 7pt;display: block;
		}

		#framebanner{
			width: 78.6%;margin-top: 6px;margin-left: 6px;
		}

		

		#liabsen div{
			font-size: 29pt;
		}

		#liabsen div span{
			font-size: 10pt;letter-spacing: 1px
		}

		.pp{
			width:36px;border-radius:0px;background-color: white;
			height: auto;margin-top: 0px;
		}

		#juduluser{
			text-align:left;color:white;letter-spacing:1px;font-size: 10pt;line-height: 15px;
			margin:10px 0 0 100px;

		}

		#spanjuduluser{
			display: block;font-size: 7pt;margin-top: -2px
		}
	}

	@media screen and (max-width : 1024px) {
		

		#formlogin{
			position: absolute;width: 100%;top:54vh;left: 0
		}

		#usernim{
			width: 100%;height: 140px;font-size: 40pt;
			display: inline-block;
		}

		#pass{
			width: 100%;height: 140px;font-size: 40pt;
			display: inline-block;
		}

		#mit{
			width: 100%;height: 140px;font-size: 40pt;
			display: inline-block;
		}

		#lupapass{
			color: white;
			font-size: 35pt;
			width: 100%;
			display: block;
			background-color: #292B2C;
		}

		#infoprof{
			font-size: 40pt;
		}

		#kontenprof{
			font-size: 35pt;
		}
		#klosprof2{
			font-size: 35pt;
		}
		#klos2 h6{
			font-size: 35pt;
		}

		#profil div, h6{
			font-size: 23pt;
		}

		#profil #ubahfoto {
			width: 86%;
			top: 186px;

		}

		.pprof {
			width: 100%;
			height: 232px;
		}
		.error{
		
			font-size: 30pt;
			margin:0;
		}

		.pp{
			width:45%;
			height: 500px;
			border-radius:0px;background-color: white;
			position: absolute;
			top:329px;
			left: 6px;
		}

		#juduluser{
			text-align:center;
			color:white;
			letter-spacing:1px;
			font-size: 25pt;
			line-height: 35px;
			position: absolute;
			top:710px;
			left: -94px;
			z-index: 99;
			width:45%;
			background:rgba(0,0,0,0.5);
			padding: 5px 0 5px 0;
		}

		#spanjuduluser{
			display: block;font-size: 25pt;
		}

		.logbrand{
			width:150px;cursor: pointer;margin:0 auto;
		}

		#batas{
			display: none;
		}

		.navbar-brand{
			text-align: center;
			width: 100%;
		}

		#judulnav{
			display: block;
			font-size: 50pt;
		}

		#judulprotal{
			display: block;
			font-size: 35pt;
			letter-spacing: 2px;
			margin-top: -15px;
		}

		

		ul.kotak {
			
			width: 280px;
			margin: 20px auto;
		}

		#framemenu{
			float: none;width: 100%;margin-right: 0px; 
		}

		#framebanner{
			width: 100%;margin-top: 6px;margin-left: 0px;
		}

		
		#liabsen{
			height: 500px;
			width: 99%;
		}

		#li2item{
			float: none;height: auto;width: 99%;padding: 0; 
		}

		#liabsen div{
			font-size: 7em;
			margin:0 0 0 50%;
			text-align: left;
		}

		#liabsen div span{
			font-size: 0.34em;letter-spacing: 1px;
			width: 100%
		}

		#imgmenu{
			width: 60%;padding:3px 0 0px 0;  
		}

		#judulmenu{
			font-size: 70pt;letter-spacing: 1px;text-align:left;line-height: 55px;
			padding:50px 0 0px 0  
		}

		#spansubjudul{
			margin-top: 10px;
			font-size: 35pt;display: block;
		}
	}
	
	@media screen and (max-width : 740px) {
		.pp{
			width:20%;border-radius:0px;background-color: white;
			height: auto;margin-top: -57px;
		}

		#juduluser{
			text-align:left;color:white;letter-spacing:1px;font-size: 15pt;line-height: 23px;
			margin:10px 0 0 100px;

		}

		#spanjuduluser{
			display: block;font-size: 12pt;margin-top: -2px
		}

		.logbrand{
			width:60px;cursor: pointer;margin:0 auto;
		}

		#imgmenu{
			width: 60%;padding:3px 0 0px 0;  
		}

		#batas{
			display: none;
		}

		.navbar-brand{
			text-align: center;
			width: 100%;
		}

		#judulprotal{
			display: block;
			font-size: 17pt;
			letter-spacing: 2px;
			margin-top: -10px;
		}

		#judulnav{
			display: block;
			font-size: 25pt;
		}

		ul.kotak {
			
			width: 280px;
			margin: 20px auto;
		}

		#framemenu{
			float: none;width: 100%;margin-right: 0px; 
		}

		#framebanner{
			width: 100%;margin-top: 6px;margin-left: 0px;
		}

		#spansubjudul{
			font-size: 12pt;display: block;
		}

		#liabsen div{
			font-size: 35pt;
		}

		#judulmenu{
			font-size: 29.5px;letter-spacing: 1px;text-align:left;line-height: 23px;
			padding:30px 0 0px 0  
		}
	}

	.banner{
		height: auto;width:100%;
	}	
	
	

	
	
		#mailinputs{
		visibility: hidden;
		display: none;
		
	}

	#mailinputs, #passulang, #passbaru{
		width:70%;
		padding:0px 2px;
	}
	#mailteks{
		color:white;
		width:80%;
		padding:0px 7px;
		border:none;
		background: none;
		font-weight: 100;
	}
	#simpanmail, #simpanpass{
		visibility: hidden;
		display: none;
	}
	#ubahpass{
		visibility: hidden;
		display: none;
	}
	#formlupapass{
		visibility: hidden;
		display: none;
		position:absolute;
		left:50%;
		top:20%;
		z-index: 99;
	}
	#klosprof2,#klosprof, .logbrand, .inputfile{
		cursor: pointer;
	}
	#loading{
		visibility: hidden;
		display: none;
		position: absolute;
		z-index: 100;
		background-color: grey;
		width: 100%;
		text-align: center;
		left: 0;
		height: 100%;
		line-height: 140px;
		background: rgba(41, 43, 44,0.9);
	}
	</style>
	
	<script type="text/javascript">
		function tampilpass(){
			$('#formlupapass').css({'visibility':'visible','display':'inline'});
		}

		function ubahpass(){
			$('#biodata').css({'visibility':'hidden','display':'none'});
			$('#ubahpass').css({'visibility':'visible','display':'inline'});
			$('#menudefault').css({'visibility':'hidden','display':'none'});
			$('#simpanpass').css({'visibility':'visible','display':'inline'});
		}

		function kirimpassx(){
				$('#loading').css({'visibility':'visible','display':'inline'});
				var email=$('#kirimpass').val();
				if(email==""){
					alert('Silahkan isi nim anda terlebih dahulu');
					$('#kirimpass').focus();
				}else{
					 $.post("satpam/kirimpassx", {email: email}, function(result){
							$('#klos2').html(result);
							$('#loading').css({'visibility':'hidden','display':'none'});
							$('#formlupapass').css({'visibility':'hidden','display':'none'});
	    			});
				}
		}

		function maildisimpan(){
			var mail=$('#mailinputs').val();
			var nim=$('#nims').val();
			if(mail==""){
				alert('Silahkan isi email anda');
				$('#mailinputs').focus();
			}else{
				 $.post("../../../main_menu/ubahmail", {mail: mail, nim: nim}, function(result){
						$('.mailteks').val(result);
						$('#idprofil').load('welcome_message #mailteks');
        				$('#menudefault').css({'visibility':'visible','display':'inline'});
						$('#simpanmail').css({'visibility':'hidden','display':'none'});
						$('#mailteks').css({'visibility':'visible','display':'inline'});
						$('#mailinputs').css({'visibility':'hidden','display':'none'});
    			});
			}
		}

		function passdisimpan(){
			var passbaru=$('#passbaru').val();
			var passulang=$('#passulang').val();
			var nim=$('#nims').val();
			if(passbaru==""){
				alert('Silahkan isi password');
				$('#passbaru').focus();
			}else if(passulang==""){
				alert('Silahkan isi konfirmasi password');
				$('#passulang').focus();
			}else if(passbaru!=passulang){
				alert('Password tidak sama');
				$('#passulang').focus();
			}else{
				 $.post("../../../main_menu/ubahpass", {passbaru: passbaru, nim: nim}, function(result){
						alert ('Password berhasil diubah. Silahkan login kembali');
						window.location.replace("<?php echo base_url();?>satpam/logout");
    			});
			}
		}

		function editmail(){
			$('#mailteks').css({'visibility':'hidden','display':'none'});
			$('#menudefault').css({'visibility':'hidden','display':'none'});
			$('#simpanmail').css({'visibility':'visible','display':'inline'});
			$('#mailinputs').css({'visibility':'visible','display':'inline'});
		}
		function menushow(){
			$('#menudefault').css({'visibility':'visible','display':'inline'});
			$('#simpanmail').css({'visibility':'hidden','display':'none'});
			$('#simpanpass').css({'visibility':'hidden','display':'none'});
			$('#mailteks').css({'visibility':'visible','display':'inline'});
			$('#mailinputs').css({'visibility':'hidden','display':'none'});
			$('#ubahpass').css({'visibility':'hidden','display':'none'});
			$('#biodata').css({'visibility':'visible','display':'inline'});

		}


	function validasi() {
			
				return true;
			}

			$(document).ready(function(){
				$("#mit").click(function(){
					$("#formlogin").ajaxForm({
			
						beforeSubmit: validasi,
						dataType	: 'json',
						success 	: goprodi 
					})

				})
				

				$(".pp").click(function(){
					// $("#submenu").css('visibility','visible');
					$("#profil").css('visibility','visible');
  					$("#profil").css('display','inline');

				})
  		$('.pp').click(function(e) { //button click class name is myDiv
  			e.stopPropagation();
  		})

  		$(function(){
  			$(document).click(function(){  
  				$('#submenu').css('visibility','hidden');

  			});
  		});


  		$("#infox").click(function(){
  			$("#notif").remove();
  		})

  		setTimeout(function(){
  			$("#pengumuman").css('visibility','hidden');
  		},500);

  		$("#profmenu").click(function(){
  			$("#profil").css('visibility','visible');
  			$("#profil").css('display','inline');
  		})

  		$("#klos").click(function(){
  			$("#pengumuman").hide();
  		})
  		$("#klosprof").click(function(){
  			$("#profil").css('visibility','hidden');
  			$("#profil").css('display','none');
  			$('#menudefault').css({'visibility':'visible','display':'inline'});
			$('#simpanmail').css({'visibility':'hidden','display':'none'});
			$('#simpanpass').css({'visibility':'hidden','display':'none'});
			$('#mailteks').css({'visibility':'visible','display':'inline'});
			$('#mailinputs').css({'visibility':'hidden','display':'none'});
			$('#ubahpass').css({'visibility':'hidden','display':'none'});
			$('#biodata').css({'visibility':'visible','display':'inline'});
  		})
  		$("#klosprof2").click(function(){
  			$("#formlupapass").css('visibility','hidden');
  			$("#formlupapass").css('display','none');
  		})
  	});
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 800
      });

      // Slideshow 2
      $("#slider2").responsiveSlides({
        auto: false,
        pager: true,
        speed: 300,
        maxwidth: 540
      });

      // Slideshow 3
      $("#slider3").responsiveSlides({
        manualControls: '#slider3-pager',
        maxwidth: 540
      });

      // Slideshow 4
      $("#slider4").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });

    });

	function kliksubmit(){
		var property = document.getElementById("image_file").files[0];
		var image_name = property.name;
		var image_extension = image_name.split(".").pop().toLowerCase();
		if(jQuery.inArray(image_extension, ['png','jpg','jpeg']) == -1){
			alert("Ivalid Image File");
		}
		var image_size = property.size;
		if(image_size > 1000000){
			alert('Ukuran gambar terlalu besar. Max 1mb');
		}else{
			$('#upload').trigger('click');
		}
	}	
	
	function goprodi(data) {
			
				$('.error').remove();
				if (data.error) {
					
					$('#formlogin').prepend(data.error);
					$('.error').hide();
					$('.error').addClass('alizarin');
					$('.error').fadeIn('slow');
				}else{
//					alert(data.edoc);
					window.location.href='main_menu/nim2/'+data.satu+'/'+data.edoc;
				}
			}
	</script>
</head>

<body class="clouds" style="background-color: white">


<div class="container-fluid">
<div class="row">

<nav class="col navbar navbar-toggleable-md navbar-inverse">
  
	<form class="form-inline my-2 my-lg-0"  name="login" id="formlogin" action="satpam/ceking" method="post">
		<input name="nameopt" id="usernim" value="<?=$nim?>" type="hidden" placeholder="NIM" style="background: none;border:none;color:white" required>
		<input name="to" id="to" value="<?=$to?>" type="hidden" style="background: none;border:none;color:white" required>
		<button id="mit" name="submitlogin" type="submit" style="background: none;border:none;"></button>
	</form> 	
	<script>
		$(document).ready(function(){
			$('form[name="login"]').submit();
		})
	</script>

</nav>

</div>
</div>

</body>
</html>


