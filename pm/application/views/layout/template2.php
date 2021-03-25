<?php echo $this->load->view('layout/header.php'); ?>
	<?php 
if(date('Y-m-d') < $this->session->userdata('tgl_awal')){
	$mtglawal=date_create($this->session->userdata('tgl_awal'));
	$tglawal = date_format($mtglawal,"d M Y");
	echo '
	<div class="text-center" style="margin-top:100px">
		<h3 class="text-success">Jadwal pengisian EPOM akan dibuka pada<br>'.$tglawal.'
	</div>
	';
}else if(date('Y-m-d') >= $this->session->userdata('tgl_akhir')){
	$mtglakhir=date_create($this->session->userdata('tgl_akhir'));
	$tglakhir = date_format($mtglakhir,"d M Y");
	echo '
	<div class="text-center" style="margin-top:100px">
		<h3 class="text-success">Jadwal pengisian EPOM telah berakhir pada<br>'.$tglakhir.'</h3>
	</div>
	';
}else{
	?>
<input type="hidden" name="jmlpertanyaan" id="jmlpertanyaan" value="<?php echo $no-1;?>" />
	<ul class="kotak2" >
		<li class="xheader asbestos">
			<div class="judul" style="font-size: 1em;margin-top: -8px">E P O M<small>Evaluasi Prodi Oleh Mahasiswa</small>
			</div>
		</li>
		<li class="xinfo alizarin" style="font-size:1em">
			<div>
				<b><?php echo $this->session->userdata('namopt');?>/<?php echo $this->session->userdata('nimopt');?></b> 
			</div>
		</li>
		<li class="xinfo midnightblue">
			<div class="imej" style="font-size: 1em;margin-top: -7px">
				<?php echo ($done)?image_asset('icons/w_tick.png','',array('class'=>'icon')):image_asset('icons/con_compose-3.png','',array('class'=>'icon'));?> <?php echo $judulmin;?>
			</div>
		</li>
		<?php // echo $kotak;?>
		
		
		
		<a href="#">
		<li class="xinfo peterriver">
			<div>
				
			</div>
		</li>
		</a>
		<li class="petunjuk alizarin">
			<div class="keterangan">
			<h2>Petunjuk</h2>
			<p>
				Sesuai dengan yang Saudara ketahui, berilah penilaian secara jujur, objektif, dan penuh tanggung jawab terhadap Program Studi. Informasi yang Saudara berikan akan dipergunakan sebagai penilaian kinerja dan sebagai salah satu masukan bagi perbaikan dan peningkatan kualitas Program Studi. Pengisian terhadap evaluasi ini tidak akan berpengaruh apapun terhadap status Saudara sebagai mahasiswa.
                        </p>
			<p> 
				Penilaian dilakukan terhadap aspek-aspek dalam tabel berikut dengan 2 (dua) cara, yaitu :			<br>	
				&emsp;A. klik pilihan skala (1-5).  <br>
				&emsp;&emsp;1 = sangat tidak baik/sangat rendah/tidak pernah<br>
				&emsp;&emsp;2 = tidak baik/rendah/jarang <br>
				&emsp;&emsp;3 = biasa/cukup/kadang-kadang <br>
				&emsp;&emsp;4 = baik/tinggi/sering<br>
				&emsp;&emsp;5 = sangat baik/sangat tinggi/selalu<br>
				&emsp;B. klik pilihan YA atau TIDAK.
				
			</p>
			<p>
				Pengolahan dan Pelaporan data dilakukan oleh PUSAT PENJAMINAN MUTU POLTEKPAR PALEMBANG.
			</p>
			</div>
		</li>
		<li class="quiz midnightblue">
			<form id="quizform" action="<?php echo base_url();?>main_menu/simpanquiz2" method="post" >
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
<?php } ?>

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