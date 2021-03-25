<?php

class Epomparameter_model extends MY_Model {
	public $db;
    function __construct() {
		$this->db = $this->load->database('default',TRUE);
        parent::__construct('epomparameter');
    }
}
