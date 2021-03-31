<?php

class Edopuser_model extends MY_Model {
	
    function __construct() {
		
        parent::__construct('edopuser');
    }
    
    function get_coopt($codos) {
        $this->db = $this->load->database('default', TRUE);
        $this->db->where('kodeprodi',$codos);
        $query = $this->db->get('m_prodi');
        return $query;
    }
	
	function cek_pass($kode,$pass,$newpass) {
		
		$que = $this->get_coopt($kode);
        if ($que->num_rows() > 0) {
			
            $rowdos = $que->row();            
            if ($rowdos->password == md5($pass)) {
				
				$data['password'] = md5($newpass);
				$this->ubah($rowdos->id, $data);				
				return 'Password baru anda adalah "'.$newpass.'"';
            } else {
				
                return 'Password anda salah';
            }
        } else {
			
            return 'Anda tidak terdatar sebagai user';
        }
	}

	function get_perta($to) {
        $this->db->where('jenis', strtoupper($to));
        $query = $this->db->get('m_periode');
        return $query;
    }
    
    function cek_opt($kode,$to) {

		$que = $this->get_coopt($kode);
        if ($que->num_rows() > 0) {
			
            $rowdos = $que->row();   

              $ques = $this->get_perta($to);
                if ($ques->num_rows() > 0) {
                    
                    $rows = $ques->row(); 
                }         
				$newdata = array(
								'idopt'     => $rowdos->id,
								'nimopt'    => $rowdos->kodeprodi,
								'namopt'   => $rowdos->namaprodi,
								'thnakd'   => $rows->perta,
                                'tgl_awal'   => $rows->tglawal,
                                'tgl_akhir'   => $rows->tglakhir
							);

				return $newdata;					
          
        } else {
			
            return 'Mohon maaf <span>IDPRODI</span> dan/atau <span>PASSWORD</span> anda tidak sesuai.';
        }
    }	
	
	function update_profile($nim,$arrupdate) {
		
		$que = $this->get_coopt($nim);
        if ($que->num_rows() > 0) {
            $rowdos = $que->row();            
			$this->ubah($rowdos->id, $arrupdate);							
			return 1;
		}
		
		return 0;
	}
}
