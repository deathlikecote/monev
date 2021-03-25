<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">	
</head>
<body>
	
	<?php $xxx = array(
		'#FFFFFF'		
		,'#F9FAF5'
		,'#3E3E6B'
		,'#3F5591'
		,'#AFC0DB'
		,'#C2CC7A'
		,'#61663D'
		,'#92995C'
		,'#C9D9AB'
		,'#CC0000'
		,'#E6EAF2 -> #F9FAF5'
		,'#FCFCFC -> #F9FAF5'
		,'#251C66 -> #3E3E6B'
		,'#2D296B -> #3E3E6B'
		, '#000000'
		);?>
	
	<?php foreach ($xxx as $value) :?>
	
	<?php if ($value < '#CCCCCC'):?>
	<div style="background-color: <?php echo $value;?>; width: 100px; height: 100px; margin: 5px; float: left; color: #FFFFFF; text-align: center; vertical-align: middle;">
		<?php echo $value;?>
	</div>
	<?php else:?>
	<div style="background-color: <?php echo $value;?>; width: 100px; height: 100px; margin: 5px; float: left; color: #000000; text-align: center; vertical-align: middle;">
		<?php echo $value;?>
	</div>
	<?php endif;?>
	<?php endforeach;?>
	
	
</body>
</html>