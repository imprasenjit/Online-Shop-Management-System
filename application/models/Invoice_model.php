<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Invoice_model extends CI_Model
{
    public $table = 'invoice_details_from_supplier';
    public $id = 'invoice_details_from_supplier_id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    function total_rows()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get data with limit
    function index_limit($limit, $start = 0)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    // delete data
    function delete($id)
    {        
        $this->update($id,array("status"=>0));
    }


}
