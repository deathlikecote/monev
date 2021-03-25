<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun_old extends MY_Controller {

	private $_asset_string = '';

	public function __construct(){

		parent::__construct();
		$this->session->sess_cek_action();
		
		//INISIALISASI $_asset_string
		$this->_asset_string = '';
				
//		//> CSS
//		$this->_asset_string .= css_asset('redmond/jquery-ui-1.8.15.custom.css');
//		$this->_asset_string .= css_asset('basics.css');
//		$this->_asset_string .= css_asset('colors.css');
//		$this->_asset_string .= css_asset('modifs.css');
		
		//> JS
//		$this->_asset_string .= js_asset('jquery-1.8.3.min.js');
//		$this->_asset_string .= js_asset('jquery.form.js');
//		$this->_asset_string .= js_asset('jquery-ui-1.9.2.custom.min.js');
//		$this->_asset_string .= js_asset('helper.js');
//		$this->_asset_string .= js_asset('main.js');		

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
	
	public function index() {
		
		$data['assets'] = $this->_asset_string;
		
		$data['nim'] = $this->session->userdata('nimopt');
		$data['nama'] = $this->session->userdata('namopt');
		
		$this->load->view('akun',$data);
	}

	public function nim() {
		echo "dsfsdf";
	}
}

/* End of file main_menu.php */
/* Location: ./application/controllers/main_menu.php */