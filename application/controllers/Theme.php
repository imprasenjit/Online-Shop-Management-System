<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Theme extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
		$this->load->model('billing_model');
		$this->load->model('associated_brands_model');
		$this->load->helper('form');
    }
    public function theme1()
    {
       $this->load->view("themes/1/home");
    }
    public function theme2()
    {
       $this->load->view("themes/2/home");
    }
}