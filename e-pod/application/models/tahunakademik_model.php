<?php

class Tahunakademik_Model extends CI_Model
{
	public $dbsisak;
			
    function __construct()
    {
        parent::__construct();
		$this->dbsisak = $this->load->database('sisak',TRUE);
    }
    
//    function tahun_akademik($str_tgl = "NOW")
//    {
//		$hari = date('Y-m-d',strtotime($str_tgl));	
//		
//        $this->db->where('tgl_awal <=',$hari);
//        $this->db->where('tgl_akhir >=',$hari);
//		$this->db->limit(1);
//        return $this->db->get('tahunakademik');
//    }
		
    function get_thakd($str_tgl = "NOW")
    {
		$hari = date('Y-m-d',strtotime($str_tgl));	
		
        $this->dbsisak->where('tgl_awal <=',$hari);
        $this->dbsisak->where('tgl_akhir >=',$hari);
        $this->dbsisak->where('aktif =','1');
		$this->dbsisak->limit(1);
		
        return $this->dbsisak->get('tahunakademik');
    }
	
    //function get_th_now()
    //{
    //    $hari_ini = date('Y-m-d');
    //    $this->db->where('tgl_awal <=',$hari_ini);
    //    $this->db->where('tgl_akhir >=',$hari_ini);
    //    $query = $this->db->get('tahunakademik');
    //    return $query;
    //}
    
    function hit_week($tglnya = "NOW")
    {
		$tglnyaa = date('Y-m-d',strtotime($tglnya));	
		
        $arrtak = $this->get_thakd($tglnyaa);
        
        if ($arrtak->num_rows() > 0)
        {
            $row    = $arrtak->row();
            $awalsmt = strtotime($row->tgl_awal);
            $harike = date('N',$awalsmt)-1;
            $awalsmt = $awalsmt - (86400 * $harike);
            //$harike = date('N',$awalsmt);
            
            $days   = $this->tglDifference($awalsmt,$tglnyaa);
            
            $week = ceil(($days+1)/7);
	        return $week;
        }else{
			return 0;
		}        
    }
	
	function week_lastday($tglnya = "NOW")
	{

		//$tgls = format_tgl_balik($tglnya);
		$tglteh = strtotime($tglnya);
		$harike = date('N',$tglteh);
		
		//gunakan 6 karena dimulai dari <sabtu. kemudian =jumat, =kamis, =rabu, =selasa, =senin. dan <senin
		$lastday = $tglteh + (86400 * (6-$harike));
		
		
		$hari['satu'] = date('Y-m-d',$lastday-(86400*5));
		$hari['dua'] = date('Y-m-d',$lastday-(86400*4));
		$hari['tiga'] = date('Y-m-d',$lastday-(86400*3));
		$hari['empat'] = date('Y-m-d',$lastday-(86400*2));
		$hari['lima'] = date('Y-m-d',$lastday-(86400*1));
		$hari['enam'] = date('Y-m-d',$lastday);
		
		
		
		return $hari;
		//return date('Y-m-d',$lastday);
		//return $lastday;
		
		
		
		
	}
	
    
    
    function tglDifference($startDate, $endDate = "NOW") 
    { 
        //$startDate = strtotime($startDate); 
        $endDate = strtotime($endDate); 
        $days = $endDate - $startDate; 
        $days = date('z', $days);    
        return $days; 
    } 

    
}