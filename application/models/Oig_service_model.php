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
}