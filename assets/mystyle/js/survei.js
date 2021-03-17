/* Tools & edit collapse */
$(function(){
    // $("#addPage").collapse({"toggle": false });
    $(".editPage, #toolsPage").on('click', function(){
		$("#headerme").collapse('hide');
		$("#shl").collapse('hide');
		$("#cv").collapse('hide');
		$("#tn").collapse('hide');
		$("#tl").collapse('hide');
		$("#md").collapse('hide');
		$("#or").collapse('hide');
	    $("#addPage").collapse('show');
	    $('html, body').animate({
        	scrollTop: $("#panelTools").offset().top
    	}, 500);
	});

	$(".editHl, #toolsHl").on('click', function(){
		$("#headerme").collapse('show');
		$("#shl").collapse('hide');
		$("#cv").collapse('hide');
		$("#tn").collapse('hide');
		$("#tl").collapse('hide');
		$("#md").collapse('hide');
		$("#or").collapse('hide');
	    $("#addPage").collapse('hide');
	    $('html, body').animate({
        	scrollTop: $("#panelTools").offset().top
    	}, 500);
	});

	$(".editShl, #toolsSh").on('click', function(){
		$("#headerme").collapse('hide');
		$("#shl").collapse('show');
		$("#cv").collapse('hide');
		$("#tn").collapse('hide');
		$("#tl").collapse('hide');
		$("#md").collapse('hide');
		$("#or").collapse('hide');
	    $("#addPage").collapse('hide');
	    $('html, body').animate({
        	scrollTop: $("#panelTools").offset().top
    	}, 500);
	});

	$(".editCv, #toolsCv").on('click', function(){
		$("#headerme").collapse('hide');
		$("#shl").collapse('hide');
		$("#cv").collapse('show');
		$("#tn").collapse('hide');
		$("#tl").collapse('hide');
		$("#md").collapse('hide');
		$("#or").collapse('hide');
	    $("#addPage").collapse('hide');
      	$('html, body').animate({
        	scrollTop: $("#panelTools").offset().top
    	}, 500);
	});

	$(".editTn, #toolsTn").on('click', function(){
		$("#headerme").collapse('hide');
		$("#shl").collapse('hide');
		$("#cv").collapse('hide');
		$("#tn").collapse('show');
		$("#tl").collapse('hide');
		$("#md").collapse('hide');
		$("#or").collapse('hide');
	    $("#addPage").collapse('hide');
      	$('html, body').animate({
        	scrollTop: $("#panelTools").offset().top
    	}, 500);
	});

	$(".editTl, #toolsTl").on('click', function(){
		$("#headerme").collapse('hide');
		$("#shl").collapse('hide');
		$("#cv").collapse('hide');
		$("#tn").collapse('hide');
		$("#tl").collapse('show');
		$("#md").collapse('hide');
		$("#or").collapse('hide');
	    $("#addPage").collapse('hide');
      	$('html, body').animate({
        	scrollTop: $("#panelTools").offset().top
    	}, 500);
	});

	$(".editMd, #toolsMd").on('click', function(){
		$("#headerme").collapse('hide');
		$("#shl").collapse('hide');
		$("#cv").collapse('hide');
		$("#tn").collapse('hide');
		$("#tl").collapse('hide');
		$("#md").collapse('show');
		$("#or").collapse('hide');
	    $("#addPage").collapse('hide');
      	$('html, body').animate({
        	scrollTop: $("#panelTools").offset().top
    	}, 500);
	});

	$(".editOr, #toolsOr").on('click', function(){
		$("#headerme").collapse('hide');
		$("#shl").collapse('hide');
		$("#cv").collapse('hide');
		$("#tn").collapse('hide');
		$("#tl").collapse('hide');
		$("#md").collapse('hide');
		$("#or").collapse('show');
	    $("#addPage").collapse('hide');
      	$('html, body').animate({
        	scrollTop: $("#panelTools").offset().top
    	}, 500);
	});
});

/* tampil detail responden */
$('.sDetail').click(function(e){
	e.preventDefault();

	var id = $(this).attr('id');
	var realId = id.substr(5);
	// alert(realId);
	if($('div#rTampil' + realId).attr('class') == 'collapse'){
		$('div#rTampil' + realId).removeClass('collapse');
		$('i#iResp' + realId).removeClass();
		$('i#iResp' + realId).addClass('fa fa-minus text-success');
	}else{
		$('div#rTampil' + realId).addClass('collapse');
		$('i#iResp' + realId).removeClass();
		$('i#iResp' + realId).addClass('fa fa-plus text-success');
	}
});

