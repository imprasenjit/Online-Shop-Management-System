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

    public function index($tags=null) {

      $data = array("page" => "Blogs");
      if($tags){
        $data['blogs']=$this->blogs_model->get_all_by_tags($tags);//var_dump($data['blogs']);die;
      }else {
        $data['blogs']=$this->blogs_model->get_all();//var_dump($data['blogs']);die;
      }
      $data['search_term']='';
      $this->load->view('site/requires/header', $data);
      $this->load->view('site/blogs/blog_list',$data);
      $this->load->view('site/requires/footer');
    }
    public function search(){
      $data = array("page" => "Blogs");
      $search_term=$this->input->post('search');
      $data['blogs']=$this->blogs_model->get_all_by_search_term($search_term);//var_dump($data['blogs']);die;
      $data['search_term']=$search_term;
      $this->load->view('site/requires/header', $data);
      $this->load->view('site/blogs/blog_list',$data);
      $this->load->view('site/requires/footer');
    }
    public function blog_details($title,$id){
      $blog_data=$this->blogs_model->get_by_id($id);
      $blog_tags=$this->blogs_model->get_tags();

      $data = array("page" =>url_title(trim( $blog_data->blog_title), '-', TRUE));
      $data['blog_details']=$blog_data;//var_dump($data['blog_details']);die;
      $data['recent_blogs']=$this->blogs_model->get_recent_blogs();//var_dump($data['recent_blogs']);die;
      $data['tags']=$this->filter_tags($blog_tags);
      $this->load->view('site/requires/header', $data);
      $this->load->view('site/blogs/blog_details',$data);
      $this->load->view('site/requires/footer');
    }
    function filter_tags($data){
      $tags=array();
      if($data){
        foreach ($data as $key => $value) {
          $tag=$value->tags;
          if($tag){
            foreach (json_decode($tag) as $key => $t) {
              array_push($tags,$t->value);
            }
          }
        }
      }
      return $tags;
    }

//End of get_dtrecords()
}
