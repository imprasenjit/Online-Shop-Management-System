<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback_model extends CI_Model
{
	public $table = 'feedback';
    public $quotes_id = 'feedback';
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