/* Reset to default form */
$('a.tools').click(function(){
	var id 	= $(this).attr('id');
	var sid	= id.substr(5) ;
});

/* Cancel btn */
$('a.cancel').click(function(){
	var id 		= $(this).attr('id');
	var id 		= id.substr(6);
	$('div#' + id + ' form').find("input[type=text], textarea, select").val("");
	$('div#' + id + ' form').find("input[type=checkbox]").removeAttr("checked");
	$('#idCv, #idTn, #idPage, #idHl, #idShl, #idTl, #idMd, #idOr').val('');

	if(id == 'cv'){
		var lainnyaCv = $("form[name='cv']").find($("input[class='lainnyaCv']") );
		var valLainnyaCv = lainnyaCv.length;
		for (var i = 2; i < valLainnyaCv; i++) {
			$('input[name="lainnyaCv' + i + '"]').parents().eq(2).remove();
		}
		$('button[name="minCv"]').remove();
	}

	if(id == 'md'){
		var lainnyaMd = $("form[name='md']").find($("input[class='lainnyaMd']") );
		var valLainnyaMd = lainnyaMd.length;
		for (var i = 2; i < valLainnyaMd; i++) {
			$('input[name="lainnyaMd' + i + '"]').parents().eq(2).remove();
		}
		$('button[name="minMd"]').remove();
	}

	if(id == 'or'){
		var lainnyaOr = $("form[name='or']").find($("input[class='lainnyaOr']") );
		var valLainnyaOr = lainnyaOr.length;
		for (var i = 1; i < valLainnyaOr; i++) {
			$('input[name="lainnyaOr' + i + '"]').parents().eq(2).remove();
		}
		$('button[name="minOr"]').remove();

		var lainnyaOrVal = $("form[name='or']").find($("input.rangeOr") );
		var valLainnyaOrVal = lainnyaOrVal.length;
		for (var a = 4; a < valLainnyaOrVal; a++) {
			$('input#rngOr' + a + '').parents().eq(1).remove();
		}
	}
});

/* Validasi form dengan no pertanyaan sama */
$('form.validasi').submit(function(){
	var formName = $(this).attr('name');
	if($('form[name="' + formName + '"] div').hasClass('has-error')){
		alert('Nomor pertanyaan / value tidak boleh duplikat');
		return false;
	}
});

/* Mencari value jawaban untuk Filter*/
$('select.varFilter').change(function(){
	var idVarFilter = $(this).attr('id');
	var idValFilter = idVarFilter.substr(4);
	var lookVarFilter = $(this).val();
	$.post("projek/master-lookup-kuisioner.php", {jenis:'lookValFilter', idVarFilter:idVarFilter, lookVarFilter:lookVarFilter}, function(result){
		$('#fVal' + idValFilter).html(result);
	});

});

$('input.lookVal').keyup(function(){
	var idVal = $(this).attr('id');
	var value = $(this).val();
	var projek = $('input[name="projek"]').val();
	$('#' + idVal).parents().eq(0).removeClass('has-success');
	$('#' + idVal).parents().eq(0).removeClass('has-error');
	$('#' + idVal).next('span').html('');
	
	if(value == ''){
		$('#' + idVal).parents().eq(0).addClass('has-error');
	}

	if(idVal != 'valShl'){
		$.post("projek/master-lookup-kuisioner.php", {jenis:'lookValDuplikat', idVal:idVal, value:value, projek:projek}, function(result){
			if(result == '1'){
				$('#' + idVal).parents().eq(0).addClass('has-success');
			}else{
				$('#' + idVal).parents().eq(0).addClass('has-error');
				$('#' + idVal).next('span').html('Duplikat');
			}
		});
	}

});

$('li.menuDetail > a').click(function(){
	var idVal = $(this).attr('href');
	var idVal = idVal.substr(1);
	$.post("projek/master-lookup-kuisioner.php", {jenis:'setActiveMenu', idVal:idVal});

});

