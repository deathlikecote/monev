<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//MODIFIKASI CI_Session
class MY_Session extends CI_Session {
			
	//sess_cek dengan action ke session out jika tidak ada user atau tidak punya akses
	function sess_cek_action( $field = '' ) {
		
		//cek keberadaan user atau hak akses
		$x = $this->sess_cek($field);
		
		//jika user tidak ada atau hak akses tidak ada
		if ($x === FALSE || $x === 0 || $x === '') {
			
			//session destroy
			$this->sess_destroy();
			
			//menampilkan page kondisi session out
			$this->CI->load->view('layout/sessout',array('err' => $x));
		}
	}
			
	//cek keberadaan user atau hak akses pada proses/data, dengan return berupa status
	function sess_cek( $field = '' ) {
		
		//jika $field tidak diisi (untuk mengecek keberadaan user)
		if ( $field == '' ) {

			//apakah ada user?
			if ($this->userdata( 'idopt' )){
				
				//jawabnya iya ada user
				return 1;			
			}
		}else{ //untuk mengecek hak terhadap action
			
			//get session level operator
			$lev_id = $this->userdata( 'levopt' );
			
			//jika ada level operator
			if ( $lev_id ) {
				
				//jawabannya tidak/punya akses
				return $this->akses_cek( $lev_id, $field );
			}
		}
		
		//kembalian ini artinya, tidak ada user atau tidak berhak terhadap action 
		return 0;
	}
	
	//mengecek hak akses $id = id operator level, $field = jenis actionya
	function akses_cek( $id, $field ) {
		
		//biar bisa akses langsung
		$this->CI =& get_instance();
		
		//langsung akses model operator model
		$this->CI->load->model('operator_model','opmodel');
		
		//get all field level operator
		$priv_list = $this->CI->opmodel->get_level($id);
		
		//jika ada 
		if ($priv_list->num_rows() == 1) {
			
			//keluarkan semua fieldnya dalam bentuk array
			$row = $priv_list->row_array();			
			
			//kembalikan nilai dari jenis action yang bersangkutan
			return $row[$field];
		}
		
		//harusnya slalu ada field bersangkutan, kalaupun ga ada field, di anggap ga punya akses
		return 0;
	}
}
// END Session Class

/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */