<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Enquires_model extends CI_Model
{
    public $table = 'enquiry_detail';
    public $id = 'enquiry_detail_id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    //count all Enquiry
    function get_all_enquiryCount()
    {
        $this->db->from("enquires");
        return $this->db->count_all_results();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where("enquiry_id", $id);
        return $this->db->get("enquires")->row();
    }
    function get_enquery_detail_by_enquery_id($enquery_id)
    {
        $this->db->where("enquiry_id", $enquery_id);
        $this->db->where("status", "1");
        $query = $this->db->get("enquires");
        return $query->row();
    }
    // get customer data by id
    function get_cust_by_id($id)
    {
        $this->db->select("*");
        $this->db->where("enquiry_id", $id);
        $this->db->from("enquires");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        } //End of if else
    } //End of get_name()
    //get customer enquiry list by Id ,get all from Enquires tables - enquiry placed
    function get_enquiry_by_customerid($id)
    {
        $this->db->order_by("enquiry_id","DESC");
        $this->db->where("customerid", $id);
        $this->db->where("status", "1");
        return $this->db->get("enquires")->result();
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
    function total_rows_enquiry()
    {
        $this->db->from("enquires");
        return $this->db->count_all_results();
    }
    function total_rows_enquiry_by_customer($customer_id)
    {
        $this->db->where("customerid", $customer_id);
        $this->db->from("enquires");
        return $this->db->count_all_results();
    }
    // get data with limit
    function index_limit_enquiry($limit, $start = 0)
    {
        $this->db->order_by("enquiry_id", $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get("enquires")->result();
    }
    function index_limit_enquiry_by_customer($customer_id, $limit, $start = 0)
    {
        $this->db->where("customerid", $customer_id);
        $this->db->order_by("enquiry_id", $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get("enquires")->result();
    }
    // get search total rows
    function search_total_rows($keyword = NULL)
    {
        $this->db->like('id', $keyword);
        $this->db->or_like('enquiry_date', $keyword);
        $this->db->or_like('enquiry_id', $keyword);
        $this->db->or_like('productid', $keyword);
        $this->db->or_like('quantity', $keyword);
        $this->db->or_like('price', $keyword);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
        $this->db->or_like('enquiry_date', $keyword);
        $this->db->or_like('enquiry_id', $keyword);
        $this->db->or_like('productid', $keyword);
        $this->db->or_like('quantity', $keyword);
        $this->db->or_like('price', $keyword);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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
        $this->db->set("status", "0");
        $this->db->update($this->table);
    }
    function get_customer_details($cust_id = NULL)
    {
        $this->db->where("id", $cust_id);
        $query = $this->db->get("customers");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }
    function get_customer_details2($cust_id = NULL)
    {
        $this->db->where("id", $cust_id);
        $query = $this->db->get("customer_registration");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_enquiry_details($customer_id)
    {
        //$order_no = $this->input->post('id');
        $this->db->where("customerid", $customer_id);
        $query = $this->db->get("enquires");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }
    function get_enquiry_details_by_enquery_id($enquiry_id)
    {
        $this->db->where("enquiry_id", $enquiry_id);
        $query = $this->db->get("enquiry_detail");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_Enquires_details($customer_id)
    {
        //$order_no = $this->input->post('id');
        $this->db->where("customerid", $customer_id);
        $query = $this->db->get("enquires");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_product_details($enquiry_id)
    {
        $this->db->where("enquiry_id", $enquiry_id);
        $this->db->where("status", '1');
        $query = $this->db->get("enquiry_detail");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_product_quotations($enquiry_id)
    {
        $this->db->where("enquiry_id", $enquiry_id);
        $this->db->where("status", '1');
        $query = $this->db->get("enquiry_detail");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return NULL;
        }
    }
    function get_customer()
    {
        $qry = $this->db->query("SELECT * FROM customer_registration");
        if ($qry->num_rows() > 0) {
            echo '<option value="">Select Customer/ID</option>';
            foreach ($qry->result() as $row) {
                echo '<option value="' . $row->id . '">' . $row->id . '-' . $row->name . '</option>';
            }
        }
    }

    function get_todayrows(){
        $today = date("Y-m-d");
        $this->db->select("*");
        $this->db->from("enquires");
        $this->db->where('status',"1");
        $this->db->order_by("enquiry_placed_date","DESC");
        //$this->db->where("DATE(enquiry_placed_date)", $today);
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }//End of if else
    }//End of get_todayrows()

    //For datatable
    function tot_rows(){
        $this->db->select("*");
        $this->db->from("enquires");
        $this->db->where('status',"1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_rows()

    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("enquires");
        $this->db->where('status',"1");
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function search_rows($limit, $start, $keyword, $col, $dir){
        $this->db->select("*");
        $this->db->like("enquiry_id", $keyword);
        $this->db->or_like('enq_ref', $keyword);
        $this->db->or_like('enquiry_placed_date', $keyword);
        $this->db->or_like('name', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("enquires");
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
        $this->db->like('enquiry_id', $keyword);
        $this->db->or_like('enq_ref', $keyword);
        $this->db->or_like('enquiry_placed_date', $keyword);
        $this->db->or_like('name', $keyword);
        $this->db->from("enquires");
        $this->db->where('status',"1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()


    // for front ent data table
    function front_tot_rows($customer_id){
        $this->db->select("*");
        $this->db->from("enquires");
        $this->db->where(array('enquires.customerid'=>$customer_id,'enquires.status'=>"1"));
        $query = $this->db->get();
        return $query->num_rows();

    }//End of tot_rows()

    function front_all_rows($limit, $start, $col, $dir,$customer_id){
        $this->db->select("*");
        $this->db->from("enquires");
        $this->db->where(array('enquires.customerid'=>$customer_id,'enquires.status'=>"1"));
        $this->db->order_by($col, $dir);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function front_search_rows($limit, $start, $keyword, $col, $dir,$customer_id){
        $this->db->select("*");
        $this->db->from("enquires");
        $this->db->where(array('enquires.customerid'=>$customer_id,'enquires.status'=>"1"));
        $this->db->like('enq_ref', $keyword);
        //$this->db->or_like('enquiry_placed_date', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }

    }//End of search_rows()

    function front_tot_search_rows($keyword,$customer_id){
        $this->db->select("*");
        $this->db->from("enquires");
        $this->db->where(array('enquires.customerid'=>$customer_id,'enquires.status'=>"1"));
        $this->db->like('enq_ref', $keyword);
        //$this->db->or_like('enquiry_placed_date', $keyword);
        $query = $this->db->get();
        return $query->num_rows();

    }//End of tot_search_rows()


}
