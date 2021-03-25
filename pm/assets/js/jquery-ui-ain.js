//WIDGET "ain_list 0.1.0" //////////////////////////////////////////////////////
//widget untuk template crud
//created by irfan.muslim@gmail.com
//
//element yang harus di siapkan, diantaranya:
//- <div class="ain_list"> sebagai penampung utama
//- <div class="panelview"> sebagai panampung list
//
//kemabalian dai post dalam render adalah 
//o_json = { 
//				x		= sebagai isi
//				jumlah	= jumlah row yang di tampilkan
//				tot		= total row yang diquery tanpa limit				
//			}
//
//persiapkan juga css untuk class yang sudah didefinisikan
//

$.widget( "custom.ain_maintable", {
	//OPTIONS
	options: {
		version: '0.1.0'
		,class: ''
		,width: '100%'
		,gdetail: 1 //jika 1 ya, jika 0 accordion
	}
	
	,_create:function(){
		
		if (this.options.class === null || this.options.class === ''){
			this.options.class = 'ain_table';
		}
		
//		alert('sdasd');
		
		this.element.addClass(this.options.class);
		
		this.element.find('tr').on('click',function(){
			gdetail();
		});
	}
	
	,gdetail:function(){
		alert('wow!!!');
	}
	
	
});


$.widget( "custom.ain_list", {
	
	//OPTIONS
	options: {
		version: '0.1.0'
		,class: 'ain_list'
		,width: '100%'
		,height: '100%'
		,url_render: '#'
		,url_create: '#'
		,url_detail: '#'
		,show_row: 0
		,total_row: 0
		,gdetail: 1
		,cara_satu: true
		,trklik: true
		,autoshow: true
		,tr_onClick: null
		,tr_onDelete: null
		//OPT_FILTER
		,filter: {
			limit: 5
			,offset: 0
			,cari: ''
			,prodi: ''
			,semester: 0
	//		,sortdir: "desc"
		}
		//END OF OPT_FILTER
	}
	//END OF OPTION
	
	,setFilters: function(datafilters){
		
		this._setOption('filter',datafilters);		
	}
	
	,_but_prev_stat: function(){
		
		if ( this.options.filter.offset >= this.options.filter.limit ) {
			
			this.element.find('.butprev').removeAttr('disabled');
		}else{
			
			this.element.find('.butprev').attr('disabled','disabled'); 
		}		
	}
	
	,_but_next_stat: function(){
		
		if ( this.options.filter.limit+this.options.filter.offset >= this.options.total_row ) {
			
			this.element.find('.butnext').attr('disabled','disabled'); 
		}else{
			
			this.element.find('.butnext').removeAttr('disabled');
		}		
	}
	
	,_move_prev: function(){
				
		this.options.filter.offset -= this.options.filter.limit;					
		this.render();
	}
	
	,_move_next: function(){
				
		this.options.filter.offset += this.options.filter.limit;					
		this.render();
	}
	
	,_limit_change: function(val){
		
		this._setFilter('limit',parseInt(val));			
		this.refresh2();
	}
	
	,_semester_change: function(val){
		
//		alert(val);
		this._setFilter('semester',parseInt(val));			
		this.refresh2();
	}
	
	,refresh: function(){
		
		this.element.find('.cari').val('');
		this._setFilter('offset',0);
		this._setFilter('cari','');
		this.render();
	}
	
	,refresh2: function(){
		
//		this.element.find('.cari').val('');
		this._setFilter('offset',0);
//		this._setFilter('cari','');
		this.render();
	}
	
	,_setFilter: function( key, value ){

		if ( key === "cari" ) {
			this.options.filter.cari = value;
			return true;
		}
		
		if ( key === "offset" ) {
			this.options.filter.offset = value;
			return true;
		}			
		
		if ( key === "limit" ) {
			this.options.filter.limit = value;
			return true;
		}			
		
		if ( key === "prodi" ) {
			this.options.filter.prodi = value;
			return true;
		}			
		
		if ( key === "semester" ) {
			this.options.filter.semester = value;
			return true;
		}			
		
		return false;
	}
		
	//INISIALISASI
	,_create: function() {
		var ieu = this;
		var ieu_el = this.element;
		var ieu_opt = this.options;
		
//		console.log('create.ain_list');
		
		ieu_el.addClass( this.options.class );
		ieu_el.css( 'margin-right', '0px');
//		ieu_el.css( 'height', this.options.height );
		ieu_el.find('.sellimit').val( this.options.filter.limit );
		ieu_el.find('.selsem').val( this.options.filter.semester );
		this.render();
		
//		ieu_el.find('.but_del').on('click',function(event){
//			event.preventDefault();
//			ieu._move_next();
//		});
		
		ieu_el.find('.butnext').on('click',function(event){
			event.preventDefault();
			ieu._move_next();
		});
		
		ieu_el.find('.butprev').on('click',function(event){
			event.preventDefault();
			ieu._move_prev();
		});
		
		ieu_el.find('.cari').on('keyup',function(event){
			
			event.preventDefault();
//			alert('cari');
			ieu._setFilter('cari',$(this).val());			
			ieu._setFilter('offset',0);
			ieu.render();
		});
		
		ieu_el.find('.butclear').on('click',function(event){
			event.preventDefault();
			ieu.refresh();
		});
		
		ieu_el.find('.sellimit').on('change',function(event){
			event.preventDefault();
			ieu._limit_change($(this).val());
		});		
		
		ieu_el.find('.selsem').on('change',function(event){
			event.preventDefault();
			ieu._semester_change($(this).val());
		});		
		
		$('.selprodi').on('change',function(){
			event.preventDefault();
			ieu._setFilter('prodi',$(this).val());			
			ieu.refresh2();
		})
		
		$(window).resize(function(){
			ieu.resize_panelview();
		});
		
		if (ieu_opt.autoshow) {
			ieu_el.show();
		}

	}
	//END OF INISIALISASI

	,resize_panelview:function(){
		
		var tinggiW = $(window).height();
		var topPV = this.element.find('.panelviewheader').offset().top;
		var bottomPV = 105;
//		console.log(tinggiW+'-'+ topPV+'-'+ bottomPV);
//		console.log(tinggiW-topPV-bottomPV);
		this.element.find('.panelview').height(tinggiW-topPV-bottomPV);		
//		this.element.find('.panelview').height('300px');		
//		var panelwidth = this.element.find('.panelview').width();
//		console.log(panelwidth);
//		if (panelwidth < 500) {
//			$('.autohide').hide();
//		}else{
//			$('.autohide').show();			
//		} 		
	}	
		
	//RENDER DATATABLE
	,render: function() {
		
		var ieu = this;
		var ieu_el = this.element;
		var ieu_opt = this.options;
			
		$.post(this.options.url_render, this.options.filter,function( o_json ) {
			
//			console.log(ieu.options.filter);
			//isi panel
			
			if (o_json.x === 'DATA BELUM ADA') {
				ieu_el.find('.panelview').html('');			
			}else{
				ieu_el.find('.panelview').html(o_json.x);							
			}
			ieu_el.find('.panelviewheader').html(o_json.x);
			ieu._setOption( 'show_row', o_json.jumlah );			
			ieu._setOption( 'total_row', o_json.tot );			
			ieu._but_prev_stat();
			ieu._but_next_stat();
			ieu.resize_panelview();
			var tinggi = ieu_el.find('.panelview table thead').height();
			ieu_el.find('.panelview table').css('margin-top',-tinggi);
			ieu_el.find('.panelviewheader').css('height',tinggi);
			
			ieu_el.find('.panelview table tbody tr .but_del').on('click',function(event){
				  
				if (ieu_opt.tr_onDelete) {
					ieu_opt.tr_onDelete( event, this);
				}else{
					ieu._tr_onDelete();
				}
			});
			
			ieu_el.find('.panelview table tbody tr').on('click',function(event){
				event.preventDefault();
				
//				console.log(this);
		
				ieu_el.find('.panelview table tbody tr').removeClass('current_maintr');
				$(this).addClass('current_maintr');

				if (ieu_opt.tr_onClick) {
					ieu_opt.tr_onClick( event, this);
				}else{
					ieu._tr_onClick();
				}
 
//				
//				var idtr = $(this).attr('id');
//				ieu.render_detail(idtr);
			});
		
		}, 'json' );

	}
	//END OF RENDER DATATABLE
	
	,_tr_onClick:function(){
	}
	
	,_tr_onDelete:function(){
	}
	
	,render_detail:function(idtr){
		
		$.post(this.options.url_detail,{'id':idtr},function( o_json ) {
			
			LAYOUT.ain_layout('set_detail',o_json.x);	
			
		},'json');		
	}
});
//END OF WIDGET "ain_list 0.1.0"

