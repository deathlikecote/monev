<a href="<?php echo base_url();?>main_menu/quiz/<?php echo $id; ?>">
	<li class="<?php echo $class_selected;?>">
		<?php echo ($done)?image_asset('icons/w_tick.png','',array('class'=>'icon')):image_asset('icons/con_compose-3.png','',array('class'=>'icon'));?>
		<?php echo $kodedosen;?>
	</li>
</a>