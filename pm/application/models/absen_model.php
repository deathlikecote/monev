<?php

class Absen_Model extends MY_Model
{
    
    function __construct()
    {
        parent::__construct('absen_t');
    }
	
	function delete_id($id)
	{
		$this->dbsisak->where('id', $id);
		return $this->db->delete('absen_t'); 	
	}
	
	function update_id($id,$dataupdate)
	{
		$this->dbsisak->where('id', $id);
		return $this->db->update('absen_t', $dataupdate); 	
	}
	
	function save($datasave)
	{
		return $this->dbsisak->insert('absen_t', $datasave);
	}
	
	function get_like_teks($limit=10,$offset=0,$stringa='',$other = '')
	{
		$thnajr = $this->session->userdata('thnakd');
//		$prodi = $this->session->userdata('prodopt');
				
		$str_limit = '';
		if ($limit) {
			$str_limit = ' LIMIT '.$offset.','.$limit;
		}
		
		return $this->dbsisak->query('SELECT absen_t.nim,
								absen_t.kelas_id,
								absen_t.idprogstudi,
								t_kelas.pp,
								t_kelas.sp1,
								t_kelas.sp2,
								t_kelas.sp3,
								t_kelas.pp_by_absen,
								t_kelas.sp1_by_absen,
								t_kelas.sp2_by_absen,
								t_kelas.sp3_by_absen,
								t_kelas.znama,
								SUM(absen_t.jumlah_jam) as JJ,
								SUM(IF((status = "A"), jumlah_jam,0)) AS ALPA,
								SUM(IF((status = "I"), jumlah_jam,0)) AS IZIN,
								SUM(IF((status = "S"), jumlah_jam,0)) AS SAKIT,
								SUM(IF((status = "Hs"), jumlah_jam,0)) AS HOSPITALIZE
								
								FROM absen_t, t_kelas
								WHERE absen_t.nim = t_kelas.nim 
								'.$other.' 
								AND absen_t.perta = "'.$thnajr.'"
								AND (absen_t.nim LIKE "%'.$stringa.'%" OR t_kelas.znama LIKE "%'.$stringa.'%") 
								GROUP BY absen_t.nim
								ORDER BY ALPA DESC, IZIN DESC, SAKIT DESC, HOSPITALIZE DESC, absen_t.nim ASC '.$str_limit);
	}
	
	function get_like_nim($nimlike)
	{
		$thnajr = $this->session->userdata('thnakd');
		$prodi = $this->session->userdata('prodiopt');
        $this->dbsisak->where('perta',$thnajr);
        $this->dbsisak->where('idprogstudi',$prodi);
        $this->dbsisak->like('nim',$nimlike);
		$this->dbsisak->order_by('nim','asc');
		$this->dbsisak->group_by('nim');
		$this->dbsisak->limit(10);
		return $this->dbsisak->get('absen_t');
	}
    
	function get_kelas_nim($nim)
	{
		$thnajr = $this->session->userdata('thnakd');
		$prodi = $this->session->userdata('prodiopt');
        $this->dbsisak->where('perta',$thnajr);
        $this->dbsisak->where('idprogstudi',$prodi);
        $this->dbsisak->where('nim',$nim);
		$this->dbsisak->order_by('kelas_id','asc');
		$this->dbsisak->group_by('kelas_id');
		$query = $this->dbsisak->get('absen_t');
		
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $arr[$row->kelas_id] = $row->kelas_id;
            }            
        }
        else
        {
            $arr = array();
        }
        return $arr;
	}
	
	function get_absen_nim($nim)
	{
        $this->dbsisak->where('nim',$nim);
        $this->dbsisak->where('perta',$this->session->userdata('thnakd'));
		$this->dbsisak->order_by('tanggal','desc');
		$query = $this->dbsisak->get('absen_t');
		

        return $query;
	}
	
	function get_absen_id($id)
	{
        $this->dbsisak->where('ID',$id);
		$query = $this->dbsisak->get('absen_t');
		
        if ($query->num_rows() > 0)
        {
			return $query->row_array();
		}else{
			return 0;
		}
	}
	
	
	
	function get_rekap_nim($nim)
	{
		return $this->dbsisak->query(
			'SELECT
				nim,
				kelas_id,
				SUM(IF((status = "A"), jumlah_jam,0)) AS ALPA,
				SUM(IF((status = "I"), jumlah_jam,0)) AS IZIN,
				SUM(IF((status = "S"), jumlah_jam,0)) AS SAKIT,
				SUM(IF((status = "Hs"), jumlah_jam,0)) AS HOSPITALIZE,
				SUM(jumlah_jam) AS TOTALJAM
				FROM absen_t
				WHERE nim LIKE "%'.$nim.'%"
				GROUP BY nim');
		

	}
	
	function get_rekap_sp_nim($nim)
	{
		$db2 = $this->load->database('sisak',TRUE);
		
        $db2->where('nim',$nim);
        $db2->where('perta', $this->session->userdata('thnakd'));
		$query = $db2->get('t_kelas');
		
		$sp1 = 'SP1: ';
		$sp2 = 'SP2: ';
		$sp3 = 'SP3: ';
		$sk = 'Nomor SK: ';
		
		
        if ($query->num_rows() > 0)
        {
			$row = $query->row();
			
			if(substr($row->sp1_pel,0,3)=='ABN'){
              $sp1 .= date_format(new DateTime($row->sp1_by_absen), 'd M Y').', '.$row->sp1_no;
            }else if(substr($row->sp1_pel,0,3)=='PKU'){
              $sp1 .= date_format(new DateTime($row->sp1), 'd M Y').', '.$row->sp1_no;
            }else{
              $sp1 .= '-';
            }

            if(substr($row->sp2_pel,0,3)=='ABN'){
              $sp2 .= date_format(new DateTime($row->sp2_by_absen), 'd M Y').', '.$row->sp2_no;
            }else if(substr($row->sp2_pel,0,3)=='PKU'){
              $sp2 .= date_format(new DateTime($row->sp2), 'd M Y').', '.$row->sp2_no;
            }else{
              $sp2 .= '-';
            }

            if(substr($row->sp3_pel,0,3)=='ABN'){
              $sp3 .= date_format(new DateTime($row->sp3_by_absen), 'd M Y').', '.$row->sp3_no;
            }else if(substr($row->sp3_pel,0,3)=='PKU'){
              $sp3 .= date_format(new DateTime($row->sp3), 'd M Y').', '.$row->sp3_no;
            }else{
              $sp3 .= '-';
            }

			// if ($row->sp1 == "0000-00-00") {
			// 	$sp1 .= '-';
			// }  
			// else {
			// 	$tgl1 = date_create($row->sp1);
			// 	$sp1 .= date_format($tgl1,"d M Y").', '.$row->sp1_no;				
			// }
			// if ($row->sp2 == "0000-00-00") {
			// 	$sp2 .= '-';
			// }  
			// else {
			// 	$tgl2 = date_create($row->sp2);
			// 	$sp2 .= date_format($tgl2,"d M Y").', '.$row->sp2_no;				
			// }
			// if ($row->sp3 == "0000-00-00") {
			// 	$sp3 .= '-';
			// }  
			// else {
			// 	$tgl3 = date_create($row->sp3);
			// 	$sp3 .= date_format($tgl3,"d M Y").', '.$row->sp3_no;				
			// }

			$db2->where('nim',$nim);
			$db2->where('perta',$this->session->userdata('thnakd'));
			$query = $db2->get('t_skppcadopo');
			if ($query->num_rows() > 0)
		        {
					$row = $query->row();
					
						$sk .= date_format(new DateTime($row->tgl), 'd M Y').', '.$row->nosk;		
					
				}else{
					$sk .= '-';
				}
			}
		
		$arr['sp1'] = $sp1;
		$arr['sp2'] = $sp2;
		$arr['sp3'] = $sp3;
		$arr['sk'] = $sk;
		
		return $arr;
	}
	
	function get_rekap_status_nim($nim)
	{
		$db2 = $this->load->database('sisak',TRUE);
		
		$db2->select('status');
		$db2->select_sum('jumlah_jam','TOTALJAM');
        $db2->where('nim',$nim);
       $db2->where('perta',$this->session->userdata('thnakd'));
		$db2->group_by(array("nim", "perta", "idprogstudi", "kelas_id","status"));
		$query = $db2->get('absen_t');
		
		$alfa = '0';
		$izin = '0';
		$sakit = '0';
		$hospital = '0';
		
        if ($query->num_rows() > 0)
        {
            $abstotal = 0;
			foreach ($query->result() as $row)
			{
				switch($row->status)
				{
					case 'Hs':
						$hospital = $row->TOTALJAM;
						break;
					case 'S':
						$sakit = $row->TOTALJAM;
						break;
					case 'I':
						$izin = $row->TOTALJAM;
						break;
					default:
						$alfa = $row->TOTALJAM;
				}
				$abstotal = $abstotal + $row->TOTALJAM;
			}
		}
		
		$arr['rekap'] = 'A='.$alfa.' | I='.$izin.' | S='.$sakit.' | Hs='.$hospital;
		$arr['total'] = '0';
		
		if ($abstotal > 0)
		{
			$arr['total'] = $abstotal;
		}
		
		return $arr;
		
	}
	
	function get_mingguan($kelas,$arrtgl,$prodi)
	{
		$thnajr = $this->session->userdata('thnakd');
//		$prodi = $this->session->userdata('prodopt');
		
		if ($prodi == 'ALL') {
			$qX = '';
		}else{
			$qX = ' AND kelas_id="'.$kelas.'" AND idprogstudi="'.$prodi.'" ';
		}		
		
		$senin = $arrtgl['satu'];
		$selasa = $arrtgl['dua'];
		$rabu = $arrtgl['tiga'];
		$kamis = $arrtgl['empat'];
		$jumat = $arrtgl['lima'];
		$sabtu = $arrtgl['enam'];		
		
		return $this->dbsisak->query('	SELECT nim,

									SUM(IF((status = "A" AND tanggal < "'.$senin.'"), jumlah_jam,0)) AS A1,
									SUM(IF((status = "I" AND tanggal < "'.$senin.'"), jumlah_jam,0)) AS I1,
									SUM(IF((status = "S" AND tanggal < "'.$senin.'"), jumlah_jam,0)) AS S1,
									SUM(IF((status = "Hs" AND tanggal < "'.$senin.'"), jumlah_jam,0)) AS HS1,
									SUM(IF(tanggal < "'.$senin.'", jumlah_jam,0)) AS T1,
									
									SUM(IF((status = "A" AND tanggal = "'.$senin.'"), jumlah_jam,0)) AS A_D1,
									SUM(IF((status = "I" AND tanggal = "'.$senin.'"), jumlah_jam,0)) AS I_D1,
									SUM(IF((status = "S" AND tanggal = "'.$senin.'"), jumlah_jam,0)) AS S_D1,
									SUM(IF((status = "Hs" AND tanggal = "'.$senin.'"), jumlah_jam,0)) AS HS_D1,
									
									SUM(IF((status = "A" AND tanggal = "'.$selasa.'"), jumlah_jam,0)) AS A_D2,
									SUM(IF((status = "I" AND tanggal = "'.$selasa.'"), jumlah_jam,0)) AS I_D2,
									SUM(IF((status = "S" AND tanggal = "'.$selasa.'"), jumlah_jam,0)) AS S_D2,
									SUM(IF((status = "Hs" AND tanggal = "'.$selasa.'"), jumlah_jam,0)) AS HS_D2,
									
									SUM(IF((status = "A" AND tanggal = "'.$rabu.'"), jumlah_jam,0)) AS A_D3,
									SUM(IF((status = "I" AND tanggal = "'.$rabu.'"), jumlah_jam,0)) AS I_D3,
									SUM(IF((status = "S" AND tanggal = "'.$rabu.'"), jumlah_jam,0)) AS S_D3,
									SUM(IF((status = "Hs" AND tanggal = "'.$rabu.'"), jumlah_jam,0)) AS HS_D3,
									
									SUM(IF((status = "A" AND tanggal = "'.$kamis.'"), jumlah_jam,0)) AS A_D4,
									SUM(IF((status = "I" AND tanggal = "'.$kamis.'"), jumlah_jam,0)) AS I_D4,
									SUM(IF((status = "S" AND tanggal = "'.$kamis.'"), jumlah_jam,0)) AS S_D4,
									SUM(IF((status = "Hs" AND tanggal = "'.$kamis.'"), jumlah_jam,0)) AS HS_D4,
									
									SUM(IF((status = "A" AND tanggal = "'.$jumat.'"), jumlah_jam,0)) AS A_D5,
									SUM(IF((status = "I" AND tanggal = "'.$jumat.'"), jumlah_jam,0)) AS I_D5,
									SUM(IF((status = "S" AND tanggal = "'.$jumat.'"), jumlah_jam,0)) AS S_D5,
									SUM(IF((status = "Hs" AND tanggal = "'.$jumat.'"), jumlah_jam,0)) AS HS_D5,
									
									SUM(IF((status = "A" AND tanggal < "'.$sabtu.'"), jumlah_jam,0)) AS A2,
									SUM(IF((status = "I" AND tanggal < "'.$sabtu.'"), jumlah_jam,0)) AS I2,
									SUM(IF((status = "S" AND tanggal < "'.$sabtu.'"), jumlah_jam,0)) AS S2,
									SUM(IF((status = "Hs" AND tanggal < "'.$sabtu.'"), jumlah_jam,0)) AS HS2,
									SUM(IF(tanggal < "'.$sabtu.'", jumlah_jam,0)) AS T2
									
									FROM absen_t
									WHERE perta = "'.$thnajr.'"
										'.$qX.'
									AND tanggal < "'.$sabtu.'"
									GROUP BY nim
									ORDER BY nim ASC
								');	
	}
	
	
	
	
	function get_kelas()
	{
		$thnajr = $this->session->userdata('thnakd');
		$prodi = $this->session->userdata('prodopt');
		$jenjang = $this->session->userdata('jenjang');
		
		return $this->dbsisak->query('	SELECT kelas_id
									FROM absen_t
									WHERE perta = "'.$thnajr.'" AND idprogstudi= "'.$prodi.'"
									GROUP BY kelas_id
									ORDER BY kelas_id ASC');
			
	}

	
	
	function get_kelas_harian($kelasnya,$tglnya)
	{
		$thnajr = $this->session->userdata('thnakd');
		$prodi = $this->session->userdata('prodopt');
		
		return $this->dbsisak->query('	SELECT * 
									FROM absen_t 
									WHERE perta="'.$thnajr.'" AND idprogstudi="'.$prodi.'" 
									AND tanggal="'.$tglnya.'" AND kelas_id="'.$kelasnya.'"
									ORDER BY nim ASC');
		
		
	}
	
	function cek_sp_by_absen($nim){
		
		$arrupdate = array();
		
		$que = $this->get_like_teks(1,0,$nim);
        if ($que->num_rows() > 0){
			
				$absen = $que->row();
								
				//PP KARENA ABSEN
				if ($absen->ALPA >= 28 || $absen->ALPA + $absen->IZIN + $absen->SAKIT > 50 || $absen->HOSPITALIZE > 100) {
					
					if ($absen->pp_by_absen === '0000-00-00') {
						
						$arrupdate['pp_by_absen'] = date('Y-m-d');
					}
					
					if ($absen->sp3_by_absen == '0000-00-00') {

						$arrupdate['sp3_by_absen'] = date('Y-m-d');
					}
					
					if ($absen->sp2_by_absen == '0000-00-00') {

						$arrupdate['sp2_by_absen'] = date('Y-m-d');
					}
					
					if ($absen->sp1_by_absen == '0000-00-00') {

						$arrupdate['sp1_by_absen'] = date('Y-m-d');
					}	
				}else{
					
					$arrupdate['pp_by_absen'] = '0000-00-00';					

					//SP3 KARENA ABSEN
					if ($absen->ALPA >=24) {

						if ($absen->sp3_by_absen == '0000-00-00') {
						
							$arrupdate['sp3_by_absen'] = date('Y-m-d');
						}
						
						if ($absen->sp2_by_absen == '0000-00-00') {

							$arrupdate['sp2_by_absen'] = date('Y-m-d');
						}

						if ($absen->sp1_by_absen == '0000-00-00') {

							$arrupdate['sp1_by_absen'] = date('Y-m-d');
						}	
					}else{

						$arrupdate['sp3_by_absen'] = '0000-00-00';					
		
						//SP2 KARENA ABSEN
						if ($absen->ALPA >=16) {

							if ($absen->sp2_by_absen == '0000-00-00') {
						
								$arrupdate['sp2_by_absen'] = date('Y-m-d');
							}
							
							if ($absen->sp1_by_absen == '0000-00-00') {

								$arrupdate['sp1_by_absen'] = date('Y-m-d');
							}	
						}else{

							$arrupdate['sp2_by_absen'] = '0000-00-00';					
		
							//SP1 KARENA ABSEN
							if ($absen->ALPA >=8) {

								if ($absen->sp1_by_absen == '0000-00-00') {
							
									$arrupdate['sp1_by_absen'] = date('Y-m-d');
								}	
							}else{

								$arrupdate['sp1_by_absen'] = '0000-00-00';					
							}
						}
					}
				}
				
				return $arrupdate;
		}else{
			
			$arrupdate['sp1_by_absen'] = '0000-00-00';					
			$arrupdate['sp2_by_absen'] = '0000-00-00';					
			$arrupdate['sp3_by_absen'] = '0000-00-00';					
			$arrupdate['pp_by_absen'] = '0000-00-00';					
			
			return $arrupdate;
		}
		
	}	
	
	
	
	
	
}