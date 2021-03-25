    <div id="content" >
            
                                    <!-- Profile -->
                                    <div id="akun"></div>
                <!-- Menu -->
                <div class="menu">
                	<ul class="tabs">
                        <li id="a"><a href="#akun" class="tab-profile">Profile</a></li> 
                    	<li id="b"><a href="#akun2" class="tab-resume">Edit Profile</a></li>
                    	<li id="c"><a href="#akun3" class="tab-contact">Change Password</a></li>
                        </ul>
                </div>
                                    <!-- Edit Profil -->
                                    <div id="akun2"></div>
                                    <!-- Change Password --> 
                                    <div id="akun3"></div>     
    </div>

<script>
    
    $('li#a').on('click',function(){
		  $('div#akun1').html('Loading...');		
        $.post('<?php echo base_url().'/akun/page_profile';?>', function(data){
					$('div#akun').html(data.x);
				},'json');
//alert();
});

$('li#b').on('click',function(){
    $('div#akun2').html('Loading...');
				
        $.post('<?php echo base_url().'/akun/page_edit';?>', function(data){
					$('div#akun2').html(data.x);
				},'json');
//alert();
});
$('li#c').on('click',function(){
				  $('div#akun3').html('Loading...');
        $.post('<?php echo base_url().'/akun/page_password';?>', function(data){
					$('div#akun3').html(data.x);
				},'json');
//alert();
});
	$('li#a').click();				
</script>
