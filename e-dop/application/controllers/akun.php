<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun extends MY_Controller {

	private $_asset_string = '';

	public function __construct(){

		parent::__construct();
		$this->session->sess_cek_action();
		
		$this->load->model('edomuser_model','user');
		
		//INISIALISASI $_asset_string
		$this->_asset_string = '';
	}
	


	public function index() {

		$this->_asset_string .= css_asset('akun/reset.css');
		$this->_asset_string .= css_asset('akun/style.css');
		$this->_asset_string .= css_asset('akun/fancybox.css');
		
        $this->_asset_string .= js_asset('jquery-1.8.3.min.js');
		$this->_asset_string .= js_asset('akun/jquery.easytabs.min.js');
		$this->_asset_string .= js_asset('akun/respond.min.js');
		$this->_asset_string .= js_asset('akun/jquery.easytabs.min.js');
		$this->_asset_string .= js_asset('akun/jquery.adipoli.min.js');
		$this->_asset_string .= js_asset('akun/jquery.fancybox-1.3.4.pack.js');
		$this->_asset_string .= js_asset('akun/jquery.isotope.min.js');
		$this->_asset_string .= js_asset('akun/jquery.gmap.min.js');
		$this->_asset_string .= js_asset('akun/custom.js');
		
		
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
		
		$arrjson['x'] = $this->load->view('akun/profile',$arrview,TRUE);		
		echo json_encode($arrjson);
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