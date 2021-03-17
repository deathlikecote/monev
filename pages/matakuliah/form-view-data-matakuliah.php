<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$_SESSION['pesan'] ="";
		?>
	</li>
	<li>
		 <form enctype="multipart/form-data" method="post" name="myForm" id="myForm" onsubmit="return validateForm()" action="matakuliah/import-data-matakuliah.php" >
	          <label class="fileContainer" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            <a href="#" class="btn btn-sm btn-success" title="Import"><i class="fa fa-file-excel-o"></i> &nbsp;Import</a>
	            <input type="file" name="file" id="import" />
	          </label>
	          <button type="submit" class="btn btn-default" name="portdosen" id="portdosen" value="portdosen" style="position: absolute;left: 15px;z-index: -1;"></button>
		</form>
	</li>
	<li>
		<a href="matakuliah/export-data-matakuliah.php" class="btn btn-sm btn-success m-b-10"><i class="fa fa-file"></i> &nbsp;Export</a>
	</li>
	<li><a href="index.php?page=form-master-data-matakuliah" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Add Matakuliah</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data <small>Matakuliah&nbsp;</small></h1>
<!-- end page-header -->
<?php
	include "../config/koneksi.php";
	$tampilUsr	=mysqli_query($Open,"SELECT * FROM m_matakuliah ORDER BY kodemk, kelmk ASC");
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
				<h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilUsr);?></span> rows for "Data Matakuliah"</h4>
			</div>
            <div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi edit dan hapus ...
			</div>
			<div class="panel-body">
				<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
						  <th align=center>No</th>
		                  <th align=center>Kode</th>
		                  <th align=center>Nama</th>
		                  <th align=center>Nama Eng</th>
		                  <th align=center>Sks<br>Teori</th>
		                  <th align=center>Sks<br>Praktek</th>
		                  <th align=center>SKS</th>
		                  <th align=center>Kel</th>
						  <th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=0;
							while($usr	=mysqli_fetch_array($tampilUsr)){
							$no++;
						?>
						<tr>
							<td align=left style="width: 10px"> 
				               <?php echo $no; ?>
				            </td>

				            <td align=center> 
				              <?php echo strtoupper($usr['kodemk']); ?>
				            </td>

				             <td align=left> 
				              <?php echo $usr['namamk']; ?>
				            </td>

				            <td align=left > 
				              <?php echo $usr['namemk']; ?>
				            </td>

				            <td align=center> 
				              <?php echo strtoupper($usr['skst']); ?>
				            </td>

				            <td align=center> 
				              <?php echo strtoupper($usr['sksp']); ?>
				            </td>

				            <td align=center> 
				              <?php echo strtoupper($usr['sks']); ?>
				            </td>

				              <td align=center> 
				              <?php echo strtoupper($usr['kelmk']); ?>
				            </td>
							<td class="text-center">
								<a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-matakuliah&id=<?=$usr['id']?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
								<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $usr['id']?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
							</td>
						</tr>
						<!-- #modal-dialog -->
						<div id="Del<?php echo $usr['id']?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda akan menghapus matakuliah <u><?php echo $usr['namamk']?></u>?</h5>
									</div>
									<div class="modal-body" align="center">
										<a href="index.php?page=delete-data-matakuliah&id=<?=$usr['id']?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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