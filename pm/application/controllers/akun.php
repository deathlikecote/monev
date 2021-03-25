<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun extends MY_Controller {

	private $_asset_string = '';

	public function __construct(){

		parent::__construct();
		$this->session->sess_cek_action();
		
		$this->load->model('edomuser_model','user');
		
		//INISIALISASI $_asset_string
		$this->_asset_string = '';
		//> CSS
		$this->_asset_string .= css_asset('colors.css');
		$this->_asset_string .= css_asset('style_main_menu.css');
		$this->_asset_string .= css_asset('bootstrap/css/bootstrap.css');
		
		//> JS
		$this->_asset_string .= js_asset('js/jquery-3.2.1.js');
		$this->_asset_string .= js_asset('js/bootstrap.min.js');
		$this->_asset_string .= js_asset('jquery-ui-1.9.2.custom.min.js');
		$this->_asset_string .= js_asset('jquery-1.8.3.min.js');
		$this->_asset_string .= js_asset('jquery.form.js');
		$this->_asset_string .= js_asset('responsiveslides.min.js');
	}
	


	public function index() {
		$que = $this->user->get_coopt($this->session->userdata['nimopt']);
        if ($que->num_rows() > 0) {			
            $arrview = $que->row_array();            
		}
		
		$arrview['edok'] = md5(date('hyhdhmhyhmhdhhh').$this->session->userdata('nimopt'));
		$arrview['assets'] = $this->_asset_string;
		$this->load->view('akun/setting',$arrview);
	}
              
	public function page_profile(){
		
		$que = $this->user->get_coopt($this->session->userdata['nimopt']);
        if ($que->num_rows() > 0) {			
            $arrview = $que->row_array();            
		}
		$arrview['assets'] = $this->_asset_string;
		$this->load->view('akun/profile',$arrview);		

	}
	
	public function page_edit(){
		
		$que = $this->user->get_coopt($this->session->userdata['nimopt']);
        if ($que->num_rows() > 0) {			
            $arrview = $que->row_array();            
		}
		$arrjson['x'] = $this->load->view('akun/editprofile',$arrview,TRUE);		
		echo json_encode($arrjson);
	}
	
	public function page_password(){
		
		$arrjson['x'] = $this->load->view('akun/changepassword','',TRUE);		
		echo json_encode($arrjson);
	}

	public function change_password() {

		$arrjson['msg'] = 'Confirm Password anda salah';		
		
		if ($_POST['pass_baru'] == $_POST['pass_ulangi']) {
			
			$arrjson['msg'] = $this->user->cek_pass($this->session->userdata('nimopt'),$_POST['pass_lama'],$_POST['pass_baru']);
		}
		
		echo json_encode($arrjson);
	}
	
	public function update_profile() {

		$arrupdate['nama'] = $_POST['editnama'];
		$arrupdate['email'] = $_POST['editemail'];
		
		if ($this->user->update_profile($this->session->userdata('nimopt'),$arrupdate)) {
			
			$arrjson['msg'] = '';
		}else{
			
			$arrjson['msg'] = 'Anda tidak terdaftar sebagai user';
		}
		
		echo json_encode($arrjson);		
	}
}

/* End of file main_menu.php */
/* Location: ./application/controllers/main_menu.php */