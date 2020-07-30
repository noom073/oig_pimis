<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Premise extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
		$this->load->library('session');
    }

    public function index()
    {
        $this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('premise_view/premise_index');
		$this->load->view('foundation_view/footer');
    }
}
