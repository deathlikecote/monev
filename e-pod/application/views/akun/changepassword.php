    <div id="password">
                    <!-- Password Form -->
                    <div class="password-form" style="padding-left: 23px;">
                        
                         <div class="timeline-section"> 
                             
                            <h3 class="main-heading"><span>Change Password</span></h3>
                                <div id="password-status"> </div>
                                
                                    <form id="passwordform">
                                        <p>
                                            <label for="name">Old Password</label>
                                            <input type="password" name="pass_lama" class="input" >
                                        </p>
                                        <p>
                                            <label for="name">New Password</label>
                                            <input type="password" name="pass_baru" class="input" >
                                        </p>
                                         <p>
                                            <label for="name">Confirm Password</label>
                                            <input type="password" name="pass_ulangi" class="input" >
                                        </p>
                                        <input type="submit" name="submit" value="Change Password" class="submit">
                                    </form>
                                
                         </div>
                    </div>
                    <!-- /Password Form -->
    </div> 

<script>
var $passwordform = $('#passwordform');
		
	$passwordform.submit(function(){
		$.ajax({
		   type: "POST",
		   url: "<?php echo base_url().'/akun/change_password';?>",
		   data: $(this).serialize(),
           dataType: 'json',
		   success: function(data){	   
				$('#passwordform').html(data.msg).show();
			}
		 });
		return false;
	});	
	
</script>
    