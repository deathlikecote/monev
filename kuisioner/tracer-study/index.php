
			<?php
			session_start();
			include "../../config/koneksi.php";
			$cek=mysqli_fetch_assoc(mysqli_query($Open,"SELECT * FROM tb_projek WHERE nama='Tracer Study'"));
			if(date('Y-m-d') >= $cek['tgl_terbit'] && date('Y-m-d') < $cek['tgl_tutup']){
				if(!isset($_SESSION["id_user_kuis"])){
				    header("Location: login.php");
				}
				
				if(isset($_GET['pageNum'])){
					$_SESSION['pageMe'] = $_GET['pageNum'];
				}else{
					$_SESSION['pageMe'] = 1;
					$_SESSION['pageOld'] = 1;
				}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Tracer Study</title>
				<meta charset="utf-8" />
				<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
				<link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon" />	

				<link href="../../assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
				<link href="../../assets/plugins/bootstrap-441/css/bootstrap.min.css" rel="stylesheet" />
				<link href="../../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
				<link href="../../assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
				<link href="../../assets/css/animate.min.css" rel="stylesheet" />
				<link href="../../assets/css/style.min.css" rel="stylesheet" />
				<link href="../../assets/css/style-responsive.min.css" rel="stylesheet" />
				<link href="../../assets/css/theme/default.css" rel="stylesheet" id="theme" />
				<link href="../../assets/mystyle/css/survey.css" rel="stylesheet" />

				<script src="../../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
				<script src="../../assets/plugins/pace/pace.min.js"></script>

			</head>
			<body>
				<div class="container mt-md-5 bg-light">
					<div class="col-12 py-5 px-3">
						<input type="hidden" name="projek" value="Tracer Study">
					<?php 
							
							$pageArr = array('');
							$rPageArr=mysqli_query($Open,"SELECT * FROM tb_tracer_study_page");
							while($pArr=mysqli_fetch_array($rPageArr)){
								$pageArr[] = $pArr['id_page'];
							}
							$arrlength = count($pageArr);
							if($_SESSION['pageOld'] < $_SESSION['pageMe']){
								for($x = $_SESSION['pageMe']; $x < $arrlength; $x++) {
								  $numCek=mysqli_query($Open,"SELECT * FROM tb_tracer_study_page WHERE id_page='".$pageArr[$x]."'");
								  $rNum = mysqli_fetch_assoc($numCek);

								  $cekFilter=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page_detail='".$rNum['variable']."' AND id_user='".$_SESSION['id_user_kuis']."'");
								  $rf = mysqli_fetch_assoc($cekFilter);

								  if($rNum['value'] == $rf['valuex']){ 
								  	$_SESSION['pageMe'] = $x;
								  	$pageFilter = $pageArr[$x];
								  	break;
								  }

								} 

							}else{
								for($x = $_SESSION['pageMe']; $x > 0; $x--) {
								  $numCek=mysqli_query($Open,"SELECT * FROM tb_tracer_study_page WHERE id_page='".$pageArr[$x]."'");
								  $rNum = mysqli_fetch_assoc($numCek);

								  $cekFilter=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page_detail='".$rNum['variable']."' AND id_user='".$_SESSION['id_user_kuis']."'");
								  $rf = mysqli_fetch_assoc($cekFilter);

								  if($rNum['value'] == $rf['valuex']){ 
								  	$_SESSION['pageMe'] = $x;
								  	$pageFilter = $pageArr[$x];
								  	break;
								  }

								}
							}


						$_SESSION['pageOld'] = $_SESSION['pageMe'];
						$rPage=mysqli_fetch_assoc(mysqli_query($Open,"SELECT * FROM tb_tracer_study_page WHERE id_page='".$pageFilter."'"));

						$pageDetail=mysqli_query($Open,"SELECT * FROM tb_tracer_study_page_detail WHERE id_page='".$rPage['id_page']."' ORDER BY id_urut ASC");
						while($r = mysqli_fetch_array($pageDetail)){
					?>
					<!-- tampil hl -->
					<?php if($r['jenis'] == 'hl'){ ?>
					<header class="mb-3">
						<h4><?=$r['id_soal']?>. <?=$r['label']?></h4><hr>
					</header>	
					<?php } ?> <!-- eof $r['jenis'] == 'hl' -->

					<!-- tampil sh -->
					<?php if($r['jenis'] == 'sh'){ ?>
					<div class="mb-3">
						<h5><?=$r['id_soal']?>. <?=$r['label']?></h5><hr>
					</div>	
					<?php } ?> <!-- eof $r['jenis'] == 'sh' -->

					<!-- tampil cv -->
					<?php if($r['jenis'] == 'cv'){ ?>
					<?php 
					$qCekCv=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page='".$rPage['id']."' AND id_page_detail='".$r['id']."' AND id_user='".$_SESSION['id_user_kuis']."'");
						$rCv = mysqli_fetch_assoc($qCekCv);

						$cekFilter=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page_detail='".$r['variable']."' AND id_user='".$_SESSION['id_user_kuis']."'");
						$rf = mysqli_fetch_assoc($cekFilter);
					 ?>
					  <div class="form-group form-row mb-4 <?php echo ($r['value'] == $rf['valuex'])?"":"collapse"; ?>" id="<?=$r['id']?>">
					  <div class="col-md-1 col-2 text-center"><div class="bg-info"><?=$r['id_soal']?></div></div>
					  <div class="col-md-11 col-10" id = "<?=$rCv['id']?>">
					  	<?php 
				  			$filterCv=mysqli_query($Open,"SELECT * FROM tb_tracer_study_page_detail WHERE variable='".$r['id']."' ORDER BY id ASC");
							while($fCv = mysqli_fetch_array($filterCv)){
								echo "<input type='hidden' class='fCv".$r['id']."' name='".$fCv['id']."' value='".$fCv['value']."'>";
							}
				  		 ?>
					  	<div class="mb-2"><?=$r['label']?></div>
					  		<?php 
					  			$qCv=mysqli_query($Open,"SELECT * FROM tb_tracer_study_cv WHERE id_page_detail='".$r['id']."' ORDER BY id ASC");
								while($row = mysqli_fetch_array($qCv)){

					  		 ?>
					  		 
					  		<?php if($row['lainnya'] == '1'){ ?>
					  			<div class="mt-1 row">
									<div class="col-md-auto col-1">
										<input type="radio" name="radioCv<?=$r['id']?>" idpage = "<?=$rPage['id']?>" class="valCv" value="<?=$row['id']?>" lainnya="1" <?php echo ($rCv['valuex'] == $row['id'])?"checked":""; ?>>
									</div>
									<div class="col-auto"><?=$row['con_jwb']?></div>
									<div class="col-md-5 offset-1 offset-md-0">
										<input type="text" name="isianCv<?=$r['id']?>" class="form-control mt-xs-2 isianCv" valuex = "<?=$row['id']?>" value="<?=$rCv['lainnya']?>" placeholder="Kolom isian" <?php echo ($rCv['valuex'] == $row['id'])?"":"disabled"; ?>>
									</div>
								</div>
							<?php }else{ ?>
								<div class="mt-1 row">
									<div class="col-md-auto col-1">
										<input type="radio" name="radioCv<?=$r['id']?>" idpage = "<?=$rPage['id']?>"  class="valCv" value="<?=$row['id']?>" <?php echo ($rCv['valuex'] == $row['id'])?"checked":""; ?>>
									</div>
									<div class="col-11"><?=$row['con_jwb']?></div>
								</div>
							<?php } ?>
							<?php } ?>
					  	</div>
						</div>
					<?php } ?> <!-- eof $r['jenis'] == 'cv' -->


					<!-- tampil tn -->
					<?php if($r['jenis'] == 'tn'){ ?>
					  <?php 
						$qCekTn=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page='".$rPage['id']."' AND id_page_detail='".$r['id']."' AND id_user='".$_SESSION['id_user_kuis']."'");
						$rTn = mysqli_fetch_assoc($qCekTn);

						$cekFilter=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page_detail='".$r['variable']."' AND id_user='".$_SESSION['id_user_kuis']."'");
						$rf = mysqli_fetch_assoc($cekFilter);
					 ?>

					  <div class="form-group form-row mb-4 <?php echo ($r['value'] == $rf['valuex'])?"":"collapse"; ?>" id="<?=$r['id']?>">
					  <div class="col-md-1 col-2 text-center"><div class="bg-info"><?=$r['id_soal']?></div></div>
					  <div class="col-md-11 col-10 row" id="<?=$rTn['id']?>">
					  	<div class="col-auto">
					  		<?=$r['label']?>
					  	</div>
					  	<div class="col-md-3 col-10">
					  		<input type="text" name="<?=$r['id']?>" idpage = "<?=$rPage['id']?>" value="<?=$rTn['valuex']?>" class="form-control isianTn" placeholder="Kolom isian">
					  	</div>
					  	<div class="col-auto">
					  		<?=$r['behind']?>
					  	</div>
					   </div>
					   </div>
					<?php } ?> <!-- eof $r['jenis'] == 'tn' -->

					<!-- tampil tl -->
					<?php if($r['jenis'] == 'tl'){ ?>
					<?php 
						$qCekTl=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page='".$rPage['id']."' AND id_page_detail='".$r['id']."' AND id_user='".$_SESSION['id_user_kuis']."'");
						$rTl = mysqli_fetch_assoc($qCekTl);

						$cekFilter=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page_detail='".$r['variable']."' AND id_user='".$_SESSION['id_user_kuis']."'");
						$rf = mysqli_fetch_assoc($cekFilter);
					 ?>
					  <div class="form-group form-row mb-4 
<?php echo ($r['value'] == $rf['valuex'])?"":"collapse"; ?>" id="<?=$r['id']?>" >
					  <div class="col-md-1 col-2 text-center"><div class="bg-info"><?=$r['id_soal']?></div></div>
					   <div class="col-md-11 col-10" id="<?=$rTl['id']?>">
						  	<div class="mb-2"><?=$r['label']?></div>
						  	<div class="col-12 col-md-7 pl-0">
					  			<textarea type="text" name="<?=$r['id']?>" idpage = "<?=$rPage['id']?>" class="form-control isianTl" placeholder="Kolom isian"><?=$rTl['valuex']?></textarea>
					  		</div>
					   </div>
					   
					   </div>
					<?php } ?> <!-- eof $r['jenis'] == 'tl' -->

					<!-- tampil md -->
					<?php if($r['jenis'] == 'md'){ ?>
					<?php 
						$cekFilter=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page_detail='".$r['variable']."' AND id_user='".$_SESSION['id_user_kuis']."'");
						$rf = mysqli_fetch_assoc($cekFilter);
					 ?>
					  <div class="form-group form-row mb-4 <?php echo ($r['value'] == $rf['valuex'])?"":"collapse"; ?>" id="<?=$r['id']?>">
					  <div class="col-md-1 col-2 text-center"><div class="bg-info"><?=$r['id_soal']?></div></div>
					  <div class="col-md-11 col-10" >
					  	<div class="mb-2"><?=$r['label']?></div>

					  		<?php 
					  			$qMd=mysqli_query($Open,"SELECT * FROM tb_tracer_study_md WHERE id_page_detail='".$r['id']."' ORDER BY id ASC");
								while($rowMd = mysqli_fetch_array($qMd)){
									$qCekMd=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page='".$rPage['id']."' AND id_page_detail='".$r['id']."' AND id_jwb='".$rowMd['id']."' AND id_user='".$_SESSION['id_user_kuis']."'");
									$rMd = mysqli_fetch_assoc($qCekMd);
					  		 ?>
					  		  
					  		<?php if($rowMd['lainnya'] == '1'){ ?>
					  			<div class="mt-1 row" id="<?=$rMd['id']?>">
									<div class="col-md-auto col-1">
										<input type="checkbox" idPage="<?=$rPage['id']?>" class="valMd" lainnya="1" value="<?=$rowMd['id']?>" <?php echo ($rMd['valuex'] == $rowMd['id'])?"checked":""; ?>>
									</div>
									<div class="col-auto"><?=$rowMd['con_jwb']?></div>
									<div class="col-md-5 offset-1 offset-md-0">
										<input type="text" name="isianMd<?=$rowMd['id']?>" value="<?=$rMd['lainnya']?>" class="form-control mt-xs-2 isianMd" placeholder="Kolom isian" <?php echo ($rMd['id_jwb'] == $rowMd['id'])?"":"disabled"; ?>>
									</div>
								</div>
							<?php }else{ ?>
								<div class="mt-1 col-12 pl-0 row" id="<?=$rMd['id']?>">
									<div class="col-md-auto col-1">
										<input type="checkbox" idPage="<?=$rPage['id']?>" class="valMd" value="<?=$rowMd['id']?>" <?php echo ($rMd['valuex'] == $rowMd['id'])?"checked":""; ?>>
									</div>
									<div class="col-11"><?=$rowMd['con_jwb']?></div>
								</div>
							<?php } ?>
							<?php } ?>
					  	</div>
						</div>
					<?php } ?> <!-- eof $r['jenis'] == 'md' -->

					<!-- tampil or -->
					<?php if($r['jenis'] == 'or'){ ?>
					<?php 
						$cekFilter=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page_detail='".$r['variable']."' AND id_user='".$_SESSION['id_user_kuis']."'");
						$rf = mysqli_fetch_assoc($cekFilter);

					 ?>
					  <div class="form-group form-row mb-4 <?php echo ($r['value'] == $rf['valuex'])?"":"collapse"; ?>" id="<?=$r['id']?>" >
					  <div class="col-md-1 col-2 text-center"><div class="bg-info"><?=$r['id_soal']?></div></div>
					  <div class="col-md-11 col-10" id="<?=$rPage['id']?>">
					  	<div class="mb-2"><?=$r['label']?></div>

					  		<?php 
					  			$range = '';
					  			$conJwb = '';
					  			$offsetCol = 0;

					  			$qRange=mysqli_query($Open,"SELECT * FROM tb_tracer_study_range WHERE id_page_detail='".$r['id']."' ORDER BY id ASC");
								while($rowRange = mysqli_fetch_array($qRange)){

									if($offsetCol == 0){
										$setCol = 'offset-md-2';
									}else{
										$setCol = '';
									}

									$conJwb .= "
									<div class='col-2 col-md-1 ".$setCol." text-center'>
									<small>".$rowRange['con_jwb']."</small>
									</div>";

									$range .= "
									<div class='col-2 col-md-1 ".$setCol." text-center'>
									".$rowRange['val_jwb']."
									</div>";
									$offsetCol++;
								}
							 ?>	
							 <div class="row">
							 	<?=$conJwb?>
							 </div>
							 <div class="row">
							 	<?=$range?>
							 </div>
							 <?php
					  			$qOr=mysqli_query($Open,"SELECT * FROM tb_tracer_study_or WHERE id_page_detail='".$r['id']."' ORDER BY id ASC");
								while($rowOr = mysqli_fetch_array($qOr)){

								$qCekOr=mysqli_query($Open,"SELECT * FROM tb_tracer_study_answer WHERE id_page='".$rPage['id']."' AND id_page_detail='".$r['id']."' AND id_jwb='".$rowOr['id']."' AND id_user='".$_SESSION['id_user_kuis']."'");
								$rOr = mysqli_fetch_assoc($qCekOr);

					  			$grpRadio = '';
								$qRange=mysqli_query($Open,"SELECT * FROM tb_tracer_study_range WHERE id_page_detail='".$r['id']."' ORDER BY id ASC");
								while($rowRange = mysqli_fetch_array($qRange)){
									if($rowOr['lainnya'] == '1'){
										$grpRadio .= "
										<div class='col-2 col-md-1 text-center'>
										<input type='radio' lainnya='1' class='valOr' name='".$rowOr['id']."' value='".$rowRange['id']."' ".(($rOr['valuex']==$rowRange['id'])?'checked':'').">
										</div>";
									}else{
										$grpRadio .= "
										<div class='col-2 col-md-1 text-center'>
										<input type='radio' class='valOr' name='".$rowOr['id']."' value='".$rowRange['id']."' ".(($rOr['valuex']==$rowRange['id'])?'checked':'').">
										</div>";
									}
								}
					  		 ?>
					  		  	

					  		<?php if($rowOr['lainnya'] == '1'){ ?>
					  			<div class="row" id="<?=$rOr['id']?>" varor="<?=$rowOr['id']?>">
							 	<div class="col-12 col-md-2 text-left">
							 		<?=$rowOr['con_jwb']?>
							 		<input type="text" name="isianOr<?=$rowOr['id']?>" value="<?=$rOr['lainnya']?>" class="form-control mt-xs-2 isianOr" placeholder="Kolom isian" <?php echo ($rOr['id_jwb'] == $rowOr['id'])?"":"disabled"; ?>>
							 	</div>
							 	<?=$grpRadio?> 
							 	
							  </div>
					  			
							<?php }else{ ?>
							  <div class="row" id="<?=$rOr['id']?>" varor="<?=$rowOr['id']?>">
							 	<div class="col-12 col-md-2 text-left">
							 		<?=$rowOr['con_jwb']?>
							 	</div>
							 	<?=$grpRadio?> 
							  </div>
							<?php } ?>
							<?php } ?>
					  	</div>
						</div>
					<?php } ?> <!-- eof $r['jenis'] == 'or' -->

					<?php } ?> <!-- eof while($r = mysqli_fetch_array($pageDetail) -->

					<div class="col-12 text-center my-5">
						<?php 
						/*$pageDetail=mysqli_query($Open,"SELECT * FROM tb_tracer_study_page WHERE id_page='".$rPage['id_page']."' ORDER BY id_urut ASC");
						while($r = mysqli_fetch_array($pageDetail)){

						}*/
							$qNm=mysqli_query($Open,"SELECT * FROM tb_tracer_study_page");
								$rowNm = mysqli_num_rows($qNm);
						if($_SESSION['pageMe'] != 1){
						?>	
						<form method="get" class="d-inline">
						 <input type="hidden" name="pageNum" value="<?=($_SESSION['pageMe']-1)?>">
						 <button class="btn btn-info btn-sm" ><i class="fa fa-angle-left"></i> Prev</button>	
						 </form>

						<?php }

						if($_SESSION['pageMe'] < $rowNm){?>
						
						<form method="get" class="d-inline">
						 <input type="hidden" name="pageNum" value="<?=($_SESSION['pageMe']+1)?>">
						 <button class="btn btn-info btn-sm">Next <i class="fa fa-angle-right"></i> </button>
						 </form>

						 <?php } ?>
					</div>

					</div>
				</div>
				<!-- <script src="../../assets/plugins/jquery/jquery-3.4.1.slim.min.js"></script> -->
				<script src="../../assets/plugins/bootstrap-441/js/bootstrap.min.js"></script>
				<script src="../../assets/mystyle/js/isi-survey.js"></script>
			</body>
			</html>

			<?php
				}else{
					echo'
					<body style="background-color:#E4E7E8;">
					<div style="width:100%;text-align:center;">
					<br><br><br>
					<h4>Mohon maaf, pengisian kuisioner belum dibuka / telah ditutup. Terima Kasih.</h4><hr>
					</div>
					</body>';
				}
			?>