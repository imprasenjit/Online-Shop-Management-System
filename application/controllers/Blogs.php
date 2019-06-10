<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('blogs_model');
    }

    public function index() {
      $data = array("page" => "Blogs");
      $this->load->view('site/requires/header', $data);
      $this->load->view('site/blogs/blog_list');
      $this->load->view('site/requires/footer');
    }

//End of get_dtrecords()
}
