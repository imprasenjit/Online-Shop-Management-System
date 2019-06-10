<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('blogs_model');
        $this->load->library('cart');
        $this->load->model('billing_model');
        $this->load->model('products_model');
        $this->load->model('sub_category_model');
        $this->load->model('associated_brands_model');
        $this->load->model('feedback_model');
        $this->load->model('services_model');
        $this->load->model('home_page_slider_model');
        $this->load->helper('form');
        $this->load->helper('sendmail');
    }

    public function index() {
      $data = array("page" => "Blogs");
      $data['blogs']=$this->blogs_model->get_all();//var_dump($data['blogs']);die;
      $this->load->view('site/requires/header', $data);
      $this->load->view('site/blogs/blog_list',$data);
      $this->load->view('site/requires/footer');
    }
    public function blog_details($title,$id){
      $blog_data=$this->blogs_model->get_by_id($id);
      $data = array("page" => $blog_data->blog_title);
      $data['blog_details']=$blog_data;//var_dump($data['blog_details']);die;
      $this->load->view('site/requires/header', $data);
      $this->load->view('site/blogs/blog_details',$data);
      $this->load->view('site/requires/footer');
    }

//End of get_dtrecords()
}
