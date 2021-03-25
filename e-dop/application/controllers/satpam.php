<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satpam extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	private $_asset_string = '';

	public function __construct()
	{
		
		parent::__construct();		
	}

	public function index()
	{
		echo $this->load->view('ditabs/info');
	}
	
	private  function _cek_session() {
		
		if ($this->session->userdata('idopt')){
			
			$this->session->sess_destroy();
			redirect( base_url().'maaf/' );			
		}
	}
			
	function ceking()
	{
		$nameuser	= $_POST['nameopt'];
		$passuser	= $_POST['passopt'];
		$progs	= $_POST['progs'];
		$this->session->set_userdata('progs', $progs);
//		$submitlogin= $_POST['submitlogin'];
		
		$this->load->model('edopuser_model','edopuser');
		
		if ($nameuser && $passuser){
			$cekopt = $this->edopuser->cek_opt($nameuser,$passuser);
			
			if (is_array($cekopt)){
				
				$arr['error'] 	= '';
				$this->session->set_userdata($cekopt);
			}else{
				
				$arr['error'] = '<div class="error">'.$cekopt.'</div>';				
			}
		}else{
			
			$arr['error'] = '<div class="error">Lengkapi <span>IDPRODI</span> dan <span>PASSWORD</span>.</div>';
		}
		
		//$arr['satu'] = $nameuser;
		$arr['satu'] = $progs;
		$arr['edoc'] = md5(date('hyhdhmhyhmhdhhh').$nameuser);
		
		echo json_encode($arr);
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

/* End of file satpam.php */
/* Location: ./application/controllers/satpam.php */