<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}

            $cekRow	=mysqli_query($Open,"SELECT tglakhir FROM m_periode WHERE jenis = 'EDOM'");
			$row = mysqli_fetch_assoc($cekRow);

			$_SESSION['pesan'] ="";

            $wheres = "WHERE 1";
			if(isset($_POST['perta'])){
				$pertax = $_POST['perta'];
               
			}else{
				$pertax = $_SESSION['perta'];
			}
            $wheres .= " AND ta = '".$pertax."'";

            if(isset($_POST['seldos'])){
				$seldosx = $_POST['seldos'];
                $wheres .= " AND (total ".$seldosx.")";
			}else{
				$seldosx = '';
			}
            
            if(isset($_POST['cari'])){
				$carix = $_POST['cari'];
                $wheres .= " AND namadosen like '%".$carix."%'";
			}else{
				$carix = '';
			}

		?>
	</li>
	
</ol>


<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Executive Summary <small>&nbsp;EDOM</small></h1>
<!-- end page-header -->
<?php
	
	include "../config/koneksi.php";
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
				<h4 class="panel-title">&nbsp;</h4>
			</div>
            
			<div class="panel-body">
                <?php 
					if(date('Y-m-d') < $row['tglakhir']){
						echo '
						 
						<p>Perta/periode '.$_SESSION['perta'].' dapat dilihat pada '.$row['tglakhir'].'</p>
						';
					}
				 ?>
				<form action="index.php?page=es-edom" name="isian" class="form-inline m-b-10" method="POST" >
                    <div class="form-group">
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

                    <div class="form-group">
                        <select name="seldos" class="form-control filter">
                            <option value="!=''" <?php echo ($seldosx == "!=''") ? 'selected' : '';?>>All</option>
                            <option value=">=4.51" <?php echo ($seldosx == ">=4.51") ? 'selected' : '';?>>x>=4.51</option>
                            <option value="BETWEEN 4.00 AND 4.50" <?php echo ($seldosx == "BETWEEN 4.00 AND 4.50") ? 'selected' : '';?>>4.0 - 4.5</option>
                            <option value="BETWEEN 3.50 AND 3.99" <?php echo ($seldosx == "BETWEEN 3.50 AND 3.99") ? 'selected' : '';?>>3.5 - 3.9</option>
                            <option value="BETWEEN 3.00 AND 3.49" <?php echo ($seldosx == "BETWEEN 3.00 AND 3.49") ? 'selected' : '';?>>3.0 - 3.4</option>
                            <option value="<3.00" <?php echo ($seldosx == "<3.00") ? 'selected' : '';?>><3.0</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control cari" name="cari" id="ipt" value="<?=$carix?>" placeholder="Cari Dosen">
                    </div>
                    <div class="form-group">
		    				<button type="submit" name="caridpmk" class="btn btn-primary"><i class="fa fa-eye"></i> Tampilkan</button>
	                    </select>
		            </div>

                    <div class="form-group">
		    				<a type="button" href="es/export-es-edom.php?perta=<?=$pertax?>" class="btn btn-success"><i class="fa fa-print"></i> Export</a>
		    		
		            </div>
                </form>

                <div class="col">
                    Keterangan:<br>
                    A. Kompetensi Pedagogik<br>
                    B. Kompetensi Professional<br>
                    C. Kompetensi Kepribadian<br>
                    D. Kompetensi Sosial<br><br>
                </div>
                
                <div class="col" id="data">
                <table id="custom1" class="table table-striped table-bordered nowrap" >
                <div id="data">


                <?php
                $pembagi=0;
                $a=0;
                $totals=0;
                $No=1;
                $sql=mysqli_query($Open, 'select * from edomdata_es '.$wheres.' GROUP BY namadosen,kodemk,kelas  order by namadosen,kodemk,kelas asc');
                while($r=mysqli_fetch_array($sql)){


                if($a==0){
                $kdosen=strtoupper($r['kodedosen']);
                $sql1=mysqli_query($Open,'select SUM(total) as total from edomdata_es where kodedosen= "'.$kdosen.'" and ta = "'.$pertax.'"');
                $tots=mysqli_fetch_array($sql1);

                $sql2=mysqli_query($Open,'select * from edomdata_es where kodedosen= "'.$kdosen.'" and ta = "'.$pertax.'"');
                $pemba=mysqli_num_rows($sql2);
                $totalasli = $tots['total']/$pemba;

                echo"
                <thead>
                    <tr>
                        <th colspan='8' class='bg-inverse' >
                        $No. ".strtoupper($r['namadosen'])." <font style='float:right'>TOTAL ".number_format($totalasli,2)."</font>
                        </th>
                    </tr>
                    <tr>
                        <th style='text-align:center'>MK</th>
                        <th style='text-align:center'>PRODI</th>
                        <th style='text-align:center'>KLS</th>
                        <th style='text-align:center'>A</th>
                        <th style='text-align:center'>B</th>
                        <th style='text-align:center'>C</th>
                        <th style='text-align:center'>D</th>
                        <th style='text-align:center'>NA</th>
                    </tr>   
                </thead>
                <tbody>
                
                ";

                $a=1;
                }else{
                    if(strtoupper($r['kodedosen'])!=$kdosen){
                        $No=$No+1;
                        $sql1=mysqli_query($Open,'select SUM(total) as total from edomdata_es where kodedosen= "'.$r['kodedosen'].'" and ta = "'.$pertax.'" ');
                        $tots=mysqli_fetch_array($sql1);
                        
                        $sql2=mysqli_query($Open,'select * from edomdata_es where kodedosen= "'.$r['kodedosen'].'" and ta = "'.$pertax.'"');
                        $pemba=mysqli_num_rows($sql2);
                        $totalasli = $tots['total']/$pemba;
                        echo"
                        <thead>
                            <tr>
                                <th colspan='8' class='bg-inverse'>$No. ".strtoupper($r['namadosen'])." <font style='float:right'>TOTAL ".number_format($totalasli,2)."</font></th>
                            </tr>
                            <tr>
                                <th style='text-align:center'>MK</th>
                                <th style='text-align:center'>PRODI</th>
                                <th style='text-align:center'>KLS</th>
                                <th style='text-align:center'>A</th>
                                <th style='text-align:center'>B</th>
                                <th style='text-align:center'>C</th>
                                <th style='text-align:center'>D</th>
                                <th style='text-align:center'>NA</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            ";
                        $kdosen=strtoupper($r['kodedosen']);
                    }else{
                       
                    }
                }

                echo"<tr >
                <td style='text-align:center'>".$r['kodemk']."</td>
                <td style='text-align:center'>".$r['idprogstudi']."</td>
                <td style='text-align:center'>".$r['kelas']."</td>
                <td style='text-align:center'>".$r['A']."</td>
                <td style='text-align:center'>".$r['B']."</td>
                <td style='text-align:center'>".$r['C']."</td>
                <td style='text-align:center'>".$r['D']."</td>
                <td style='text-align:center'>".$r['total']."</td>
                </tr>

                ";

                }

                ?>
                </tbody>
                </tr>
                </table>
                <br>
                </div></div>
                
			</div>

		</div>
		<!-- end panel -->
	</div>
    <!-- end col-10 -->
</div>
<iframe id="loadarea" style="display:none;"></iframe><br />
<!-- end row -->
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
	
</script>