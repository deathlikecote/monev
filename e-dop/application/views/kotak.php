<a href="<?php echo base_url();?>main_menu/quiz/<?php echo $id; ?>">
	<li class="midnightblue">
		<div class="imej wetasphalt">
			<?php if(strlen($kodedosen) < 5) :?>
			
				<?php echo $kodedosen;?>
			<span>
				<?php echo ($namadosen)?$namadosen:'Nama Lengkap Dosen';?>				
			</span>
			<?php else:?>
				<?php echo $namadosen;?>
			<span>
				<?php echo $kodedosen;?>
			</span>
			<?php endif;?>
		</div>
		<div class="xtext">
			<?php echo ($namamk)?$namamk:'NAMA MATA KULIAH';?> (<?php echo $kodemk;?>)		
		</div>
		<?php echo ($done_d)?image_asset('icons/w_tick.png','',array('class'=>'icon')):image_asset('icons/con_compose-3.png','',array('class'=>'icon'));?>
	</li>
</a>