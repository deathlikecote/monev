<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	//protected $nama;
	protected $asset_string;


	public function __construct($nama = NULL)
	{		
		parent::__construct();
		$x = $this->session->sess_cek();
		
		//jika user tidak ada atau hak akses tidak ada
		if ($x === FALSE || $x === 0 || $x === '') {
			
			//session destroy
			$this->session->sess_destroy();
			
			redirect('maaf');
		}
		
		$this->nama = $nama;
	}
		
	//testing function - boleh di hapus
	public function get_nama() {
		echo $this->nama;
	}	
	
	
	///GROUP STRING WHERE/////////////////////////////////////////////////////////
	//untuk mengecek where_str is(''), jika ya di bikin null
	protected function where_ceking($where_str = '') {
		
		$kembali = null;
		if ($where_str != ''){
			$kembali = $where_str;
		}
		
		return $kembali;
	}

	//menggabungkan where_str dengan syarat periode
	protected function str_periode_filter( $where_str = '', $fieldcrte = 'ALL', $fieldname1 = 'semester', $fieldname2 = 'kloter', $or = 0 ){
		
		
		if ($fieldcrte != 'ALL'){
			
			if ($fieldcrte == 'GJL') {
				
				$str_periode = '(((MOD('.$fieldname1.',2)=1)AND('.$fieldname2.'="A"))OR((MOD('.$fieldname1.',2)=0)AND('.$fieldname2.'="B")))';
			}else{
				
				$str_periode = '(((MOD('.$fieldname1.',2)=0)AND('.$fieldname2.'="A"))OR((MOD('.$fieldname1.',2)=1)AND('.$fieldname2.'="B")))';			
			}
			
			if ($where_str != ''){
				
				if ($or) {

					$where_str .= ' OR '.$str_periode;
				}  else {

					$where_str .= ' AND '.$str_periode;			
				}				
			}else{
				
				$where_str = $str_periode;
			}
		}		
		
		return $where_str;
	}
	
	//menggabungkan where_str dengan syarat program studi
	protected function str_prodi_filter( $where_str = '', $fieldcrte = 'ALL', $fieldname = 'idprogstudi', $or = 0 ){
		
		if ($fieldcrte != 'ALL'){
			
			if ($where_str != ''){
				
				if ($or) {

					$where_str .= ' OR '.$fieldname.' = "'.$fieldcrte.'"';
				}  else {

					$where_str .= ' AND '.$fieldname.' = "'.$fieldcrte.'"';			
				}				
			}else{
				
				$where_str = ''.$fieldname.' = "'.$fieldcrte.'"';
			}
		}		
		
		return $where_str;
	}
	
	//menggabungkan where_str dengan syarat kelas
	protected function str_kelas_filter( $where_str = '', $fieldcrte = 'ALL', $fieldname = 'kelas_id', $or = 0 ){
		
		$fieldcrte = str_replace('_', ' ', $fieldcrte);
		
		if ($fieldcrte != 'ALL'){
			
			if ($where_str != ''){
				
				if ($or) {

					$where_str .= ' OR '.$fieldname.' = "'.$fieldcrte.'"';
				}  else {

					$where_str .= ' AND '.$fieldname.' = "'.$fieldcrte.'"';			
				}				
			}else{
				
				$where_str = ''.$fieldname.' = "'.$fieldcrte.'"';
			}
		}		
		
		return $where_str;
	}
	
	//menggabungkan where_str dengan syarat like
	protected function str_not_like_filter( $where_str = '', $fieldcrte = '', $fieldname = array(), $mode = 0, $or = 0 ){
		
		if (count($fieldname)){
			
			$where_like = '(';
			foreach ($fieldname as $x) {

				if ($where_like !== '(') {
					$where_like .= ' OR ';
				}
				
				switch ($mode){
					case 1 :
						$where_like .= ' '.$x.' NOT LIKE "'.$fieldcrte.'%" ' ;
						break;
					case 2 :
						$where_like .= ' '.$x.' NOT LIKE "%'.$fieldcrte.'" ' ;
						break;
					default :
						$where_like .= ' '.$x.' NOT LIKE "%'.$fieldcrte.'%" ' ;
				}
				
			}
			$where_like .= ')';

			if ($where_str != ''){

				if ($or) {

					$where_str .= ' OR '.$where_like;
				}  else {

					$where_str .= ' AND '.$where_like;			
				}				
			}else{

				$where_str = $where_like;
			}
		}
		
		return $where_str;
	}
	
	protected function str_like_filter( $where_str = '', $fieldcrte = '', $fieldname = array(), $mode = 0, $or = 0 ){
		
		if (count($fieldname)){
			
			$where_like = '(';
			foreach ($fieldname as $x) {

				if ($where_like !== '(') {
					$where_like .= ' OR ';
				}
				
				switch ($mode){
					case 1 :
						$where_like .= ' '.$x.' LIKE "'.$fieldcrte.'%" ' ;
						break;
					case 2 :
						$where_like .= ' '.$x.' LIKE "%'.$fieldcrte.'" ' ;
						break;
					default :
						$where_like .= ' '.$x.' LIKE "%'.$fieldcrte.'%" ' ;
				}
				
			}
			$where_like .= ')';

			if ($where_str != ''){

				if ($or) {

					$where_str .= ' OR '.$where_like;
				}  else {

					$where_str .= ' AND '.$where_like;			
				}				
			}else{

				$where_str = $where_like;
			}
		}
		
		return $where_str;
	}
	
	//menggabungkan where_str dengan syarat tahun akademik
	protected function str_perta_filter( $where_str = '', $fieldcrte = 'ALL', $fieldname = 'perta', $or = 0 ){
		
		$fieldcrte = str_replace('_', '/', $fieldcrte);
		
		if ($fieldcrte != 'ALL'){
			
			if ($where_str != ''){
				
				if ($or) {

					$where_str .= ' OR '.$fieldname.' = "'.$fieldcrte.'"';
				}  else {

					$where_str .= ' AND '.$fieldname.' = "'.$fieldcrte.'"';			
				}				
			}else{
				
				$where_str = ''.$fieldname.' = "'.$fieldcrte.'"';
			}
		}		
		
		return $where_str;
	}		
	
	///END OF GROUP STRING WHERE/////////////////////////////////////////////////
	
	
	///GROUP OPTION//////////////////////////////////////////////////////////////
	protected function prodi_opts_from_absen( $where_str = NULL, $all = 0){
		
		$this->load->model('absen_model','abs_mod');
		$que = $this->abs_mod->get_prodi_options($this->where_ceking($where_str));
		
		$option_str = '<option>DATA BELUM ADA</option>';
		
		if ($que->num_rows()) {
			
			$option_str = '';
			if ($all) {
				
				$option_str .= '<option value="ALL">ADAK</option>';			
			}
			
			foreach ($que->result_array() as $prodi) {
				
				$option_str .= '<option value="'.$prodi['idprogstudi'].'">Prodi '.$prodi['idprogstudi'].'</option>';
			}
		}
		
		return $option_str;		
	}
	
	protected function prodi_opts_from_kelas( $where_str = NULL, $all = 0){
		
		$this->load->model('kelas_model','kel_mod');
		$que = $this->kel_mod->get_prodi_options($this->where_ceking($where_str));
		
		$option_str = '<option>DATA BELUM ADA</option>';
		
		if ($que->num_rows()) {
			
			$option_str = '';
			if ($all) {
				
				$option_str .= '<option value="ALL">ADAK</option>';			
			}
			
			foreach ($que->result_array() as $prodi) {
				
				$option_str .= '<option value="'.$prodi['idprogstudi'].'">Prodi '.$prodi['idprogstudi'].'</option>';
			}
		}
		
		return $option_str;		
	}
	
	protected function kelas_opts_from_absen( $where_str = NULL, $all = 0) {
		
		$this->load->model('absen_model','abs_mod');
		$que = $this->abs_mod->get_kelas_options($this->where_ceking($where_str));
		
		$option_str = '<option>DATA BELUM ADA</option>';
		if ($que->num_rows()) {
			
			$option_str = '';
			if ($all) {
				
				$option_str .= '<option value="ALL">ALL</option>';			
			}
			
			foreach ($que->result_array() as $row) {
				
				$option_str .= '<option value="'.$row['kelas_id'].'">Kelas '.$row['kelas_id'].'</option>';
			}
		}
		
		return $option_str;				
	}
	
	protected function kelas_opts_from_kelas( $where_str = NULL, $all = 0) {
		
		$this->load->model('kelas_model','kel_mod');
		$que = $this->kel_mod->get_kelas_options($this->where_ceking($where_str));
		
		$option_str = '<option>DATA BELUM ADA</option>';
		if ($que->num_rows()) {
			
			$option_str = '';
			if ($all) {
				
				$option_str .= '<option value="ALL">ALL</option>';			
			}
			
			foreach ($que->result_array() as $row) {
				
				$option_str .= '<option value="'.$row['kelas_id'].'">Kelas '.$row['kelas_id'].'</option>';
			}
		}
		
		return $option_str;				
	}
	
	protected function ta_opts_from_absen_surat( $where_str = NULL, $all = 0) {
		
		$this->load->model('absensurat_model','absur_mod');
		$que = $this->absur_mod->get_ta_options($this->where_ceking($where_str));
		
		$option_str = '<option value="">DATA BELUM ADA</option>';
		if ($que->num_rows()) {
			
			$option_str = '';
			if ($all) {
				
				$option_str .= '<option value="ALL">ALL</option>';			
			}
			
			foreach ($que->result_array() as $row) {
				
				$option_str .= '<option value="'.$row['perta'].'">TA '.$row['perta'].'</option>';
			}
		}
		
		return $option_str;				
	}
	
	///END OF GROUP OPTIONS /////////////////////////////////////////////////////
	
	public function perta_by_tgl($tgl = 'NOW') {
		
		$this->load->model('tahunakademik_model','thn_akd');
		$que = $this->thn_akd->get_thakd($tgl);
		
		if ($que->num_rows() > 0) {
			
			$arrjson = $que->row_array();
			$arrjson['poeieu'] = date('Y-m-d');
			$arrjson['weekd'] = $this->thn_akd->hit_week($tgl);
		} else {
			
			$arrjson = array();
		}
		
		
		echo json_encode($arrjson);
	}
	
}