<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_user_model extends CI_Model
{
    var $oracle;

    public function __construct()
    {
        $this->oracle = $this->load->database('oracle', true);
    }

    public function get_inspection()
    {
        $this->oracle->order_by('INSPE_ID');
        $result = $this->oracle->get('PIMIS_INSPECTIONS');
        return $result;
    }

    public function get_inspection_row($id)
    {
        $this->oracle->where('INSPE_ID', $id);
        $this->oracle->order_by('INSPE_ID');
        $result = $this->oracle->get('PIMIS_INSPECTIONS');
        return $result;
    }

    public function insert_inspection($array)
    {
        $field['INSPE_NAME']    = $array['inp_name'];
        $field['INSPE_PARENT']  = $array['inp_parent'];
        $field['USER_UPDATE']   = $this->session->email;

        $date = date("Y-m-d H:i:s");
        $this->oracle->set('TIME_UPDATE', "TO_DATE('{$date}','YYYY/MM/DD HH24:MI:SS')", false);
        $result = $this->oracle->insert('PIMIS_INSPECTIONS', $field);

        return $result;
    }

    public function delete_inspection_row($array)
    {
        $this->oracle->where('INSPE_ID', $array['id']);
        $delete = $this->oracle->delete('PIMIS_INSPECTIONS');

        return $delete;
    }

    public function update_inspection($array)
    {
        $field['INSPE_NAME'] = $array['inp_name'];
        $field['INSPE_PARENT'] = $array['inp_parent'];

        $this->oracle->where('INSPE_ID', $array['id']);
        $update = $this->oracle->update('PIMIS_INSPECTIONS', $field);

        return $update;
    }

    public function add_subject($array)
    {        
        $this->oracle->set('SUBJECT_NAME', $array['subject_name']);
        $this->oracle->set('INSPECTION_ID', $array['inspection_id'], false);
        $this->oracle->set('TIME_UPDATE', "TO_DATE('{$array['time']}', 'YYYY-MM-DD HH24:MI:SS')", false);
        $this->oracle->set('USER_UPDATE', $array['userEmail']);

        $result = $this->oracle->insert('PIMIS_SUBJECT');
        return $result;
    }
}