$.widget( "custom.ain_list_detail", {
	
	//OPTIONS
	options: {
		
		version: '0.1.0'
		,class: 'ain_list_detail'
		,width: '550px'
		,height: '100%'
		,url_render: '#'
		,url_create: '#'
		,url_detail: '#'
		,show_row: 0
		,total_row: 0
		,gdetail: 1
		,cara_satu: true
		,trklik: true
		,autoshow: true
		,tr_onClick: null
		,tr_onDelete: null
		//OPT_FILTER
		,filter: {
			nim: null
			,limit: 5
			,offset: 0
			,cari: ''
	//		,sortby: null
	//		,sortdir: "desc"
		}
		//END OF OPT_FILTER
	}
	//END OF OPTION
	
	,_but_prev_stat: function(){
		
		if ( this.options.filter.offset >= this.options.filter.limit ) {
			
			this.element.find('.butprev').removeAttr('disabled');
		}else{
			
			this.element.find('.butprev').attr('disabled','disabled'); 
		}		
	}
	
	,_but_next_stat: function(){
		
		if ( this.options.filter.limit+this.options.filter.offset >= this.options.total_row ) {
			
			this.element.find('.butnext').attr('disabled','disabled'); 
		}else{
			
			this.element.find('.butnext').removeAttr('disabled');
		}		
	}
	
	,_move_prev: function(){
				
		this.options.filter.offset -= this.options.filter.limit;					
		this.render();
	}
	
	,_move_next: function(){
				
		this.options.filter.offset += this.options.filter.limit;					
		this.render();
	}
	
	,_limit_change: function(val){
		
		this._setFilter('limit',parseInt(val));			
		this.refresh2();
	}
	
	,refresh: function(){
		
//		this.element.find('.cari').val('');
		this._setFilter('offset',0);
		this._setFilter('cari','');
		this.render();
	}
	
	,refresh2: function(){
		
//		this.element.find('.cari').val('');
		this._setFilter('offset',0);
//		this._setFilter('cari','');
		this.render();
	}
	
	,_setFilter: function( key, value ){

		if ( key === "cari" ) {
			this.options.filter.cari = value;
			return true;
		}
		
		if ( key === "offset" ) {
			this.options.filter.offset = value;
			return true;
		}			
		
		if ( key === "limit" ) {
			this.options.filter.limit = value;
			return true;
		}			
		
		return false;
	}
		
	//INISIALISASI
	,_create: function() {
		
		var ieu = this;
		var ieu_el = this.element;
		var ieu_opt = this.options;
		
//		console.log('create.ain_list');
		
		ieu_el.addClass( this.options.class );
		ieu_el.css( 'margin-right', '0px');
//		ieu_el.css( 'height', this.options.height );
		ieu_el.find('.sellimit').val( this.options.filter.limit );
		this.render();
		
		ieu_el.find('.but_del').on('click',function(event){
			event.preventDefault();
//			ieu._move_next();
		});
		
		ieu_el.find('.butnext').on('click',function(event){
			event.preventDefault();
			ieu._move_next();
		});
		
		ieu_el.find('.butprev').on('click',function(event){
			event.preventDefault();
			ieu._move_prev();
		});
		
		ieu_el.find('.cari').on('keyup',function(event){
			event.preventDefault();
			ieu._setFilter('cari',$(this).val());			
			ieu.render();
		});
		
		ieu_el.find('.butclear').on('click',function(event){
			event.preventDefault();
			ieu.refresh();
		});
		
		ieu_el.find('.sellimit').on('change',function(event){
			event.preventDefault();
			ieu._limit_change($(this).val());
		});		
		
		$(window).resize(function(){
			ieu.resize_panelview();
		});

		if (ieu_opt.autoshow) {
			LAYOUT.ain_layout('open_detail');
		}
	}
	//END OF INISIALISASI

	,resize_panelview:function(){
		var tinggiW = $(window).height();
		var topPV = this.element.find('.panelviewheader').offset().top;
		var bottomPV = 60;
//		console.log(tinggiW+'-'+ topPV+'-'+ bottomPV);
//		console.log(tinggiW-topPV-bottomPV);
		this.element.find('.panelview').height(tinggiW-topPV-bottomPV);		
	}	
		
	//RENDER DATATABLE
	,render: function() {
		var ieu = this;
		var ieu_el = this.element;
		var ieu_opt = this.options;
		
//		this.element.width(this.options.width);

//		console.log(this.options.url_render);
//		console.log(this.options.filter);
		$.post(this.options.url_render, this.options.filter,function( o_json ) {
//			alert('cerate detail table');
			
			//isi panel
			ieu_el.find('.panelview').html(o_json.x);
			ieu_el.find('.panelviewheader').html(o_json.x);
			ieu._setOption( 'show_row', o_json.jumlah );			
			ieu._setOption( 'total_row', o_json.tot );			
			ieu._but_prev_stat();
			ieu._but_next_stat();
			ieu.resize_panelview();
			var tinggi = ieu_el.find('.panelview table thead').height();
			ieu_el.find('.panelview table').css('margin-top',-tinggi);
			ieu_el.find('.panelviewheader').css('height',tinggi);
							
				ieu_el.find('.panelview table tbody tr td input').on('focus',function(event){
					ieu_el.find('.panelview table tbody tr').removeClass('current_abshari');
					$(this).parent('td').parent('tr').addClass('current_abshari');
				});
				
				ieu_el.find('.panelview table tbody tr td').on('click',function(){
					if ($(this).has('input').length > 0 && $('.butsave').is(':hidden')){
						var ieutd = $(this);
						$.post('satpam/cek_edit_nilai',function(data){
							console.log(data);
							if (data.x){

								$('.butsave').show();
								$('.butcancel').show();

								koloma = ieutd.attr('class');
								$('.inputnilai').prop('disabled',true);
								ieu_el.find('.panelview table tbody tr td.'+koloma+' input').prop('disabled',false);					
								ieutd.find('input').focus();							
							}
						},'json');						
					}
				});
				
				ieu_el.find('.panelview table tbody tr td input').on('focusout',function(event){
					
					xxx = $(this).val().split('.');
					
					if (xxx.length === 1) {
				
						if ($(this).val() !== ''){
							
							$(this).val($(this).val()+'.00');							
						}
					}
					
					if (xxx.length === 2) {
						
						if (xxx[1].length === 0){
							
							$(this).val($(this).val()+'00');
						}
						
						if (xxx[1].length === 1){
							
							$(this).val($(this).val()+'0');
						}
					}					
				});
				
				ieu_el.find('.panelview table tbody tr td input').keyup(function(){
					
					if (event.which !== 8 && event.which !== 46 && event.which !== 37 && event.which !== 39 ){
											
						//number only
						$(this).val($(this).val().replace(/[^0-9\.]/g,''));

						//jika 00

						var xxx = $(this).val().split('.');

						if (xxx.length === 1) {

							if( (xxx[0].length) > 1){

								$(this).val($(this).val().slice(0,-1));						
							}

							if (parseInt(xxx[0]) > 4) {

								$(this).val('');	
							}
						}else if( xxx.length === 2){

							if( (xxx[1].length) > 2){

								$(this).val($(this).val().slice(0,-1));
							}						

							if (parseInt(xxx[0]) === 4){
								$(this).val(xxx[0]+'.00');
							}

							if (parseInt(xxx[0]) > 4) {

								$(this).val('');	
							}

						}else if( xxx.length > 2){

							$(this).val($(this).val().slice(0,-1));						
						}					
					}
				});
				
				ieu_el.find('.panelview table tbody tr td input').keydown(function(){
					
					koloma = $(this).attr('class');
															
					if ( event.which === 38 ) {
						$(this).parent().parent().prev().find('.inputnilai').focus();
					}					
					
					if ( event.which === 40 || event.which === 13 ) {
						$(this).parent().parent().next().find('.inputnilai').focus();
					}					
				});
				
					if (ieu_opt.trklik){
				ieu_el.find('.panelview table tbody tr').on('click',function(event){
					event.preventDefault();

					ieu_el.find('.panelview table tbody tr').removeClass('current_abshari');
					$(this).addClass('current_abshari');

					if (ieu_opt.tr_onClick) {
						ieu_opt.tr_onClick( event, this);
					}else{
//						ieu._tr_onClick();
						if (ieu.options.cara_satu) {
							ieu.render_detail2($(this));				
						}else{
							ieu.render_detail($(this));				
						}	
					}
				});
					}					
		}, 'json' );
				
	}
	//END OF RENDER DATATABLE
	
	,render_detail:function(ieu){
		
		$.post(this.options.url_detail,{'id':ieu.attr('id')},function( o_json ) {
			
			LAYOUT.ain_layout('set_detail',o_json.x);			
		},'json');		
	}
	
	,render_detail2:function(ieu){
		
		$.post( this.options.url_detail, {'id':ieu.attr('id')}, function(data){
					$('.trdetail').remove().fadeOut();
					ieu.after("<tr class='trdetail' style='display:none;'><td  colspan=6>"+data.x+"</td></tr>");
					$('.trdetail').fadeIn();
		},'json');
	}
	
	,_tr_onClick:function(){
	}
	
	,_tr_onDelete:function(){
	}
		
});

