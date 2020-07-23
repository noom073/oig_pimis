<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    var $oracle;

    public function __construct() {
        $this->oracle = $this->load->database('oracle', true);
    }

	public function get_user() {
        $this->oracle->select('a.EMAIL, a.NAME, a.USER_ACTIVE, b.TYPE_NAME');
        $this->oracle->join('PIMIS_USER_TYPE b', 'a.USER_TYPE = b.TYPE_ID');
        $result = $this->oracle->get('PIMIS_USER a');

        return $result;
    }
    
    public function get_user_detail($data) {
        $this->oracle->where('EMAIL', $data['email']);
        $result = $this->oracle->get('PIMIS_USER');
        return $result;
    }

    public function get_type_users() {
        $result = $this->oracle->get('PIMIS_USER_TYPE');
        return $result;
    }

    public function update_user($array) {
        $field['NAME']          = $array['name'];
        $field['USER_TYPE']     = $array['type_user'];
        $field['USER_ACTIVE']   = $array['user_active'];
        $field['USER_UPDATE']   = $this->session->email;

        $date   = date("Y-m-d H:i:s");
        $this->oracle->set('TIME_UPDATE',"TO_DATE('{$date}','YYYY/MM/DD HH24:MI:SS')",false);
        $this->oracle->where('EMAIL', $array['email']);
        $result = $this->oracle->update('PIMIS_USER', $field);

        return $result;
    }

    public function check_user($email) {
        $this->oracle->where('EMAIL', $email);
        $result = $this->oracle->get('PIMIS_USER');

        return $result;
    }

    public function add_user($array) {
        $field['EMAIL']         = $array['email'];
        $field['NAME']          = $array['name'];
        $field['USER_TYPE']     = $array['type_user'];
        $field['USER_ACTIVE']   = $array['user_active'];
        $field['USER_UPDATE']   = $this->session->email;
        
        $date   = date("Y-m-d H:i:s");
        $this->oracle->set('TIME_UPDATE',"TO_DATE('{$date}','YYYY/MM/DD HH24:MI:SS')",false);
        $result = $this->oracle->insert('PIMIS_USER', $field);

        return $result;
    }

    public function delete_user($email) {
        $this->oracle->where('EMAIL', $email);
        $result = $this->oracle->delete('PIMIS_USER');

        return $result;
    }
}