$('#addCv').click(function(){
	var lainnyaCv = $("form[name='cv']").find($("input[class='lainnyaCv']") );
	var valLainnyaCv = lainnyaCv.length - 1;
	valLainnyaCv++;
	var input = '<div class="form-group">'+
			'<div class="col-md-2">'+
				'<input type="text" name="valCv[]" id="valCv" placeholder="Val" class="form-control input-sm" required="" />'+
			'</div>'+
			'<div class="col-md-7">'+
				'<input type="text" name="jwbCv[]" id="jwbCv" placeholder="Jawaban" class="form-control input-sm" required="" />'+
			'</div>'+
			'<div class="col-md-1 col-xs-2 checkbox">'+
				'<label>'+
				'<input type="checkbox" value="lainnya" name="lainnyaCv'+ valLainnyaCv +'" class="lainnyaCv">Lainnya'+
				'</label>'+
			'</div>'+
			'<div class="col-md-2 col-xs-1 text-right">'+
				'<button type="button" name="minCv" id="minCv'+ valLainnyaCv +'" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>'+
			'</div>'+
		'</div>';

	$('#grpJawabanCv').append(input);
});

$('#addMd').click(function(){
	var lainnyaMd = $("form[name='md']").find($("input[class='lainnyaMd']") );
	var valLainnyaMd = lainnyaMd.length - 1;
	valLainnyaMd++;
	var input = '<div class="form-group">'+
			'<div class="col-md-2">'+
				'<input type="text" name="vorMd[]" id="vorMd[]" placeholder="Var" class="form-control input-sm" required="" />'+
			'</div>'+
			'<div class="col-md-2">'+
				'<input type="text" name="valMd[]" id="valMd" placeholder="Val" class="form-control input-sm" required="" />'+
			'</div>'+
			'<div class="col-md-5">'+
				'<input type="text" name="jwbMd[]" id="jwbMd" placeholder="Jawaban" class="form-control input-sm" required="" />'+
			'</div>'+
			'<div class="col-md-1 col-xs-2 checkbox">'+
				'<label>'+
				'<input type="checkbox" value="lainnya" name="lainnyaMd'+ valLainnyaMd +'" class="lainnyaMd">Lainnya'+
				'</label>'+
			'</div>'+
			'<div class="col-md-2 col-xs-1 text-right">'+
				'<button type="button" name="minMd" id="minMd'+ valLainnyaMd +'" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>'+
			'</div>'+
		'</div>';

	$('#grpJawabanMd').append(input);
});

$('#addOr').click(function(){
	var lainnyaOr = $("form[name='or']").find($("input[class='lainnyaOr']") );
	var valLainnyaOr = lainnyaOr.length - 1;
	valLainnyaOr++;
	var input = '<div class="form-group">'+
			'<div class="col-md-2">'+
				'<input type="text" name="vorOr[]" id="vorOr" placeholder="Var" class="form-control input-sm" required="" />'+
			'</div>'+
			'<div class="col-md-7">'+
				'<input type="text" name="jwbOr[]" id="jwbOr" placeholder="Jawaban" class="form-control input-sm" required="" />'+
			'</div>'+
			'<div class="col-md-1 col-xs-2 checkbox">'+
				'<label>'+
				'<input type="checkbox" value="lainnya" name="lainnyaOr'+ valLainnyaOr +'" class="lainnyaOr">Lainnya'+
				'</label>'+
			'</div>'+
			'<div class="col-md-2 col-xs-1 text-right">'+
				'<button type="button" name="minOr" id="minOr'+ valLainnyaOr +'" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>'+
			'</div>'+
		'</div>';

	$('#grpJawabanOr').append(input);
});

$('#addOrVal').click(function(){
	var lainnyaOrVal = $("form[name='or']").find($("input.rangeOr"));
	var valLainnyaOrVal = lainnyaOrVal.length - 1;
	// alert(valLainnyaOrVal);
	valLainnyaOrVal++;
	var input = '<div class="form-group">'+
			'<div class="col-md-2">'+
				'<input type="text" name="valOr[]" id="valOr" placeholder="Val" class="form-control input-sm" required="" />'+
			'</div>'+
			'<div class="col-md-8">'+
				'<input type="text" name="rngOr[]" id="rngOr'+ valLainnyaOrVal +'" placeholder="Label" class="form-control input-sm rangeOr" required="" />'+
			'</div>'+
			'<div class="col-md-2 col-xs-1 text-right">'+
				'<button type="button" name="minOrVal" id="minOrVal'+ valLainnyaOrVal +'" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>'+
			'</div>'+
		'</div>';

	$('#grpValueOr').append(input);
});