//widget untuk menu utama
$.widget( "custom.ain_oview", {
	
	//OPTIONS
	options: {
		version: '0.1.0'
		,class: 'ain_oview'
		,width: '100%'
		,height: '100%'
	}
	
	,_create:function(){

		var el_ieu = this.element;
		
			if (el_ieu.width() <= 1000){
				el_ieu.css('height',140);
				el_ieu.find('div').css('padding',5);
				
//				console.log(el_ieu.width()+' x '+el_ieu.height());
			} else {
				el_ieu.find('div').css('padding',10);
				el_ieu.css('height',70);
				
			}

		
//		$(window).resize(function(){
//			if (el_ieu.width() <= 1000){
//				el_ieu.css('height',140);
//				el_ieu.find('div').css('padding',5);
//				
////				console.log(el_ieu.width()+' x '+el_ieu.height());
//			} else {
//				el_ieu.find('div').css('padding',10);
//				el_ieu.css('height',70);
//				
//			}
//		});
				
		this.element.find('.headbox').on('click',function(event){
			event.preventDefault();
			$(this).html('oooop');
		});
	}
});

//widget untuk Layout
$.widget( "custom.ain_layout", {
	
	//OPTIONS
	options: {
		version: '0.1.0'
		,class: 'ain_layout'
		,url_cont: ''
		,coklik: null
	}
	
	,navsec: null
	,mainsec:null
	,detailsec:null
	,contsec:null
	
	,_create:function(){
		
		var ieu = this;
		var op_ieu = this.options;
		this.element.find('#navsection');
		this.element.find('#contsection');
		this.element.find('#mainsection');
		
		this.element.addClass('layout');
		
		//first generate ain_list
		this.element.find('#mainsection').ain_list();
		
		//event click on li
		this.element.find('#navsection').find('li').on('click',function(){
						
			var li_ieu = $(this);			
			
			ieu.element.find('#navsection').find('li').removeClass('current_li');
			li_ieu.addClass('current_li');
			$.post(op_ieu.url_cont,{'idli':li_ieu.attr('id')}, function(data){
				ieu.set_cont(data.x);
			},'json');		
			ieu.element.find('#detailsection').hide();			
			ieu.element.find('#mainsection').css('margin-right',0);

		});
				
		var pertama = this.element.find('#navsection').find('li').first();
		pertama.click();
				
		this.element.find('#navsection').find('.contoh').on('click',function(){
			ieu.contohonClick();			
		})
		
	}
		
	,contohonClick:function(){
		if (this.options.coklik){
			this.options.coklik();
		}else{
//			alert('contoh');		
		}
	}	
		
	,resize_layout:function(){
		
		if (this.element.find('#detailsection').outerWidth()) {
			
			marginR = this.element.find('#detailsection').outerWidth()+10;
			this.element.find('#mainsection').css('margin-right',marginR);						
		}		
	}	
		
	,set_main:function(x){
		
		this.element.find('#mainsection').html(x);
	}	
	
	,set_cont:function(x){
		
		this.element.find('#contsection').html(x);
	}	
	
	,set_detailWidth: function(lebar){
		
		this.element.find('#detailsection').width(lebar);
		this.open_detail();
	}
	
	,set_detailLeft: function(marginL){
		
		this.element.find('#detailsection').css('left',marginL);
		this.open_detail();
	}
	
	,set_detailRight: function(marginR){
		
		this.element.find('#detailsection').css('right',marginR);
		this.open_detail();
	}
	,set_detail:function(x){
		
		this.element.find('#detailsection').html(x);
		this.open_detail();
	}	
	
	,close_nav:function(){
		
		this.element.find('#navsection').hide();
		this.element.find('#mainsection').css('margin-left',0);
	}	
	
	,close_detail:function(){
		
		this.element.find('#detailsection').hide();
		this.element.find('#mainsection').css('margin-right',0);
	}	
	
	,open_nav:function(){
		
		this.element.find('#navsection').show();
		var marginL = this.element.find('#navsection').outerWidth();
		this.element.find('#mainsection').css('margin-left',marginL);		
	}
	
	,open_detail:function(){
		
		this.element.find('#detailsection').show();
		var marginR = this.element.find('#detailsection').outerWidth()+10;
		this.element.find('#mainsection').css('margin-right',marginR);		
	}
});

