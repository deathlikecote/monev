<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$wheres = '1';
			$cKodeprodi = '';
			$ckelas = '';
			$cStatus = '';
			$_SESSION['pesan'] ="";

			if(isset($_POST['perta'])){
				$pertax = $_POST['perta'];
			}else{
				$pertax = $_SESSION['perta'];
			}

			$wheres .= " AND perta ='".$pertax."'";

			if(isset($_POST['kdprodi'])){
				if(!empty($_POST['kdprodi'])){
					$cKodeprodi = $_POST['kdprodi'];
					$wheres .= " AND kdprodi ='".$_POST['kdprodi']."'";
				}
				
			}

			if(isset($_POST['kelas'])){
				if(!empty($_POST['kelas'])){
					$ckelas = $_POST['kelas'];
					$wheres .= " AND kelas ='".$_POST['kelas']."'";
				}
			}

			if(isset($_POST['status'])){
				if(!empty($_POST['status'])){
					$cStatus = $_POST['status'];
					$wheres .= " AND status ='".$_POST['status']."'";
				}
			}
		?>
	</li>
	<li>
		 <form enctype="multipart/form-data" method="post" name="myForm" id="myForm" onsubmit="return validateForm()" action="referensi/kelas/import-data-kelas.php" >
	          <label class="fileContainer" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            <a href="#" class="btn btn-sm btn-success" title="Import"><i class="fa fa-file-excel-o"></i> &nbsp;Import</a>
	            <input type="file" name="file" id="import" />
	          </label>
	          <button type="submit" class="btn btn-default" name="portdosen" id="portdosen" value="portdosen" style="position: absolute;left: 15px;z-index: -1;"></button>
		</form>
	</li>
	<li>
		<a href="referensi/kelas/export-data-kelas.php" class="btn btn-sm btn-success m-b-10"><i class="fa fa-file"></i> &nbsp;Export</a>
	</li>
	<li>
		<a href="referensi/kelas/sink-data-kelas.php" class="btn btn-sm btn-warning m-b-10"><i class="fa fa-repeat"></i> &nbsp;Sinkron</a>
	</li>
	<li><a href="index.php?page=form-master-data-kelas" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Add</a></li>
	<li><a type="button" class="btn btn-sm btn-danger m-b-10" data-toggle="modal" data-target="#deleteall"><i class="fa fa-minus-circle" ></i> &nbsp;Delete All</a></li>
</ol>
<!-- Modal DellAll -->
<div id="deleteall" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda akan menghapus data pada perta <u><?=$pertax?></u> ?</h5>
			</div>
			<div class="modal-body" align="center">
				<a href="index.php?page=deleteall-data-kelas&perta=<?=$pertax?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Referensi <small>Kelas Mahasiswa Aktif&nbsp;</small></h1>
<!-- end page-header -->
<?php
	
	include "../config/koneksi.php";
	$tampilUsr	=mysqli_query($Open,"SELECT * FROM t_kelas WHERE $wheres ORDER BY perta, kdprodi, kelas, nim asc");
