<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Home extends Aipl_admin {
    function __construct() {
        parent::__construct();
    }//End of __construct()

    function index() {
        redirect(site_url("admin/login"));
    }//End of index()
    function supplier() {
        redirect(site_url("admin/login/supplier"));
    }//End of index()
    function warehouse() {
        redirect(site_url("admin/login/warehouse"));
    }//End of index()

}//End of Home
