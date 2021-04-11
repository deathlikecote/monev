<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_menu extends MY_Controller
{

	private $_asset_string = '';

	public function __construct()
	{

		parent::__construct();
		$this->session->sess_cek_action();

		//INISIALISASI $_asset_string
		$this->_asset_string = '';
		$this->load->model('edomuser_model', 'user');
		//> CSS
		$this->_asset_string .= css_asset('colors.css');
		$this->_asset_string .= css_asset('style_main_menu.css');
		$this->_asset_string .= css_asset('bootstrap/css/bootstrap.css');
		$this->_asset_string .= css_asset('bootstrap/slider/responsiveslides.css');
		$this->_asset_string .= css_asset('bootstrap/slider/demo/demo.css');

		//> JS
		$this->_asset_string .= js_asset('js/jquery-3.2.1.js');
		$this->_asset_string .= js_asset('js/bootstrap.min.js');
		$this->_asset_string .= js_asset('jquery-ui-1.9.2.custom.min.js');
		$this->_asset_string .= js_asset('helper.js');
		$this->_asset_string .= js_asset('main.js');
		$this->_asset_string .= js_asset('jquery-1.8.3.min.js');
		$this->_asset_string .= js_asset('jquery.form.js');
		$this->_asset_string .= js_asset('responsiveslides.min.js');
	}

	public function testdeui()
	{
		$this->load->model('tahunakademik_model');
		$que = $this->tahunakademik_model->get_thakd();
		if ($que->num_rows() > 0) {
			$x = $que->row_array();
			echo $x['perta'];
		} else {
			echo 'teu aya';
		}
	}


	public function index()
	{

		$this->x = '10';
		$data['assets'] = $this->_asset_string;

		$this->load->model('edompotensi_model', 'edompotensi');
		$que = $this->edompotensi->daftar_get(NULL, NULL, 'nim = ' . $this->session->userdata('nimopt'));

		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;

		if ($data['kewajiban']) {

			foreach ($que->result_array() as $x) {

				$data['kotak'] .= $this->load->view('kotak', $x, TRUE);

				if ($x['done']) {
					$data['diisi']++;
				}
			}
		}

		$this->load->view('main_menu', $data);
	}


	/*$this->session->unset_userdata('poto');
			  	 	$this->session->set_userdata('poto', ''.$name_upload.'');*/

	function ajax_upload()
	{
		if (isset($_FILES["image_file"]["name"])) {
			$new_name = $this->session->userdata('nimopt');
			$filename = $_FILES['image_file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$name_upload = $new_name . '.' . $ext;

			$config['upload_path'] = './assets/images/upload/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->overwrite = true;
			if (!$this->upload->do_upload('image_file')) {
				echo "
					<script>
						alert('" . $this->upload->display_errors() . "');
					</script>
				";
				redirect(base_url());
				// redirect('../main_menu/nim2/'.$this->session->userdata('nimopt').'/'.md5(date('hyhdhmhyhmhdhhh').$this->session->userdata('nimopt')).'', 'refresh');
			} else {
				$this->load->model('edomuser_model', 'edomuser');
				$nim = $this->session->userdata('nimopt');
				$pass = $this->session->userdata('passtext');
				$hasil = $this->edomuser->updatepoto($name_upload, $nim);
				$this->session->sess_destroy();
				/*$this->load->model('edomuser_model','edomuser');
			  	 	$cekopt = $this->edomuser->cek_opt($nim, $pass);*/
				$this->session->unset_userdata('poto');
				$this->session->set_userdata('poto', $name_upload);

				// $this->session->set_userdata('potox', ''.$name_upload.'');

				redirect('../main_menu/nim2/' . $this->session->userdata('nimopt') . '/' . md5(date('hyhdhmhyhmhdhhh') . $this->session->userdata('nimopt')) . '');
			}
		} else {
			echo "Gagal";
		}
	}

	public function ubahmail()
	{
		$mail = $_REQUEST['mail'];
		$nim = $_REQUEST['nim'];
		$this->load->model('edomuser_model', 'edomuser');
		$hasil = $this->edomuser->updatemail($nim, $mail);
		foreach ($hasil->result() as $row) {
			echo $row->nemail;
		}
	}

	public function ubahpass()
	{
		$passbaru = $_REQUEST['passbaru'];
		$nim = $_REQUEST['nim'];
		$this->load->model('edomuser_model', 'edomuser');
		$hasil = $this->edomuser->ubahpass($passbaru, $nim);
		if ($hasil) {
			echo "";
		}
	}



	public function nim2($nim, $xxx)
	{
		$quer = $this->user->get_coopt($this->session->userdata['nimopt']);
		if ($quer->num_rows() > 0) {
			$data = $quer->row_array();
		}
		$data['wow'] = '';
		if (md5(date('hyhdhmhyhmhdhhh') . $nim) == $xxx) {

			$data['wow'] = '.';
		}

		$data['assets'] = $this->_asset_string;
		$this->load->model('edomuser_model', 'edomuser');
		/*$banner = $this->edomuser->get_banner();
		$data['banner'] 	= $banner;*/

		$this->load->model('edompotensi_model', 'edompotensi');
		$que = $this->edompotensi->daftar_get(NULL, NULL, 'nim = ' . $nim, NULL, 'done asc');

		$this->load->model('epompotensi_model', 'epompotensi');
		$que2 = $this->epompotensi->daftar_get(NULL, NULL, 'nim = ' . $nim, NULL, 'done asc');

		$data['kelas'] = '-';
		$data['idprogstudi'] = '';

		if ($que->num_rows()) {
			$row = $que->row();
			$data['kelas'] = $row->kelas;
			$data['idprogstudi'] = $row->idprogstudi;
		}

		if ($que2->num_rows()) {
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


		$data['zzz'] = $xz;



		$this->load->view('main_menu2', $data);
	}
	public function nim($nim, $xxx)
	{

		$data['wow'] = '';
		if (md5(date('hyhdhmhyhmhdhhh') . $nim) == $xxx) {

			$data['wow'] = '.';
		}

		$data['assets'] = $this->_asset_string;
		$this->load->model('edompotensi_model', 'edompotensi');
		$que = $this->edompotensi->daftar_get(NULL, NULL, 'nim = ' . $nim, NULL, 'done asc');

		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;
		$data['nim'] = $nim;
		$data['xxx'] = $xxx;

		if ($data['kewajiban']) {

			foreach ($que->result_array() as $x) {

				$data['kotak'] .= $this->load->view('kotak', $x, TRUE);

				if ($x['done']) {
					$data['diisi']++;
				}
			}
			$this->load->view('main_menu', $data);
		} else {
			redirect('maaf');
		}
	}

	public function quiz($id)
	{

		$data['assets'] = $this->_asset_string;
		$this->load->model('edompotensi_model', 'edompotensi');
		$que = $this->edompotensi->daftar_get(NULL, NULL, 'nim = ' . $this->session->userdata('nimopt'), NULL, 'done asc');

		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;
		$data['edok'] = md5(date('hyhdhmhyhmhdhhh') . $this->session->userdata('nimopt'));

		if ($data['kewajiban']) {

			foreach ($que->result_array() as $x) {

				if ($x['id'] == $id) {

					$x['class_selected'] = 'midnightblue';
					$data['judulmin'] = $x['kodedosen'];
					$data['kodemk'] = $x['kodemk'];
					$data['done'] = $x['done'];
					$data['id'] = $x['id'];

					if ($x['done']) {

						$this->load->model('edomdata_model', 'edomdata');
						$que2 = $this->edomdata->daftar_get(NULL, NULL, 'id_potensi = ' . $id, NULL, 'aspek asc');

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

						$this->load->model('edomparameter_model', 'edomparameter');
						$que2 = $this->edomparameter->daftar_get(NULL, NULL, 'deleted = 0 and hide = 0', NULL, 'aspek asc');

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

				if ($x['done']) {
					$data['diisi']++;
				}
			}

			$data['no'] = $no;
			$this->load->view('layout/template', $data);
		} else {
			redirect('maaf');
		}
	}

	public function simpanquiz()
	{

		$idpote = $_POST['potensino'];
		$this->load->model('edompotensi_model', 'edompotensi');
		$arrupdate = array('done' => 1, 'komentar' => $_POST['komentar']);
		$this->edompotensi->ubah($idpote, $arrupdate);

		$que = $this->edompotensi->daftar_get(NULL, NULL, 'id = ' . $idpote, NULL, NULL, 1);

		if ($que->num_rows() > 0) {

			$rowpotensi = $que->row_array();

			$this->load->model('edomparameter_model', 'edomparameter');
			$que2 = $this->edomparameter->daftar_get(NULL, NULL, 'deleted = 0 and hide = 0', NULL);

			if ($que2->num_rows() > 0) {

				$arrparameter = $que2->result_array();

				$cekaspek = '';
				$ctotal = 0;
				$cpembagi = 0;
				$i = 0;
				foreach ($arrparameter as $x) {

					if ($cekaspek != $x['aspek']) {

						if ($cekaspek != '') {
							$arr_sa[$i] = $ctotal / $cpembagi;
							$i++;
						}

						$ctotal = 0;
						$cpembagi = 0;
						$cekaspek = $x['aspek'];
					}

					$arritem = array();
					$arritem['id_potensi'] = $rowpotensi['id'];

					$arritem['v1'] = $_POST['jawab_' . $x['id']];
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

					// tambahan kode agar tidak update epomdata		
					//-------------------			
					$queh = $this->edomparameter->daftarmhsedom_get($rowpotensi['id']);
					foreach ($queh->result_array() as $row) {
						$arritem['idprogstudi'] = $row['idprogstudi'];
						$arritem['kode'] 		= $row['kode'];
						// $arritem['kode2'] 		= $row['kode2'];
						$arritem['kodeprodikls'] 		= $row['idprogstudi'] . "" . $row['kelas'];
						$arritem['kelas'] 		= $row['kelas'];
						$arritem['kodedosen'] 	= $row['kodedosen'];
						$arritem['kodemk'] 		= $row['kodemk'];
					}
					//-------------------		

					foreach ($x as $key => $value) {

						if ($key == 'id') {

							$arritem['id_parameter'] = $value;
						} else {

							if ($key == 'parameter' || $key == 'aspek' || $key == 'jenis') {

								$arritem[$key] = $value;
							}
						}
					}

					$this->load->model('edomdata_model', 'edomdata');
					$this->edomdata->simpan($arritem);
				}

				$arr_sa[$i] = $ctotal / $cpembagi;
				$spote = array_sum($arr_sa) / count($arr_sa);

				$this->edompotensi->ubah($idpote, array('spote' => $spote));
			}
		}

		$arrjson['x'] = base_url() . 'main_menu/nim/' . $rowpotensi['nim'] . '/' . md5(date('hyhdhmhyhmhdhhh') . $rowpotensi['nim']);
		echo json_encode($arrjson);
	}
	public function quiz2()
	{

		$data['assets'] = $this->_asset_string;
		$this->load->model('epompotensi_model', 'epompotensi');
		$que = $this->epompotensi->daftar_get(NULL, NULL, 'nim = ' . $this->session->userdata('nimopt'), NULL, 'done asc');

		$data['kotak'] = '';
		$data['kewajiban'] = $que->num_rows();
		$data['diisi'] = 0;
		$data['edok'] = md5(date('hyhdhmhyhmhdhhh') . $this->session->userdata('nimopt'));

		if ($data['kewajiban']) {
			$x = $que->row_array();


			$x['class_selected'] = 'midnightblue';
			$data['judulmin'] = $x['idprogstudi'];
			//                    $data['kodemk'] = $x['kodemk'];
			$data['done'] = $x['done'];
			$data['id'] = $x['id'];

			if ($x['done']) {

				$this->load->model('epomdata_model', 'epomdata');
				$que2 = $this->epomdata->daftar_get(NULL, NULL, 'id_potensi = ' . $x['id'], NULL, 'aspek asc');

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

				$this->load->model('epomparameter_model', 'epomparameter');
				$que2 = $this->epomparameter->daftar_get(NULL, NULL, 'deleted = 0 and hide = 0', NULL, 'aspek asc');

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
			$this->load->view('layout/template2', $data);
		} else {
			redirect('maaf');
		}
	}

	public function simpanquiz2()
	{

		$idpote = $_POST['potensino'];
		$this->load->model('epompotensi_model', 'epompotensi');
		$arrupdate = array('done' => 1, 'komentar' => $_POST['komentar']);
		$this->epompotensi->ubah($idpote, $arrupdate);

		$que = $this->epompotensi->daftar_get(NULL, NULL, 'id = ' . $idpote, NULL, NULL, 1);

		if ($que->num_rows() > 0) {

			$rowpotensi = $que->row_array();

			$this->load->model('epomparameter_model', 'epomparameter');
			$que2 = $this->epomparameter->daftar_get(NULL, NULL, 'deleted = 0 and hide = 0', NULL, 'aspek asc');

			if ($que2->num_rows() > 0) {

				$arrparameter = $que2->result_array();


				$cekaspek = '';
				$ctotal = 0;
				$cpembagi = 0;
				$i = 0;
				foreach ($arrparameter as $x) {

					if ($cekaspek != $x['aspek']) {

						if ($cekaspek != '') {
							$arr_sa[$i] = $ctotal / $cpembagi;
							$i++;
						}

						$ctotal = 0;
						$cpembagi = 0;
						$cekaspek = $x['aspek'];
					}

					$arritem = array();
					$arritem['id_potensi'] = $rowpotensi['id'];


					$arritem['v1'] = $_POST['jawab_' . $x['id']];
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

					// tambahan kode agar tidak update epomdata		
					//-------------------			
					$queh = $this->epomparameter->daftarmhs_get($rowpotensi['id']);
					foreach ($queh->result_array() as $row) {
						$arritem['idprogstudi'] = $row['idprogstudi'];
						$arritem['kelas_id'] 	= $row['kelas_id'];
						$arritem['kode'] 		= $row['kode'];
					}
					//-------------------

					foreach ($x as $key => $value) {

						if ($key == 'id') {

							$arritem['id_parameter'] = $value;
						} else {

							if ($key == 'parameter' || $key == 'aspek' || $key == 'jenis') {

								$arritem[$key] = $value;
							}
						}
					}



					$this->load->model('epomdata_model', 'epomdata');
					$this->epomdata->simpan($arritem);
				}

				$arr_sa[$i] = $ctotal / $cpembagi;
				$spote = array_sum($arr_sa) / count($arr_sa);

				$this->epompotensi->ubah($idpote, array('spote' => $spote));
			}
		}

		$arrjson['x'] = base_url() . 'main_menu/quiz2';
		echo json_encode($arrjson);
	}
}

/* End of file main_menu.php */
/* Location: ./application/controllers/main_menu.php */