$("form[name='cv']").on("click", "button[name='minCv']", function(){
	$(this).parents().eq(1).remove();
});

$("form[name='md']").on("click", "button[name='minMd']", function(){
	$(this).parents().eq(1).remove();
});

$("form[name='or']").on("click", "button[name='minOr']", function(){
	$(this).parents().eq(1).remove();
});

$("form[name='or']").on("click", "button[name='minOrVal']", function(){
	$(this).parents().eq(1).remove();
});

$('.editPage').click(function(){
	var id 			= $(this).attr('name');
	var varFilter 	= $(this).attr('var-filter');
	var valFilter 	= $(this).attr('val-filter');
	var projek	 	= $(this).attr('projek');
	var lookVarFilter = varFilter + "-" + "cv-" + projek;
	$('#idPage').val(id);
	$('#fVarPage').val(lookVarFilter);

	$.post("projek/master-lookup-kuisioner.php", {jenis:'lookValFilter', idVarFilter:varFilter, lookVarFilter:lookVarFilter}, function(result){
		$('#fValPage').html(result);
		$('#fValPage').val(valFilter);
	});
});

$('.editHl').click(function(){
	var id 		= $(this).attr('name');
	var val 	= $(this).attr('val');
	var judul 	= $(this).attr('judul');
	$('#valHeader').val(val);
	$('#judulHeader').val(judul);
	$('#idHl').val(id);

});

/* Edit Sh*/
$('.editShl').click(function(){
	var id 		= $(this).attr('name');
	var val 	= $(this).attr('val');
	var judul 	= $(this).attr('judul');
	$('#valShl').val(val);
	$('#judulShl').val(judul);
	$('#idShl').val(id);

});

/* Edit Cv */
$('.editCv').click(function(){
	var id 			= $(this).attr('id');
	var projek 		= $(this).attr('projek');
	var a 			= 0;
	var check 		= '';
	
	$('div#grpJawabanCv').empty();
	$('#idCv').val(id);
	$.post("projek/master-lookup-kuisioner.php", {jenis:'editCv', subjenis: 'pertanyaan', id:id, projek:projek}, function(result){
        $.each(result, function(key, value){
        	var valuex = value.split('|');
      		// alert(key + ": " + value + " " + a);
      		if(valuex[1] == 'first'){
      			$('#varCv').val(key);
				$('#askCv').val(valuex[0]);

      		}else if(valuex[1] == 'filter'){
      			var lookVarFilter = key + "-" + "cv-" + projek;
				$('#fVarCv').val(lookVarFilter);
				$.post("projek/master-lookup-kuisioner.php", {jenis:'lookValFilter', idVarFilter:key, lookVarFilter:lookVarFilter}, function(result){
					$('#fValCv').html(result);
					$('#fValCv').val(valuex[0]);
				});

      		}else{
      			
      			if(valuex[1] == 1){
      				check = 'checked';
      			}else{
      				check = '';
      			}
				var input = '<div class="form-group">'+
						'<div class="col-md-2">'+
							'<input type="text" name="valCv[]" id="valCv" value="' + key + '" placeholder="Val" class="form-control input-sm" required="" />'+
						'</div>'+
						'<div class="col-md-7">'+
							'<input type="text" name="jwbCv[]" id="jwbCv" value="' + valuex[0] + '" placeholder="Jawaban" class="form-control input-sm" required="" />'+
						'</div>'+
						'<div class="col-md-1 col-xs-2 checkbox">'+
							'<label>'+
							'<input type="checkbox" value="lainnya" name="lainnyaCv'+ a +'" class="lainnyaCv" ' + check + '>Lainnya'+
							'</label>'+
						'</div>'+
						'<div class="col-md-2 col-xs-1 text-right">'+
							'<button type="button" name="minCv" id="minCv'+ a +'" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>'+
						'</div>'+
					'</div>';

				// $(input).insertBefore('#cvGrupSave');
				$('#grpJawabanCv').append(input);
				a++;
			}
      		
    	});
	}, "json")
});

