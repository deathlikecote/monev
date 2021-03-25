
<a href="<?php echo base_url();?>main_menu/quiz/<?php echo $id; ?>">
	<li class="midnightblue">
		<div class="imej wetasphalt">
			<?php echo $kodedosen;?>
			<span style="font-size: 0.3em;">
				<?php echo ($namadosen)?$namadosen:'Nama Lengkap Dosen';?>				
			</span>
		</div>
		<div class="xtext" style="font-size: 1em;">
			<?php echo ($namamk)?$namamk:'NAMA MATA KULIAH';?> (<?php echo $kodemk;?>)		
		</div>
		<?php echo ($done)?image_asset('icons/w_tick.png','',array('class'=>'icon')):image_asset('icons/con_compose-3.png','',array('class'=>'icon'));?>
	</li>
</a>