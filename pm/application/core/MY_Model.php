<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $table = '';			
	protected $_asset_string = '';
	
	function __construct( $tablename = '' )
	{
		parent::__construct();		
		$this->table = (string) $tablename;
	}
	
	function test() {
		return $this->table;
	}
	
	function simpan($arrdata) {
		$this->db->insert($this->table, $arrdata); 		
	}
			
	function simpan_batch($arrdata) {
		
		$this->db->insert_batch($this->table,$arrdata);
	}
	
	
	/**
     * Buat
     *
     * @return    the last inserted id
     * @param    array
     */	
	function buat($data = null)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Daftar
     *
     * @return    result
     * @param    string, string, array, string, int, int
     */
    
    function daftar($select = null, $from = null, $where = null, $groupby = null, $orderby = null, $limit = null, $offset = null)
    {
		if ( is_null($select)){
			$this->db->select();					
		}else{
			$this->db->select($select);		
		}
		
		if ( is_null($from)){
			$this->db->from($this->table);
		}else{
			$this->db->from($from);			
		}	
		
		if ( ! is_null($where)){
			$this->db->where($where);					
		}
		
//		if ( $this->session->userdata('prodopt') != 'ALL' ){
//			$this->db->where('idprogstudi',$this->session->userdata('prodopt'));								
//		}
		
		if ( ! is_null($groupby)){
			$this->db->group_by($groupby);					
		}
		
		if ( ! is_null($orderby)){
			$this->db->order_by($orderby);					
		}
		
		if ( ! is_null($limit)){
			$this->db->limit($limit, $offset);
		}				
    }
	
	function daftar_get($select = null, $from = null, $where = null, $groupby = null, $orderby = null, $limit = null, $offset = null) {
		
		$this->daftar($select, $from, $where, $groupby, $orderby, $limit, $offset);		
        return $this->db->get();		
	}

	function daftarmhs_get($id_potensi) {
		return $this->db->query("SELECT id, idprogstudi, kelas_id, kode FROM epompotensi where id=$id_potensi");		
	}
	
	function daftarmhsedom_get($id_potensi) {
		return $this->db->query("SELECT id, idprogstudi, kelas, kodedosen, kodemk, kode FROM edompotensi where id=$id_potensi");		
	}
	function daftar_count($select = null, $from = null, $where = null, $groupby = null, $orderby = null, $limit = null, $offset = null) {
		
		$this->daftar($select, $from, $where, $groupby, $orderby, $limit, $offset);		
        return $this->db->count_all_results();				
	}
	
	function daftar_x($select = null, $from = null, $where = null, $groupby = null, $orderby = null, $limit = null, $offset = null) {
		
		$kembali['que'] = $this->daftar_get($select, $from, $where, $groupby, $orderby, $limit, $offset);
		$kembali['que_rows'] = $kembali['que']->num_rows();
		$kembali['total_rows'] = $this->daftar_count($select, $from, $where, $groupby);
		
		return $kembali;
	}	
    
	function daftar_get_arr($select = null, $from = null, $where = null, $groupby = null, $orderby = null, $limit = null, $offset = null)
	{
		
		$que = $this->daftar_get($select, $from, $where, $groupby, $orderby, $limit, $offset);
		if($que->num_rows()) {
			
			return $que->result_array();
		}else{
			
			return array();			
		}
	}
    /**
     * Ubah
     *
     * @return    void
     * @param    int, array
     */
    function ubah($id = null, $data = null) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }
    
    /**
     * Hapus
     *
     * @return    void
     * @param    bool
     */
    function hapus($id = null)
    {
        $this->db-where('id', $id);
        return $this->db-delete($this->table);
    }
        
    /**
     * Baris
     *
     * @return    array
     * @param    int
     */
    function baris($id = null)
    {
        $this->db-where('id', $id);
        $q = $this->db->get($this->table);
        return $q->row();
    }
    
    /**
     * Total_baris
     *
     * @return    int
     */
    function total_baris()
    {
        return (int) $this->db->count_all_results($this->table);
    }
    
    function table_kosong()
    {
        $this->db->empty_table($this->table); 
    }
	
	
}