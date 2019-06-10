<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Customers_model extends CI_Model
{
    public $table = 'customers';
    public $id = 'id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }
    function checkuser($email)
    {
        $this->db->select("*");
        $this->db->where("email", $email);
        $this->db->where('status',"1");
        $this->db->from("customers");
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    //count all existing customer
    function get_all_customerCount()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function get_by_id1($id)
    {
        $this->db->select("*");
        $this->db->where($this->id, $id);
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        } //End of if else
    } //End of get_name()
    function get_by_email($email)
    {
        $this->db->where("email", $email);
        return $this->db->get($this->table)->row();
    }
    // get total rows
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
    // get search total rows
    function search_total_rows($keyword = NULL)
    {
        $this->db->like('id', $keyword);
        $this->db->or_like('name', $keyword);
        $this->db->or_like('gst_no', $keyword);
        $this->db->or_like('pan_no', $keyword);
        $this->db->or_like('password', $keyword);
        $this->db->or_like('status', $keyword);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
        $this->db->or_like('name', $keyword);
        //$this->db->or_like('gst_no', $keyword);
        //$this->db->or_like('pan_no', $keyword);
        //$this->db->or_like('password', $keyword);
        //$this->db->or_like('status', $keyword);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    // insert data
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
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_enquiry_details_by_customer_id_all_rows($cust_id,$limit, $start,$order,$dir)
    {
        $this->db->where("customerid", $cust_id);
        $this->db->limit($limit, $start);
        $this->db->order_by($order,$dir);
        $query = $this->db->get("enquires");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_enquiry_details_by_customer_id($cust_id,$limit, $start,$search,$order,$dir)
    {
        $this->db->where("customerid", $cust_id);
        $this->db->order_by($order,$dir);
        $this->db->limit($limit, $start);
        $query = $this->db->get("enquires");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_enquiry_details_by_customer_tot_search_rows($cust_id)
    {
        $this->db->where("customerid", $cust_id);
        $query = $this->db->get("enquires");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function save_purchase_order($data)
    {
        $this->db->insert("purchase_order_to_admin", $data);
        return $this->db->insert_id();;
    }


    //For datatable
    function tot_rows(){
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('status',"1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_rows()

    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");
        $this->db->where('status',"1");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function search_rows($limit, $start, $keyword, $col, $dir){
        $this->db->select("*");
        $this->db->or_like('name', $keyword);
        $this->db->or_like('contact', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('address', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
        $this->db->where('status',"1");
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()

    function tot_search_rows($keyword){
        $this->db->select("*");
        $this->db->where('status',"1");
        $this->db->or_like('name', $keyword);
        $this->db->or_like('contact', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('address', $keyword);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()

}
