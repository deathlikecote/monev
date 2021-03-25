<?php

class Edomuser_model extends MY_Model {
	
    function __construct() {
		
        parent::__construct('edomuser');
    }
    
    function get_coopt($codos) {
		
        $this->db->where('nim',$codos);
        $query = $this->db->get('edomuser');
        return $query;
    }
    
    function cek_opt($kode,$pass) {

		$que = $this->get_coopt($kode);
        if ($que->num_rows() > 0) {
			
            $rowdos = $que->row();            
            if ($rowdos->password == MD5($pass)) {
				$newdata = array(
								'idopt'     => $rowdos->id,
								'nimopt'    => $rowdos->nim,
								'namopt'   => $rowdos->nama,
								'emaopt'   => $rowdos->email,
							);

				return $newdata;					
            } else {
				
                return 'Mohon maaf <span>NIM</span> dan/atau <span>PASSWORD</span> anda tidak sesuai';
            }
        } else {
			
            return 'Mohon maaf <span>NIM</span> dan/atau <span>PASSWORD</span> anda tidak sesuai.';
        }
    }	
}
