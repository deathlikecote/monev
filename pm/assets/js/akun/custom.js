jQuery(document).ready(function(){ 
	
	/* ---------------------------------------------------------------------- */
	/*	Custom Functions
	/* ---------------------------------------------------------------------- */
	
	// Needed variables
	var $logo 	= $('#logo');
		
	// Show logo 
	$('.tab-resume,.tab-contact').click(function() {
	  $logo.fadeIn('slow');
	});
	// Hide logo
	$('.tab-profile').click(function() {
	  $logo.fadeOut('slow');
	});	
	
	/* ---------------------------------------------------------------------- */
	/*	Menu
	/* ---------------------------------------------------------------------- */
	
	// Needed variables
	var $content 		= $("#content");
	
	// Run easytabs
  	$content.easytabs({
	  animate			: true,
	  updateHash		: false,
	  transitionIn		:'slideDown',
	  transitionOut		:'slideUp',
	  animationSpeed	:800,
	  tabs				:"> .menu > ul > li",
	  tabActiveClass	:'active'
	});
	
	// Hover menu effect
	$content.find('.tabs li a').hover(
		function() {
			$(this).stop().animate({ marginTop: "-7px" }, 200);
		},function(){
			$(this).stop().animate({ marginTop: "0px" }, 300);
		}
	);
	
	/* ---------------------------------------------------------------------- */
	/*	Fancybox 
	/* ---------------------------------------------------------------------- */
	$container.find('.folio').fancybox({
		'transitionIn'		:	'elastic',
		'transitionOut'		:	'elastic',
		'speedIn'			:	200, 
		'speedOut'			:	200, 
		'overlayOpacity'	:   0.6
	});
	
	/* ---------------------------------------------------------------------- */
	/*	Contact Form
	/* ---------------------------------------------------------------------- */
	
	// Needed variables
	var $passwordform 	= $('#passwordform'),
		$success		= 'Terimakasih ';
		
//	$passwordform.submit(function(){
//		$.ajax({
//		   type: "POST",
//		   url: "php/password.php",
//		   data: $(this).serialize(),
//		   success: function(msg)
//		   {
//				if(msg == 'SEND'){
//					response = '<div class="success">'+ $success +'</div>';
//				}
//				else{
//					response = '<div class="error">'+ msg +'</div>';
//				}
//				// Hide any previous response text
//				$(".error,.success").remove();
//				// Show response message
//				$passwordform.prepend(response);
//			}
//		 });
//		return false;
//	});	
	

});	