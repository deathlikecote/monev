<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	private $_asset_string = '';

	public function __construct() {
		
		parent::__construct();
		 
		//INISIALISASI $_asset_string
		$this->_asset_string = '';
		
		//> JS
		$this->_asset_string .= js_asset('jquery-1.8.3.min.js');
		$this->_asset_string .= js_asset('jquery.form.js');
		$this->_asset_string .= js_asset('jquery-ui-1.9.2.custom.min.js');
		$this->_asset_string .= js_asset('helper.js');
		$this->_asset_string .= js_asset('main.js');
	}

	public function index()
	{
		$this->session->sess_destroy();
		$data['nameuser']	= $_GET['kdsn'];
		$data['assets'] 	= $this->_asset_string;
		$this->load->view('welcome_message',$data);
	}
	
	public function color()
	{
		$this->load->view('color');
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */