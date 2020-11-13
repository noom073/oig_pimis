<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_data
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
    }

    
}
