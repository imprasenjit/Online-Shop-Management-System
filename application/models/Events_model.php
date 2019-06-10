<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
	function get_all_events()
    {
       
        return $this->db->get("events")->result();
    }

	//insert into events table
	function insert_events($data)
    {
        $this->db->insert('events', $data);
    }
	function delete()
    {
		$this->db->truncate('events'); 
		//$this->db->where($this->id, $id);
        //$this->db->delete('events');
    }
}

/* End of file Customer_registration_model.php */
/* Location: ./application/models/Customer_registration_model.php */