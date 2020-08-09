<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oig_service extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
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

    public function ajax_get_event_data()
    {
        $events = $this->sv_model->get_event_data()->result_array();

        $results = array_map(function ($r) {
            $data['title']  = $r['DEPARTMENT_NAME'];
            $data['start']  = date_format(date_create($r['INS_DATE']), 'Y-m-d');
            $data['end']    = date_format(date_create($r['FINISH_DATE']), 'Y-m-d');
            return $data;
        }, $events);
        echo json_encode($results);
    }

    public function ajax_get_subject()
	{
        $id = $this->input->post('inspection_id');
        $subject = $this->sv_model->get_subject($id)->result_array();
		echo json_encode($subject);
    }
    
    public function ajax_get_subject_one()
    {
        $subjectID = $this->input->post('subjectID');
        $result = $this->sv_model->get_subject_one($subjectID)->row_array();

        echo json_encode($result);
    }
}
