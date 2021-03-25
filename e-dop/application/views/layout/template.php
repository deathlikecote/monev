<?php echo $this->load->view('layout/header.php'); ?>
<!-- <a href="<?php echo base_url();?>satpam/logout" class="logout peterriver"><br>Logout</a> -->
<input type="hidden" name="jmlpertanyaan" id="jmlpertanyaan" value="<?php echo $no-1;?>" />
	<ul class="kotak2" >
		<li class="xheader asbestos">
			<div class="judul">E D O P<small>Evaluasi Dosen Oleh Prodi</small>
			</div>
		</li>
		<li class="xinfo alizarin">
			<div>
				<b><?php echo $this->session->userdata('namopt');?>/<?php echo $this->session->userdata('nimopt');?> - <?php echo $diisi.'/'.$kewajiban; ?></b> 
			</div>
		</li>
		<li class="xinfo midnightblue">
			<div class="imej">
				<?php echo ($done)?image_asset('icons/w_tick.png','',array('class'=>'icon')):image_asset('icons/con_compose-3.png','',array('class'=>'icon'));?> <?php echo $judulmin;?> - <?php echo $kodemk;?>
			</div>
		</li>
		<?php // echo $kotak;?>
		
		
		
		<a href="<?php echo base_url();?>main_menu/option/<?php echo $this->session->userdata('progs'); ?>/<?php echo $edok; ?>">
		<li class="xinfo peterriver">
			<div>
				PILIH QUIZ
			</div>
		</li>
		</a>
		<li class="petunjuk alizarin">
			<div class="keterangan">
			<h2>Petunjuk</h2>
			<p>
				Sesuai dengan yang Saudara ketahui, berilah penilaian secara jujur, objektif, dan penuh tanggung jawab terhadap dosen Saudara. Informasi yang Saudara berikan akan dipergunakan sebagai penilaian kinerja dosen dan sebagai salah satu masukan bagi perbaikan dan peningkatan kualitas proses belajar mengajar.</p>
			<p> 
				Penilaian dilakukan terhadap aspek-aspek dalam tabel berikut dengan 2 (dua) cara, yaitu :			<br>	
&emsp;A. klik pilihan YA atau TIDAK (score 5 atau 0).  <br>
&emsp;B. isi nilai tanpa menggunakan % (persen).
				
			</p>
			<p>
Pengolahan dan Pelaporan data dilakukan oleh PUSAT PENJAMINAN MUTU POLTEKPAR PALEMBANG.
			</p>
			</div>
		</li>
		<li class="quiz midnightblue">
			<form id="quizform" action="<?php echo base_url();?>main_menu/simpanquiz" method="post" >
				<input type="hidden" name="potensino" id="potensino" value="<?php echo $id;?>" />
				<?php echo $allparam;?>
				<?php if(!$done):?>
				<div class="parameter">
					<div class="komeNsave">
						<textarea name="komentar" class="komentar" placeholder="KOMENTAR"></textarea>
						</br>
						<span>Quizioner belum terisi semua, mohon diisi pertanyaan yang belum terjawab.</span> <button type="submit" id="simpanquiz" name="simpanquiz" value="save" disabled="disabled">SAVE</button>
					</div>
				</div>
				<?php endif;?>
				<!--<button>CANCEL</button>-->
			</form>
		</li>
	</ul>


<script>


	$('li.quiz').find('input.skala').on('click',function(){
		
		$(this).parents('div.parameter').addClass('terjawab');
		$(this).parents('div.parameter').css('border','none');
		
		console.log($('.terjawab').length);

		if ($('.terjawab').length == $('#jmlpertanyaan').val()){
			$('div.komeNsave span').hide();
			$('#simpanquiz').prop('disabled',false);
		}
//		alert($('.terjawab').length);
		
		
	});

	function validasix() {

		$('#simpanquiz').prop('disabled',true);
		return true;
	}

	$("#quizform").ajaxForm({

			beforeSubmit: validasix,
			dataType	: 'json',
			success 	: simpanx 
		});

	function simpanx(data) {

		window.location.href = data.x;
	}

</script>
<?php echo $this->load->view('layout/footer.php'); ?>