/* Edit Md */
$('.editMd').click(function(){
	var id 			= $(this).attr('id');
	var projek 		= $(this).attr('projek');
	var a 			= 0;
	var check 		= '';
	
	$('div#grpJawabanMd').empty();
	$('#idMd').val(id);
	$.post("projek/master-lookup-kuisioner.php", {jenis:'editMd', subjenis: 'pertanyaan', id:id, projek:projek}, function(result){
        $.each(result, function(key, value){
        	var valuex = value.split('|');
      		// alert(key + ": " + value + " " + a);
      		if(valuex[1] == 'first'){
      			$('#varMd').val(key);
				$('#askMd').val(valuex[0]);

      		}else if(valuex[1] == 'filter'){
      			var lookVarFilter = key + "-" + "cv-" + projek;
				$('#fVarMd').val(lookVarFilter);
				$.post("projek/master-lookup-kuisioner.php", {jenis:'lookValFilter', idVarFilter:key, lookVarFilter:lookVarFilter}, function(result){
					$('#fValMd').html(result);
					$('#fValMd').val(valuex[0]);
				});

      		}else{
      			
      			if(valuex[1] == 1){
      				check = 'checked';
      			}else{
      				check = '';
      			}
				var input = '<div class="form-group">'+
						'<div class="col-md-2">'+
							'<input type="text" name="vorMd[]" id="vorMd[]" value="' + valuex[2] + '" placeholder="Var" class="form-control input-sm" required="" />'+
						'</div>'+
						'<div class="col-md-2">'+
							'<input type="text" name="valMd[]" id="valMd" value="' + key + '" placeholder="Val" class="form-control input-sm" required="" />'+
						'</div>'+
						'<div class="col-md-5">'+
							'<input type="text" name="jwbMd[]" id="jwbMd" value="' + valuex[0] + '" placeholder="Jawaban" class="form-control input-sm" required="" />'+
						'</div>'+
						'<div class="col-md-1 col-xs-2 checkbox">'+
							'<label>'+
							'<input type="checkbox" value="lainnya" name="lainnyaMd'+ a +'" class="lainnyaMd" ' + check + '>Lainnya'+
							'</label>'+
						'</div>'+
						'<div class="col-md-2 col-xs-1 text-right">'+
							'<button type="button" name="minMd" id="minMd'+ a +'" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>'+
						'</div>'+
					'</div>';

				// $(input).insertBefore('#MdGrupSave');
				$('#grpJawabanMd').append(input);
				a++;
			}
      		
    	});
	}, "json")
});

/* Edit Tn */
$('.editTn').click(function(){
	var id 			= $(this).attr('id');
	var projek 		= $(this).attr('projek');
	
	$('#idTn').val(id);
	$.post("projek/master-lookup-kuisioner.php", {jenis:'editTn', subjenis: 'pertanyaan', id:id, projek:projek}, function(result){
       $('#varTn').val(result['id_soal']);
       $('#askTnBef').val(result['label']);
       $('#askTnAft').val(result['behind']);
       var lookVarFilter = result['variable'] + "-cv-" + projek;

	   $('#fVarTn').val(lookVarFilter);
	   $.post("projek/master-lookup-kuisioner.php", {jenis:'lookValFilter', idVarFilter:result['variable'], lookVarFilter:lookVarFilter}, function(data){
			$('#fValTn').html(data);
			$('#fValTn').val(result['valuexx']);
		});
	}, "json")
});

/* Edit Tl */
$('.editTl').click(function(){
	var id 			= $(this).attr('id');
	var projek 		= $(this).attr('projek');
	
	$('#idTl').val(id);
	$.post("projek/master-lookup-kuisioner.php", {jenis:'editTn', subjenis: 'pertanyaan', id:id, projek:projek}, function(result){
       $('#varTl').val(result['id_soal']);
       $('#jwbTl').val(result['label']);
       var lookVarFilter = result['variable'] + "-cv-" + projek;

	   $('#fVarTl').val(lookVarFilter);
	   $.post("projek/master-lookup-kuisioner.php", {jenis:'lookValFilter', idVarFilter:result['variable'], lookVarFilter:lookVarFilter}, function(data){
			$('#fValTl').html(data);
			$('#fValTl').val(result['valuexx']);
		});
	}, "json")
});

