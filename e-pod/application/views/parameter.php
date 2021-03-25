			<div class="parameter">
				<div class="pertanyaan"><?php echo $no.'. '.$parameter;?> 
				</div>
				<div class="jawaban">
					<?php 
					switch ($jenis) {
						case 1:

							echo $this->load->view('jenis1');
							break;
						case 2:

							echo $this->load->view('jenis2');
							break;

						default:
							
							echo $this->load->view('jenis3');
							break;
					}
					
					
					
					
					
					
					?>
				</div>				
			</div>
