<html>
<head>
    
    <title>Profile Mahasiswa</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php echo $assets;?>
    
</head>
    <body>
        <div id="container">
        
			<div class="top"> 
                                <div id="logo">
                                        <h2><?php echo $nim; ?></h2>
                                        <h4><?php echo $nama; ?></h4>
                            `   </div>
                                            <ul class="button">
                                                <li><a href="<?php echo base_url();?>main_menu/nim2/<?php echo $this->session->userdata('nimopt'); ?>/<?php echo $edok; ?>" class="button-text">HOME</a></li>
                                                <li><a href="<?php echo base_url().'satpam/logout';?>" class="button-text">LOG OUT</a></li>
                                            </ul>
                        </div>
            		