/* Edit Or */
$('.editOr').click(function(){
	var id 			= $(this).attr('id');
	var projek 		= $(this).attr('projek');
	var a 			= 0;
	var b 			= 0;
	var check 		= '';
	
	$('div#grpJawabanOr').empty();
	$('div#grpValueOr').empty();
	$('#idOr').val(id);
	$.post("projek/master-lookup-kuisioner.php", {jenis:'editOr', subjenis: 'pertanyaan', id:id, projek:projek}, function(result){
        $.each(result, function(key, value){
        	var valuex = value.split('|');
      		// alert(key + ": " + value + " " + a);
      		if(valuex[1] == 'first'){
      			$('#varOr').val(key);
				$('#askOr').val(valuex[0]);

      		}else if(valuex[1] == 'filter'){
      			var lookVarFilter = key + "-" + "cv-" + projek;
				$('#fVarOr').val(lookVarFilter);
				$.post("projek/master-lookup-kuisioner.php", {jenis:'lookValFilter', idVarFilter:key, lookVarFilter:lookVarFilter}, function(result){
					$('#fValOr').html(result);
					$('#fValOr').val(valuex[0]);
				});

      		}else{
      			
      			if(valuex[2] == 'variabel'){
	      			if(valuex[1] == 1){
	      				check = 'checked';
	      			}else{
	      				check = '';
	      			}

					var input = '<div class="form-group">'+
						'<div class="col-md-2">'+
							'<input type="text" name="vorOr[]" id="vorOr" value="' + key + '" placeholder="Var" class="form-control input-sm" required="" />'+
						'</div>'+
						'<div class="col-md-7">'+
							'<input type="text" name="jwbOr[]" id="jwbOr" value="' + valuex[0] + '" placeholder="Jawaban" class="form-control input-sm" required="" />'+
						'</div>'+
						'<div class="col-md-1 col-xs-2 checkbox">'+
							'<label>'+
							'<input type="checkbox" value="lainnya" name="lainnyaOr'+ a +'" class="lainnyaOr" ' + check + '>Lainnya'+
							'</label>'+
						'</div>'+
						'<div class="col-md-2 col-xs-1 text-right">'+
							'<button type="button" name="minOr" id="minOr'+ a +'" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>'+
						'</div>'+
					'</div>';
					$('#grpJawabanOr').append(input);
					a++;

				}else{
					var input = '<div class="form-group">'+
						'<div class="col-md-2">'+
							'<input type="text" name="valOr[]" id="valOr" value="' + key + '" placeholder="Val" class="form-control input-sm" required="" />'+
						'</div>'+
						'<div class="col-md-8">'+
							'<input type="text" name="rngOr[]" id="rngOr'+ b +'" value="' + valuex[0] + '" placeholder="Label" class="form-control input-sm rangeOr" required="" />'+
						'</div>'+
						'<div class="col-md-2 col-xs-1 text-right">'+
							'<button type="button" name="minOrVal" id="minOrVal'+ b +'" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button>'+
						'</div>'+
					'</div>';

					$('#grpValueOr').append(input);
					b++;
				}

			}
      		
    	});
	}, "json")
});

$('.addMePaging').click(function(){
	var id = $(this).attr('id');
	var idPaging = $(this).parents().eq(0).attr('id');
	var idLastChild = $('#' + idPaging + ' ul>li:last').attr('id');
	// alert(idLastChild);
	$.post("projek/master-lookup-kuisioner.php", {jenis:'setActiveListPage', paging:idPaging, id_urut:idLastChild})
	$('.addMe').removeClass('active');
	$('#' + idPaging + ' ul>li:last>a.addMe').addClass('active');
	$('.addMePaging').removeClass('active');
	$(this).addClass('active');
});

$('.addMe').click(function(){
	var id = $(this).attr('id');
	var idPaging = $(this).parents().eq(1).attr('id');
	var idLastChild = $(this).parents().eq(0).attr('id');
	/*if($(this).hasClass('active')){
		$(this).removeClass('active');
	}else{*/
		// alert(idPaging + ' ' + idLastChild);
		$.post("projek/master-lookup-kuisioner.php", {jenis:'setActiveListChild', paging:idPaging, id_urut:idLastChild})
		$('.addMe').removeClass('active');
		$(this).addClass('active');
		$('.addMePaging').removeClass('active');
		$('#addMe' + idPaging).addClass('active');
		
	// }
});