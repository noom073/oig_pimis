<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_page extends CI_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
        $this->load->library('session');
    }

	public function page_not_found() {
        $this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('error_view/404-not-found');
		$this->load->view('foundation_view/footer');		
	}
}
