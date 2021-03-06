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

        // $results = array_map(function ($r) {
        //     $data['title']  = $r['DEPARTMENT_NAME'];
        //     $data['start']  = date_format(date_create($r['INS_DATE']), 'Y-m-d');
        //     $data['end']    = date_format(date_create($r['FINISH_DATE']), 'Y-m-d');
        //     return $data;
        // }, $events);
        $results = array_map(function ($r) {
            $data['idplan'] = $r['PID'];
            $data['title']  = $r['DEPARTMENT_NAME'];
            $data['start']  = date_format(date_create($r['INS_DATE']), 'Y-m-d');
            $date_end       = date_add(date_create($r['FINISH_DATE']), date_interval_create_from_date_string("1 days"));
            $data['end']    = date_format($date_end, 'Y-m-d');
            $data['backgroundColor'] = ($r['SET'] == 1 ? '' : 'green');
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

    public function ajax_get_subject_and_inspection_by_subject()
    {
        $subjectID = $this->input->post('subjectID');
        $subject = $this->sv_model->get_subject_one($subjectID)->row_array();

        $inspection = $this->sv_model->get_inspection_one($subject['INSPECTION_ID'])->row_array();

        $result['SUBJECT'] = $subject;
        $result['INSPECTION'] = $inspection;

        echo json_encode($result);
    }

    public function ajax_get_question()
    {
        $subjectID = $this->input->post('subjectID');
        $questions = $this->sv_model->get_questions($subjectID)->result_array();

        echo json_encode($questions);
    }

    public function ajax_get_question_one()
    {
        $questionID = $this->input->post('questionID');
        $questions = $this->sv_model->get_question_one($questionID)->row_array();

        echo json_encode($questions);
    }
}
