<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//kendali user error atau program error
class Maaf extends CI_Controller {

	public function __construct()
	{		
		parent::__construct();
	}

	public function index()
	{
		$this->session->sess_destroy();
		//method untuk menampilkan session out
		$this->load->view('layout/sessout');
	}
}

/* End of file maaf.php */
/* Location: ./application/controllers/maaf.php */