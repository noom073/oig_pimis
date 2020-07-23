<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Oig_service extends CI_Controller {

    function __construct()
    {
        parent:: __construct();
        $this->load->model('oig_service_model', 'sv_model');
    }

    public function service_get_unit()
    {
        $unit = $this->sv_model->get_unit_list()->result_array();
        echo json_encode($unit);
    }

    public function service_get_inspection()
    {
        $inspection = $this->sv_model->get_inspection()->result_array();
        echo json_encode($inspection);
    }
}