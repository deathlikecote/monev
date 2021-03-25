<a href="<?php echo base_url();?>main_menu/quiz/<?php echo $id; ?>">
	<li class="midnightblue">
		<div class="imej wetasphalt">
			<?php echo $idprogstudi;?>
			<span>
				<?php echo $namaprodi;?>				
			</span>
		</div>
		<div class="xtext">
			Jenjang (<?php echo $jenprodi;?>)		
		</div>
		<?php echo ($done_p)?image_asset('icons/w_tick.png','',array('class'=>'icon')):image_asset('icons/con_compose-3.png','',array('class'=>'icon'));?>
	</li>
</a>