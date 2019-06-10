<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Blogs_model extends CI_Model {

    public $table = 'blogs';
    public $id = 'blogs_id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get all
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    //For datatable
    function tot_rows() {
        $this->db->select("*");
        $this->db->where('status', 1);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }

//End of tot_rows()

    function get_results() {
        $this->db->select("*");
        $this->db->where('status', 1);
        $this->db->order_by('display_order', 'ASC');
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }

    function all_rows($limit, $start, $col, $dir) {
        $this->db->select("*");
        $this->db->where('status', 1);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }

//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir) {
        $this->db->select("*");
        $this->db->where('status', 1);
        $this->db->like($this->id, $search);
        $this->db->or_like('slider_id', $search);
        $this->db->or_like('description', $search);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }

//End of search_rows()

    function tot_search_rows($search) {
        $this->db->select("*");
        $this->db->where('status', 1);
        $this->db->like($this->id, $search);
        $this->db->or_like('slider_id', $search);
        $this->db->or_like('description', $search);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }

//End of tot_search_rows()
}
