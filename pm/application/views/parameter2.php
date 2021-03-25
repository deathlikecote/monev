			<div class="parameter">
				<div class="pertanyaan"><?php echo $no.'. '.$parameter;?> 
				</div>
				<div class="jawabanx">
					<?php 
					switch ($jenis) {
						case 1:

							echo $v1;
							break;
						case 2:

							if ($v1 == 1) {
								echo 'TIDAK';
							} elseif ($v1 == 5) {
								echo 'YA';
							} else {
								echo '(?) TIDAK TERDEFINISI';
							}
								;
							break;
						case 3:
							echo $v1.'%';
						;
						break;

						default:
							
							echo $v3;
							break;
					}
					
					
					
					
					
					
					?>
				</div>				
			</div>
