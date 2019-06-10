<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Services_model extends CI_Model
{

	public $table = 'services';
    public $quotes_id = 'service_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
		
    }

    // insert data
	function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
	
}

/* End of file Quotes_model.php */
/* Location: ./application/models/Quotes_model.php */