<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Oig_service_model extends CI_Model {
    var $oracle;

    public function __construct()
    {
        $this->oracle = $this->load->database('oracle', true);
    }

    public function get_unit_list() {
        $excludeUnit = array('6000000000', '6001000000');
        $this->oracle->select('NPRT_ACM, NPRT_UNIT');
        $this->oracle->where_not_in('NPRT_UNIT', $excludeUnit);
        $this->oracle->where("NPRT_UNIT like substr(NPRT_UNIT,1,4) || '000000'");
        $this->oracle->order_by("NPRT_ACM");
        $result = $this->oracle->get("PER_NPRT_TAB");

        return $result;
    }

    public function get_inspection()
    {
        $this->oracle->select('INSPE_NAME, INSPE_ID');
        $result = $this->oracle->get("PIMIS_INSPECTIONS");

        return $result;
    }

    public function get_inspection_one($inspectionID)
    {
        $this->oracle->select('INSPE_NAME, INSPE_ID');
        $this->oracle->where('INSPE_ID', $inspectionID);
        $result = $this->oracle->get("PIMIS_INSPECTIONS");

        return $result;
    }

    public function get_event_data()
    {
        $this->oracle->select('pp.INS_DATE, pp.FINISH_DATE, pu.DEPARTMENT_NAME');
        $this->oracle->join('PITS_UNIT pu', 'pp.INS_UNIT = pu.ID');
        $result = $this->oracle->get('PITS_PLAN pp');

        return $result;
    }

    public function get_subject($inspection_id)
    {
        $this->oracle->select('SUBJECT_ID, SUBJECT_NAME');
        $this->oracle->where('INSPECTION_ID', $inspection_id);
        $this->oracle->order_by('SUBJECT_ORDER');
        $result = $this->oracle->get('PIMIS_SUBJECT');

        return $result;
    }

    public function get_subject_one($subjectID)
    {
        $this->oracle->select('SUBJECT_ID, SUBJECT_NAME, INSPECTION_ID, SUBJECT_ORDER');
        $this->oracle->where('SUBJECT_ID', $subjectID);
        $result = $this->oracle->get('PIMIS_SUBJECT');

        return $result;
    }

    public function get_questions($subjectID)
    {
        $this->oracle->where('SUBJECT_ID', $subjectID);
        $this->oracle->order_by('Q_ORDER');
        $result = $this->oracle->get('PIMIS_QUESTION');

        return $result;
    }

    public function get_question_one($questionID)
    {
        $this->oracle->where('Q_ID', $questionID);
        $result = $this->oracle->get('PIMIS_QUESTION');

        return $result;
    }
}