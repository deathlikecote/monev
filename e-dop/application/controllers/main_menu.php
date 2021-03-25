<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_menu extends MY_Controller {

	private $_asset_string = '';

	public function __construct(){

		parent::__construct();
		$this->session->sess_cek_action();
		
		//INISIALISASI $_asset_string
		$this->_asset_string = '';
		
		//> CSS
		$this->_asset_string .= css_asset('colors.css');
		$this->_asset_string .= css_asset('style_main_menu.css');
		
		//> JS
		$this->_asset_string .= js_asset('jquery-1.8.3.min.js');
		$this->_asset_string .= js_asset('jquery.form.js');
		$this->_asset_string .= js_asset('jquery-ui-1.9.2.custom.min.js');		
		$this->_asset_string .= js_asset('helper.js');
		$this->_asset_string .= js_asset('main.js');
	}

	public function testdeui() {
		$this->load->model('tahunakademik_model');
		$que = $this->tahunakademik_model->get_thakd();
		if ($que->num_rows() > 0) {
			$x = $que->row_array();
			echo $x['thn_akademik'];
		} else{
			echo 'teu aya';
		}
	}


	public function index() {
		
		$this->x='10';
		$data['assets'] = $this->_asset_string;

		$this->load->model('edompotensi_model','edompotensi');			
		$que = $this->edompotensi->daftar_get(NULL,NULL,'nim = '.$this->session->userdata('nimopt'));

		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;

		if ($data['kewajiban']) {				

			foreach ($que->result_array() as $x) {

				$data['kotak'] .= $this->load->view('kotak',$x,TRUE);

				if ($x['done']) {
					$data['diisi'] ++;
				}
			}
		}

		$this->load->view('main_menu',$data);
	}

	public function nim2( $nim, $xxx) {

		$data['wow'] = '';
		if (md5(date('hyhdhmhyhmhdhhh').$nim) == $xxx) {

			$data['wow'] = '.';			
		}

		$data['assets'] = $this->_asset_string;
		$this->load->model('edompotensi_model','edompotensi');			
		$que = $this->edompotensi->daftar_get( NULL, NULL, 'nim = '.$nim, NULL, 'done asc');
		
		$this->load->model('epompotensi_model','epompotensi');			
		$que2 = $this->epompotensi->daftar_get( NULL, NULL, 'nim = '.$nim, NULL, 'done asc');
		
		$data['kelas'] = '-';
		$data['idprogstudi'] = '';
			
		if($que->num_rows()){
		  $row = $que->row(); 			
		  $data['kelas'] = $row->kelas;
		  $data['idprogstudi'] = $row->idprogstudi;
		}

		if($que2->num_rows()){
		  $row = $que->row(); 			
		  $data['kelas'] = $row->kelas;
		  $data['idprogstudi'] = $row->idprogstudi;
		}

		$data['kotak'] = '';
		$data['kewajiban_edom'] = $que->num_rows();
		$data['kewajiban_epom'] = $que2->num_rows();
		$data['diisi'] = 0;
		$data['nim'] = $nim;
		$data['xxx'] = $xxx;

		$this->load->view('main_menu2',$data);
	}
	
	public function option($nim, $xxx) {
		
		$data['wow'] = '';
		if (md5(date('hyhdhmhyhmhdhhh').$nim) == $xxx) {
			
			$data['wow'] = '.';			
		}
		
		$data['assets'] = $this->_asset_string;
		$this->load->model('edoppotensi_model','edoppotensi');			
		$que = $this->edoppotensi->daftar_get( NULL, NULL, 'idprogstudi = "'.$nim.'"', NULL, 'done_d asc, kodedosen asc');

		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;
		$data['nim'] = $nim;
		$data['xxx'] = $xxx;
		
		if ($data['kewajiban']) {				

			foreach ($que->result_array() as $x) {

				$data['kotak'] .= $this->load->view('kotak',$x,TRUE);

				if ($x['done_d']) {
					$data['diisi'] ++;
				}
			}
			$this->load->view('main_menu',$data);
		} else {
			redirect('../../../evaluasi/main.php');
		}
	}
	
	public function nim( $nim, $xxx ) {
					
		$data['wow'] = '';
		if (md5(date('hyhdhmhyhmhdhhh').$nim) == $xxx) {
			
			$data['wow'] = '.';			
		}
		
		$data['assets'] = $this->_asset_string;
		$this->load->model('edompotensi_model','edompotensi');			
		$que = $this->edompotensi->daftar_get( NULL, NULL, 'nim = '.$nim, NULL, 'done asc');

		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;
		$data['nim'] = $nim;
		$data['xxx'] = $xxx;
		
		if ($data['kewajiban']) {				

			foreach ($que->result_array() as $x) {

				$data['kotak'] .= $this->load->view('kotak',$x,TRUE);

				if ($x['done']) {
					$data['diisi'] ++;
				}
			}
			$this->load->view('main_menu',$data);
		} else {
			redirect('maaf');
		}
	}

	public function quiz($id) {
		
		$data['assets'] = $this->_asset_string;
		$this->load->model('edoppotensi_model','edoppotensi');			
		$que = $this->edoppotensi->daftar_get( NULL, NULL, 'idprogstudi = "'.$this->session->userdata('progs').'"', NULL, 'done_d asc');
		
		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;
		$data['edok'] = md5(date('hyhdhmhyhmhdhhh').$this->session->userdata('nimopt'));
		
		if ($data['kewajiban']) {				

			foreach ($que->result_array() as $x) {
				
				if ($x['id'] == $id) {
					
					$x['class_selected'] = 'midnightblue';
					$data['judulmin'] = $x['kodedosen'];
					$data['kodemk'] = $x['kodemk'];
					$data['done_d'] = $x['done_d'];
					$data['id'] = $x['id'];
					
					if ($x['done_d']) {
						
						$this->load->model('edopdata_model','edopdata');			
						$que2 = $this->edopdata->daftar_get( NULL, NULL, 'id_potensi = '.$id, NULL, 'aspek asc');
						
						$data['allparam'] = '';
						if ($que2->num_rows() > 0) {

							$aspek = '';
							$no = 1;
							foreach ($que2->result_array() as $parameter) {

								if ($aspek != $parameter['aspek']) {

									$aspek = $parameter['aspek'];
									$data['allparam'] .= $this->load->view('aspek', $parameter, TRUE);
								}

								$parameter['no'] = $no;
								$data['allparam'] .= $this->load->view('parameter2', $parameter, TRUE);

								$no++;
							}
						}
						
					} else {
						
						$this->load->model('edopparameter_model','edopparameter');			
						$que2 = $this->edopparameter->daftar_get(NULL,NULL,'deleted = 0 and hide = 0',NULL,'aspek asc');

						$data['allparam'] = '';
						if ($que2->num_rows() > 0) {

							$aspek = '';
							$no = 1;
							foreach ($que2->result_array() as $parameter) {

								if ($aspek != $parameter['aspek']) {

									$aspek = $parameter['aspek'];
									$data['allparam'] .= $this->load->view('aspek', $parameter, TRUE);
								}

								$parameter['no'] = $no;
								$data['allparam'] .= $this->load->view('parameter', $parameter, TRUE);

								$no++;
							}
						}
					}					
				}
				
				if ($x['done_d']) {
					$data['diisi'] ++;
				}
			}
			
			$data['no'] = $no;			
			$this->load->view('layout/template',$data);
		} else {
			redirect('maaf');
		}		
	}

	public function simpanquiz() {
		
		$idpote = $_POST['potensino'];
		$this->load->model('edoppotensi_model','edoppotensi');
		$arrupdate = array('done_d' => 1, 'komentar_d' => $_POST['komentar']);		
		$this->edoppotensi->ubah($idpote,$arrupdate);
		
		$que = $this->edoppotensi->daftar_get(NULL,NULL,'id = '.$idpote,NULL,NULL,1);
		
		if ($que->num_rows() > 0) {
			
			$rowpotensi = $que->row_array();
						
			$this->load->model('edopparameter_model','edopparameter');			
			$que2 = $this->edopparameter->daftar_get(NULL,NULL,'deleted = 0 and hide = 0',NULL);
			
			if ($que2->num_rows() > 0) {
				
				$arrparameter = $que2->result_array();
				
				$cekaspek = '';
				$ctotal = 0;
				$cpembagi = 0;
				$i = 0;
				foreach ( $arrparameter as $x) {
					
					if ($cekaspek != $x['aspek']) {	
						
						if ($cekaspek != ''){
							$arr_sa[$i] = $ctotal/$cpembagi;
							$i++;
						}
						
						$ctotal = 0;
						$cpembagi = 0;
						$cekaspek = $x['aspek'];
					}
					
					$arritem = array();
					$arritem['id_potensi'] = $rowpotensi['id'];
					
					$arritem['v1'] = $_POST['jawab_'.$x['id']];
					if($x['jenis']!='3'){
						$ctotal += $arritem['v1'];
						$cpembagi++;
					}else{

					}
					


					// tambahan kode agar tidak update edopdata		
					//-------------------			
					$queh = $this->edoppotensi->daftarmhsedop_get($rowpotensi['id']);
					foreach ($queh->result_array() as $row)
					{
					        $arritem['kodedosen'] 	= $row['kodedosen'];
					        $arritem['idprogstudi'] = $row['idprogstudi'];
					        $arritem['kodedp'] 		= $row['kodedp'];
					        $arritem['kedop'] 		= $row['kedop'];
					}
					//-------------------	
////					switch ($x['jenis']) {
////						case 1:
////							$arritem['v1'] = $_POST['jawab_'.$x['id']];
////							break;
////						case 2:
////							$arritem['v2'] = $_POST['jawab_'.$x['id']];
////							break;
////						default:
////							$arritem['v3'] = $_POST['jawab_'.$x['id']];
////							break;
////					}					
//					
					foreach ($x as $key => $value) {
						
						if ($key == 'id') {
							
							$arritem['id_parameter'] = $value;
						}else{
							
							if ($key == 'parameter' || $key == 'aspek' || $key == 'jenis'){
								
								$arritem[$key] = $value;
							}
						}
					}		
					
					$this->load->model('edopdata_model','edopdata');			
					$this->edopdata->simpan($arritem);
				}
				
				$arr_sa[$i] = $ctotal/$cpembagi;
				$spote = array_sum($arr_sa)/count($arr_sa);
				
				$this->edoppotensi->ubah($idpote,array('spote_d'=>$spote));
				
			}			
		}
//		$rowpotensi['nim'] = 'MDK';
		$arrjson['x'] = base_url().'main_menu/option/'.$rowpotensi['idprogstudi'].'/'.md5(date('hyhdhmhyhmhdhhh').$rowpotensi['idprogstudi']);				
		echo json_encode($arrjson);	
	}
	public function quiz2() {
		
		$data['assets'] = $this->_asset_string;
		$this->load->model('epompotensi_model','epompotensi');			
		$que = $this->epompotensi->daftar_get( NULL, NULL, 'nim = '.$this->session->userdata('nimopt'), NULL, 'done asc');
		
		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;
		$data['edok'] = md5(date('hyhdhmhyhmhdhhh').$this->session->userdata('nimopt'));
		
		if ($data['kewajiban']) {				
                    $x = $que->row_array();
				
					
                    $x['class_selected'] = 'midnightblue';
                    $data['judulmin'] = $x['idprogstudi'];
//                    $data['kodemk'] = $x['kodemk'];
                    $data['done'] = $x['done'];
                    $data['id'] = $x['id'];

                    if ($x['done']) {

                            $this->load->model('epomdata_model','epomdata');			
                            $que2 = $this->epomdata->daftar_get( NULL, NULL, 'id_potensi = '.$x['id'], NULL, 'aspek asc');

                            $data['allparam'] = '';
                            if ($que2->num_rows() > 0) {

                                    $aspek = '';
                                    $no = 1;
                                    foreach ($que2->result_array() as $parameter) {

                                            if ($aspek != $parameter['aspek']) {

                                                    $aspek = $parameter['aspek'];
                                                    $data['allparam'] .= $this->load->view('aspek', $parameter, TRUE);
                                            }

                                            $parameter['no'] = $no;
                                            $data['allparam'] .= $this->load->view('parameter2', $parameter, TRUE);

                                            $no++;
                                    }
                            }

                    } else {

                            $this->load->model('epomparameter_model','epomparameter');			
                            $que2 = $this->epomparameter->daftar_get(NULL,NULL,'deleted = 0 and hide = 0',NULL,'aspek asc');

                            $data['allparam'] = '';
                            if ($que2->num_rows() > 0) {

                                    $aspek = '';
                                    $no = 1;
                                    foreach ($que2->result_array() as $parameter) {

                                            if ($aspek != $parameter['aspek']) {

                                                    $aspek = $parameter['aspek'];
                                                    $data['allparam'] .= $this->load->view('aspek', $parameter, TRUE);
                                            }

                                            $parameter['no'] = $no;
                                            $data['allparam'] .= $this->load->view('parameter', $parameter, TRUE);

                                            $no++;
                                    }
                            }
                    }					


                    $data['no'] = $no;			
                    $this->load->view('layout/template2',$data);
		} else {
                    redirect('maaf');
		}		
	}
        
	public function simpanquiz2() {
		
		$idpote = $_POST['potensino'];
		$this->load->model('epompotensi_model','epompotensi');
		$arrupdate = array('done' => 1, 'komentar' => $_POST['komentar']);		
		$this->epompotensi->ubah($idpote,$arrupdate);
		
		$que = $this->epompotensi->daftar_get(NULL,NULL,'id = '.$idpote,NULL,NULL,1);
		
		if ($que->num_rows() > 0) {
			
			$rowpotensi = $que->row_array();
						
			$this->load->model('epomparameter_model','epomparameter');			
			$que2 = $this->epomparameter->daftar_get(NULL,NULL,'deleted = 0 and hide = 0',NULL,'aspek asc');
			
			if ($que2->num_rows() > 0) {
				
				$arrparameter = $que2->result_array();
				
				
				$cekaspek = '';
				$ctotal = 0;
				$cpembagi = 0;
				$i = 0;
				foreach ( $arrparameter as $x) {
					
					if ($cekaspek != $x['aspek']) {	
						
						if ($cekaspek != ''){
							$arr_sa[$i] = $ctotal/$cpembagi;
							$i++;
						}
						
						$ctotal = 0;
						$cpembagi = 0;
						$cekaspek = $x['aspek'];
					}
					
					$arritem = array();
					$arritem['id_potensi'] = $rowpotensi['id'];
					
					$arritem['v1'] = $_POST['jawab_'.$x['id']];
					$ctotal += $arritem['v1'];
					$cpembagi++;
					
//					switch ($x['jenis']) {
//						case 1:
//							$arritem['v1'] = $_POST['jawab_'.$x['id']];
//							break;
//						case 2:
//							$arritem['v2'] = $_POST['jawab_'.$x['id']];
//							break;
//						default:
//							$arritem['v3'] = $_POST['jawab_'.$x['id']];
//							break;
//					}					
					
					foreach ($x as $key => $value) {
						
						if ($key == 'id') {
							
							$arritem['id_parameter'] = $value;
						}else{
							
							if ($key == 'parameter' || $key == 'aspek' || $key == 'jenis'){
								
								$arritem[$key] = $value;
							}
						}
					}		
					
					$this->load->model('epomdata_model','epomdata');			
					$this->epomdata->simpan($arritem);
				}
				
				$arr_sa[$i] = $ctotal/$cpembagi;
				$spote = array_sum($arr_sa)/count($arr_sa);
				
				$this->epompotensi->ubah($idpote,array('spote'=>$spote));
			}			
		}
		
		$arrjson['x'] = base_url().'main_menu/nim2/'.$rowpotensi['nim'].'/'.md5(date('hyhdhmhyhmhdhhh').$rowpotensi['nim']);				
		echo json_encode($arrjson);	
	}
}

/* End of file main_menu.php */
/* Location: ./application/controllers/main_menu.php */