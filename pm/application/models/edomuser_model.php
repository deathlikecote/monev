<?php

class Edomuser_model extends MY_Model {
public $db;
    function __construct() {
		
       parent::__construct();
		$this->db = $this->load->database('default',TRUE);
       
    }
   function get_banner() {
   	return $query = $this->db->query("select * from t_banner where status ='ya' and publikasi = 'pm' order by publikasi, status asc");
    }

   function updatemail($nim,$mail) {
   	$this->db->set('nemail', $mail);
	$this->db->where('nim', $nim);
	$this->db->update('dbsiswa'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
	$que = $this->get_coopt($nim);
    return $que;
    }

    function updatepoto($gambar,$nim) {
	   	$this->db->set('poto', $gambar);
		$this->db->where('nim', $nim);
		$this->db->update('dbsiswa');
        if ($this->db->affected_rows() > 0)
        {
          return 1;
        }
        else
        {
          return 0;
        }
    }
    
    function ubahpass($passbaru,$nim) {
   	$this->db->set('passtext', $passbaru);
   	$this->db->set('passcode', md5($passbaru));
	$this->db->where('nim', $nim);
	$this->db->update('dbsiswa'); 
    }

    function get_coopt($codos) {
        $this->db->where('nim',$codos);
        $query = $this->db->get('m_siswa');
        return $query;
    }

    function get_user($email) {
        $this->db->where('nim',$email);
        $query = $this->db->get('dbsiswa');
        return $query;
    }
	
	function cek_pass($kode,$pass,$newpass) {
		
		$que = $this->get_coopt($kode);
        if ($que->num_rows() > 0) {
			
            $rowdos = $que->row();            
            if ($rowdos->passcode == md5($pass)) {
				
				$data['passcode'] = md5($newpass);
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

    function cek_opt($kode, $to) {
		$que = $this->get_coopt($kode);
        if ($que->num_rows() > 0) {
			
            $rowdos = $que->row();            
                $ques = $this->get_perta($to);
                if ($ques->num_rows() > 0) {
                    
                    $rows = $ques->row(); 
                }
				$newdata = array(
								'idopt'     => $rowdos->id,
								'nimopt'    => $rowdos->nim,
								'namopt'   => $rowdos->nama,
								'emaopt'   => $rowdos->nemail,
								'statedom'   => $rowdos->statusedom,
                                'thnakd'   => $rows->perta,
                                'tgl_awal'   => $rows->tglawal,
                                'tgl_akhir'   => $rows->tglakhir
							);

				return $newdata;					
         
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