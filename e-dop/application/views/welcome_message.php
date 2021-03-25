<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>e-DOP</title>
	<?php echo $assets; ?>
	
	<style type="text/css">
	
	html {
		
		margin: 0;
		padding: 0;
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
		
		/*margin-top: 20px;*/
		text-align: right;
		/*background-color: red;*/
		width: 200px;
		margin: 60px auto;
	}
	
	form#formlogin input {
		
		border: none;		
		font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
		font-size: 1em;
		margin	: 5px;
		padding	: 10px;
	}

	form#formlogin button {
		
		border		: none;
		font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
		font-size	: 1em;
		font-weight	: bold;
		margin		: 5px;
		padding		: 10px;
		
	}
	
	form#formlogin button:hover {
		
		cursor: pointer;
	}
		
	.error {
		
		font-size: 1em;
		margin-bottom: 5px;		
		padding: 5px;
	}

	.error span {
		
		font-weight: bold;
	}
	
	ul.kotak {
		
		list-style-type: none;
		margin: 100px auto;
		padding: 0;		
		width: 560px;
	}
	
	
	ul.kotak li {
		
		float: left;
		font-weight: lighter;
		font-size: 2em;
		height: 250px;
		margin			: 5px;
		padding			: 10px;
		text-align: center;
		vertical-align: middle;
		width: 250px;
	}
		
	ul.kotak li img.logo {
		
		height		: 100px;
		margin-top: 20px;
		width		: 100px;
	}
	
	ul.kotak li div.judul {
		
		font-size	: 1em;
		font-weight: bold;
	} 
	
	ul.kotak li div.judul small {
		
		border-bottom	: 1px solid #ecf0f1;
		display 		: block;
		font-size		: 1em;
		font-weight		: normal;
	}

	ul.kotak li div.judul span {
		
		display 		: block;
		font-size	: 1em;
		margin-top: 10px;
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
	
	.orange {
		
		color: #ecf0f1;
		background-color: #f39c12;
	}
	
	@media screen and (max-width : 839px) {
		
		ul.kotak {
			
			width: 560px;
			margin: 50px auto;
		}
	}
	
	@media screen and (max-width : 559px) {
		
		ul.kotak {
			
			width: 280px;
			margin: 20px auto;
		}
	}
	

	</style>
	
	
</head>
<body >
	
	<ul class="kotak">
		<li class="clouds">
			<form id="formlogin" action="satpam/ceking" method="post" >
				<input style="background:none;border:none;color: white" type="text" id="nameopt" name="nameopt" value="<?php echo $nameuser ; ?>" placeholder="IDPRODI"/>
				<!-- <button type="submit" id="submitlogin" name="submitlogin" >LOGIN</button> -->
			</form>
		</li>
	</ul>



</body>
</html>
<script type="text/javascript">
		$(document).ready(function(){
			$("#formlogin").submit();
		})
	
		$("#formlogin").ajaxForm({
				dataType	: 'json',
				success 	: goprodi 
			});
		
		function goprodi(data) {
			
				$('.error').remove();
				if (data.error) {
					
					$('#formlogin').prepend(data.error);
					$('.error').hide();
					$('.error').addClass('alizarin');
					$('.error').fadeIn('slow');
				}else{
					window.location.href='main_menu/option/'+data.satu+'/'+data.edoc;
				}
			}
			
	</script>