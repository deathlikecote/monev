<div id="profile"> 
                 	<!-- Profile Mahasiswa -->
               <div class="about">
                    	<div class="photo-inner">
				<?php echo image_asset('akun/photo.jpg','',array('height'=>'186','width'=>'153'));?>
<!--							<img src="images/photo.jpg" height="186" width="153" />-->
			</div>
                                <h1><?php echo $nim; ?></h1>
                                <h3><?php echo $nama; ?></h3>
                </div>
                   
                     
                    <!-- Data Personal Mahasiswa-->
                	<ul class="personal-info">
                                <li><label>Nama</label><span><?php echo $nama; ?></span></li>
                                <li><label>NIM</label><span><?php echo $nim; ?></span></li>
                                <li><label>Email</label><span><?php echo $email; ?></span></li>
                        </ul>
</div>       
