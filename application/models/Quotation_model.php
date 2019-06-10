<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Quotation_model extends CI_Model
{
    public $table = 'quotation';
    public $id = 'quotation_id';
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
    //count all quotation
    function get_all_quotationCount()
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
    //get quoted product details by id
    function get_quotation_by_id($id)
    {
        $this->db->where("enquiry_id", $id);
        $this->db->order_by($this->id, $this->order);
        $this->db->limit(1);
        return $this->db->get($this->table)->row();
    }
    function get_quotation_by_id2($id)
    {
        $this->db->where("enquiry_id", $id);
        return $this->db->get($this->table)->row();
    }
    //get quotations placed details using enquiry id
    function get_quotations_by_enquiryid($enquiry_id)
    {
        $this->db->where("enquiry_id", $enquiry_id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function check_quotation($enquiry_id)
    {
        $this->db->where("enquiry_id", $enquiry_id);
        return $this->db->get("quotation")->row();
    }
    // get total rows
    function total_rows()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function total_rows_quotation_by_customer($customer_id)
    {
        $this->db->select('*');
        $this->db->from("quotation");
        $this->db->join('enquires', 'enquires.enquiry_id = quotation.enquiry_id');
        return $this->db->count_all_results();
    }
    // get data with limit
    function index_limit($limit, $start = 0)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    function index_limit_quotation_by_customer($customer_id,$limit, $start = 0)
    {
        $this->db->select('*');
        $this->db->from("quotation");
        $this->db->join('enquires', 'enquires.enquiry_id = quotation.enquiry_id');
        $this->db->where(array('enquires.customerid'=>$customer_id,'enquires.status'=>"1",'quotation.status'=>"1"));
        $this->db->order_by("quotation.quotation_id","DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    // get search total rows
    function search_total_rows($keyword = NULL)
    {
        $this->db->like('id', $keyword);
        $this->db->or_like('send_to', $keyword);
        $this->db->or_like('product_price', $keyword);
        $this->db->or_like('send_from', $keyword);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
        $this->db->or_like('send_to', $keyword);
        $this->db->or_like('product_price', $keyword);
        $this->db->or_like('send_from', $keyword);
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
    }//End of all_rows()

    function search_rows($limit, $start, $keyword, $col, $dir){
        $this->db->select("*");
        $this->db->like($this->id, $keyword);
        $this->db->or_like('quotation_id', $keyword);
        $this->db->or_like('email', $keyword);
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
        $this->db->like($this->id, $keyword);
        $this->db->or_like('quotation_id', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->from($this->table);
          $this->db->where('status',"1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()



        // for front ent data table
        function front_tot_rows($customer_id){
            $this->db->select("q.quotation_id,q.quotation_date,q.enquiry_id,e.unique_id");
            $this->db->from("quotation as q");
            $this->db->join('enquires as e','e.enquiry_id=q.enquiry_id');
            $this->db->where(array('e.customerid'=>$customer_id,'e.status'=>"1"));
            $query = $this->db->get();
            return $query->num_rows();

        }//End of tot_rows()

        function front_all_rows($limit, $start, $col, $dir,$customer_id){
          $this->db->select("q.quotation_id,q.quotation_date,q.enquiry_id,e.unique_id");
          $this->db->from("quotation as q");
          $this->db->join('enquires as e','e.enquiry_id=q.enquiry_id');
          $this->db->where(array('e.customerid'=>$customer_id,'e.status'=>"1"));
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
          $this->db->select("q.quotation_id,q.quotation_date,q.enquiry_id,e.unique_id");
          $this->db->from("quotation as q");
          $this->db->join('enquires as e','e.enquiry_id=q.enquiry_id');
          $this->db->where(array('e.customerid'=>$customer_id,'e.status'=>"1"));
          $this->db->like('e.unique_id', $keyword);
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
             $this->db->select("q.quotation_id,q.quotation_date,q.enquiry_id,e.unique_id");
              $this->db->from("quotation as q");
              $this->db->join('enquires as e','e.enquiry_id=q.enquiry_id');
              $this->db->where(array('e.customerid'=>$customer_id,'e.status'=>"1"));
            $this->db->like('e.unique_id', $keyword);
            //$this->db->or_like('enquiry_placed_date', $keyword);
            $query = $this->db->get();
            return $query->num_rows();

        }//End of tot_search_rows()



}
/* End of file Quotation_model.php */
/* Location: ./application/models/Quotation_model.php */
