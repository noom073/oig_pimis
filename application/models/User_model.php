<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    var $oracle;

    public function __construct() {
        $this->oracle = $this->load->database('oracle', true);
    }

	public function get_user() {
        $result = $this->oracle->get('PIMIS_USER');

        return $result;
	}
}
