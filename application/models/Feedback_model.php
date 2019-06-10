<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Feedback_model extends CI_Model
{
    public $table = 'feedback';
    public $id = 'feedback_id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }

   /**
    * get_by_id
    *
    * @param mixed $id
    * @return object
    */
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    //For datatable
    function tot_rows()
    {
        $this->db->select("*");
        $this->db->from("enquires");
        $this->db->where('status', "1");
        $query = $this->db->get();
        return $query->num_rows();
    } //End of tot_rows()
    function all_rows($limit, $start, $col, $dir)
    {
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
        $this->db->where('status', "1");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    } //End of all_rows()
    function search_rows($limit, $start, $keyword, $col, $dir)
    {
        $this->db->select("*");
        $this->db->like('name', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('contact', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
        $this->db->where('status', "1");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    } //End of search_rows()
    function tot_search_rows($keyword)
    {
        $this->db->select("*");
        $this->db->like('name', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('contact', $keyword);
        $this->db->from($this->table);
        $this->db->where('status', "1");
        $query = $this->db->get();
        return $query->num_rows();
    } //End of tot_search_rows()
}
