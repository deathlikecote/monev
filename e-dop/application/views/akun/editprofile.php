<div id="resume">
     <div class="timeline-section"> 
           <h3 class="main-heading"><span>Edit Profile</span></h3>
                <div id="status-edit"></div>
					<form action="" id="editform">
					<p>
						<label for="name">Nama</label>
						<input type="text" name="editnama" class="input" value="<?php echo $nama;?>">
					</p>
					<p>
						<label for="email">Your Email</label>
						<input type="text" name="editemail" class="input" value="<?php echo $email;?>">
					</p>
						<input type="submit" name="edit" value="Edit" class="submit">
					</form>
     </div>        
</div>

<script>
var $editform= $('#editform');
		
	$editform.submit(function(){
		$.ajax({
		   type: "POST",
		   url: "<?php echo base_url().'/akun/update_profile';?>",
		   data: $(this).serialize(),
           dataType: 'json',
		   success: function(data){
				if(data.msg == ''){
					window.location.href='akun';			
				} else {
					$('div#status-edit').html(data.msg).show();
				}	
			}
		 });
		 
		return false;
	});	
	
</script>
    