?>
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
    <div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilUsr);?></span> rows for "Data Kelas Mahasiswa Aktif"</h4>
			</div>
            <div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi edit dan hapus ...
			</div>
			<div class="panel-body">
				<form action="index.php?page=form-view-data-kelas" name="isian" class="form-horizontal" method="POST" >

				<div class="form-inline"  style="margin-bottom: 20px">
					<div class="form-group">
					
		                <div class="col-md-2 text-left">
		                    <select id="perta" name="perta" class="form-control" >
		                    	<option value="<?=$_SESSION['perta']?>" <?php echo ($pertax == $_SESSION['perta']) ? 'selected' : '';?>><?=$_SESSION['perta']?></option>
		                    	<?php
		                    		$cPerta = mysqli_query($Open, "SELECT TABLE_NAME AS cPerta FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$DB."' AND (TABLE_NAME like 'edomparameter%' AND LENGTH(TABLE_NAME) > 14)");
		                            $per=1;
		                            $sampaithn = date('Y')+1;
		                            while($rPerta = mysqli_fetch_array($cPerta)){
		                            	$listPerta = substr($rPerta['cPerta'], 13);
		                            	 ?>
		                              	<option value="<?=$listPerta?>" <?php echo ($pertax == $listPerta) ? 'selected' : '';?>><?=$listPerta?></option>
 										<?php
		                            }
		                            
		                           ?>
		                    </select>
	                    </div>
		            </div>

					<div class="form-group">
					
		                <div class="col-md-2 text-left">
		                    <select id="kdprodi" name="kdprodi" class="form-control" searchable="" >
	                        <option value="">--Pilih Prodi--</option>
	                         <?php
	                            $a=0;
	                            $t=mysqli_query($Open,"SELECT * FROM m_prodi ORDER BY kodeprodi ASC");
	                            while($tak=mysqli_fetch_array($t)){
	                           ?>
	                            <option value="<?=$tak['kodeprodi']?>" <?php echo ($cKodeprodi == $tak['kodeprodi']) ? 'selected' : '';?>><?=$tak['kodeprodi']?></option>";  
	                           
	                          <?php } ?>
	                    </select>
	                    </div>
		            </div>

		            <div class="form-group">
					
		                <div class="col-md-2 text-left">
		                    <select id="kelas" name="kelas" class="form-control" searchable="" >
	                        <option value="">--Pilih Kelas--</option>
	                         <?php
	                            $a=0;
	                            $t=mysqli_query($Open,"SELECT DISTINCT(kelas) FROM t_kelas ORDER BY kelas ASC");
	                            while($tak=mysqli_fetch_array($t)){
	                           ?>
	                            <option value="<?=$tak['kelas']?>" <?php echo ($ckelas == $tak['kelas']) ? 'selected' : '';?>><?=$tak['kelas']?></option>";  
	                           <?php
	                          }
	                          ?>
	                    </select>
	                    </div>
		            </div>

		            <div class="form-group">
					
		                <div class="col-md-2 text-left">
		                    <select id="status" name="status" class="form-control" searchable="" >
	                        <option value="">--Pilih Status--</option>
                            <option value="Aktif" <?php echo ($cStatus == 'Aktif') ? 'selected' : '';?>>Aktif</option>";  
	                         <option value="Nonaktif" <?php echo ($cStatus == 'Nonaktif') ? 'selected' : '';?>>Nonaktif</option>";  
	                    </select>
	                    </div>
		            </div>
		        </div>
		        </form>
				<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
						  <th align=center>No</th>
		                  <th align=center>Perta</th>
		                  <th align=center>Prodi</th>
		                  <th align=center>Kelas</th>
		                  <th align=center>NIM</th>
		                  <th align=center>Nama</th>
		                  <th align=center>Status</th>
						  <th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=0;
							while($usr = mysqli_fetch_array($tampilUsr)){
							$no++;
						?>
						<tr>
							<td align=left style="width: 10px"> 
				               <?php echo $no; ?>
				            </td>

				            <td align=center> 
				              <?php echo strtoupper($usr['perta']); ?>
				            </td>

				             <td align=left> 
				              <?php echo strtoupper($usr['kdprodi']); ?>
				            </td>

				            <td align=left> 
				              <?php echo strtoupper($usr['kelas']); ?>
				            </td>

				            <td align=left> 
				              <?php echo strtoupper($usr['nim']); ?>
				            </td>

				            <td align=left> 
				              <?php echo strtoupper($usr['nama']); ?>
				            </td>

				            <td align=left> 
				              <?php echo strtoupper($usr['status']); ?>
				            </td>
							<td class="text-center">
								<a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-kelas&id=<?=$usr['id']?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
								<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $usr['id']?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
							</td>
						</tr>
						<!-- #modal-dialog -->
						<div id="Del<?php echo $usr['id']?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda akan menghapus <u><?php echo $usr['nama']?></u>?</h5>
									</div>
									<div class="modal-body" align="center">
										<a href="index.php?page=delete-data-kelas&id=<?=$usr['id']?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
									</div>
									<div class="modal-footer">
										<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- end panel -->
	</div>
    <!-- end col-10 -->
</div>
<!-- end row -->
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);

	$(document).ready(function(){
		$('#import').change(function(){
	          $('#portdosen').trigger('click');
	     });

		$('#perta, #kdprodi, #kelas, #status').change(function(){
			// alert();
	          $('form[name="isian"]').submit();
	     });
	})

	 function validateForm()
    {

        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('import', ['.xlsx'])){
            alert("Hanya file excel yang diijinkan.");
            return false;
        }
    }
</script>