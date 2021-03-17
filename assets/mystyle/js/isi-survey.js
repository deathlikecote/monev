/* General Load */
$(function(){
    
});

/* Val Cv */
$('.valCv').click(function(){
	var projek  = $('input[name="projek"]').val();
	var thisTag = $(this);
	var nama 	= $(this).attr('name');
	var nama 	= nama.substr(7);
	var editCv 	= $(this).parents().eq(2).attr('id');
	var idPage 	= $(this).attr('idpage');
	var valuex 	= $(this).attr('value');
	var lainnya	= $(this).attr('lainnya');
	if(lainnya == 1){
		$('input[name="isianCv' + nama + '"]').removeAttr('disabled');
		// 
	}else{
		$('input[name="isianCv' + nama + '"]').attr('disabled','');
		$('input[name="isianCv' + nama + '"]').val('');
	}
	
	var isianCv = $('input[name="isianCv' + nama + '"]').val();
	$(this).parents().eq(2).find('input.fCv' + nama).each(function(){
		// alert($(this).attr('name'));
		if(valuex == $(this).attr('value')){
			// alert($(this).attr('value'));
			$('div#' + $(this).attr('name')).removeClass('collapse');
		}else{
			$('div#' + $(this).attr('name')).addClass('collapse');
		}
	})
	// alert(nama + " " + valuex + " " + isianCv);
	$.post("../../kuisioner/proses/isi-survey.php", {
		jenis:'saveCv', 
		projek:projek, 
		editCv:editCv, 
		idPageDetail:nama, 
		idPage:idPage, 
		valuex:valuex, 
		isianCv:isianCv}, 
		function(result){
			thisTag.parents().eq(2).removeAttr('id');
			thisTag.parents().eq(2).attr('id', result);
		});
});

/* Isian Cv */
$('.isianCv').blur(function(){
	var projek  = $('input[name="projek"]').val();
	var editCv 	= $(this).parents().eq(2).attr('id');
	var valuex 	= $(this).attr('valuex');
	var isianCv = $(this).val();
	// alert(editCv + " " + valuex + " " + isianCv);
	
	$.post("../../kuisioner/proses/isi-survey.php", {
		jenis:'saveCv', 
		projek:projek, 
		editCv:editCv, 
		valuex:valuex, 
		isianCv:isianCv});
});

/* Isian Tn */
$('.isianTn').blur(function(){
	var projek  = $('input[name="projek"]').val();
	var thisTag = $(this);
	var editTn 	= $(this).parents().eq(1).attr('id');
	var nama 	= $(this).attr('name');
	var idPage 	= $(this).attr('idpage');
	var isianTn = $(this).val();
	// alert(editTn + " " + valuex + " " + isianTn);
	
	$.post("../../kuisioner/proses/isi-survey.php", {
		jenis:'saveTn', 
		projek:projek, 
		editTn:editTn, 
		idPageDetail:nama,
		idPage:idPage, 
		isianTn:isianTn},
		function(result){
			thisTag.parents().eq(2).removeAttr('id');
			thisTag.parents().eq(2).attr('id', result);
		});
});

/* Isian Tl */
$('.isianTl').blur(function(){
	var projek  = $('input[name="projek"]').val();
	var thisTag = $(this);
	var editTl 	= $(this).parents().eq(1).attr('id');
	var nama 	= $(this).attr('name');
	var idPage 	= $(this).attr('idpage');
	var isianTl = $(this).val();
	// alert(editTl + " " + valuex + " " + isianTl);
	
	$.post("../../kuisioner/proses/isi-survey.php", {
		jenis:'saveTl', 
		projek:projek, 
		editTl:editTl, 
		idPageDetail:nama,
		idPage:idPage, 
		isianTl:isianTl},
		function(result){
			thisTag.parents().eq(1).removeAttr('id');
			thisTag.parents().eq(1).attr('id', result);
		});
});

/* Val Md */
$('.valMd').change(function(){
	var projek  = $('input[name="projek"]').val();
	var thisTag = $(this);
	var editMd 	= $(this).parents().eq(1).attr('id');
	var idPage 	= $(this).attr('idpage');
	var idPageDetail 	= $(this).parents().eq(3).attr('id');
	var valuex 	= $(this).attr('value');
	var lainnya	= $(this).attr('lainnya');
	var cek 	= '0';
	
	// alert(idPage + " " + idPageDetail + " " + nama+ " " + valuex+ " " + cek);
	if(lainnya == 1){
		if(thisTag.is(':checked')){
			$('input[name="isianMd' + valuex + '"]').removeAttr('disabled');
		}else{
			$('input[name="isianMd' + valuex + '"]').attr('disabled','');
			$('input[name="isianMd' + valuex + '"]').val('');
		}
	}

	var isianMd = $('input[name="isianMd' + valuex + '"]').val();
	
	$.post("../../kuisioner/proses/isi-survey.php", {
		jenis:'saveMd', 
		projek:projek, 
		editMd:editMd, 
		idPageDetail:idPageDetail, 
		idPage:idPage, 
		valuex:valuex, 
		isianMd:isianMd}, 
		function(result){
			thisTag.parents().eq(1).removeAttr('id');
			thisTag.parents().eq(1).attr('id', result);
		});
});

/* Isian Md */
$('.isianMd').blur(function(){
	var projek  = $('input[name="projek"]').val();
	var editMd 	= $(this).parents().eq(1).attr('id');
	// var valuex 	= $(this).attr('valuex');
	var isianMd = $(this).val();
	// alert(editMd + " " + valuex + " " + isianMd);
	
	$.post("../../kuisioner/proses/isi-survey.php", {
		jenis:'saveMd', 
		projek:projek, 
		editMd:editMd, 
		// valuex:valuex, 
		isianMd:isianMd});
});

/* Val Or */
$('.valOr').click(function(){
	var projek  		= $('input[name="projek"]').val();
	var thisTag 		= $(this);
	var nama 			= $(this).attr('name');
	var idPage 			= $(this).parents().eq(2).attr('id');
	var idPageDetail 	= $(this).parents().eq(3).attr('id');
	var idJwb 			= $(this).parents().eq(1).attr('varor');
	var editOr 			= $(this).parents().eq(1).attr('id');
	var valuex 			= $(this).attr('value');
	var lainnya			= $(this).attr('lainnya');
	// alert(idPage + " " + idPageDetail + " " + idJwb);
	if(lainnya == 1){
		$('input[name="isianOr' + nama + '"]').removeAttr('disabled');
	}
	
	var isianOr = $('input[name="isianOr' + nama + '"]').val();
	
	$.post("../../kuisioner/proses/isi-survey.php", {
		jenis:'saveOr', 
		projek:projek, 
		editOr:editOr, 
		idPageDetail:idPageDetail, 
		idPage:idPage, 
		idJwb:idJwb, 
		valuex:valuex, 
		isianOr:isianOr}, 
		function(result){
			thisTag.parents().eq(1).removeAttr('id');
			thisTag.parents().eq(1).attr('id', result);
		});
});

/* Isian Or */
$('.isianOr').blur(function(){
	var projek  = $('input[name="projek"]').val();
	var editOr 	= $(this).parents().eq(1).attr('id');
	// var valuex 	= $(this).attr('valuex');
	var isianOr = $(this).val();
	// alert(projek + " " + editOr + " " + isianOr);
	
	$.post("../../kuisioner/proses/isi-survey.php", {
		jenis:'saveIsianOr', 
		projek:projek, 
		editOr:editOr, 
		// valuex:valuex, 
		isianOr:isianOr});
});