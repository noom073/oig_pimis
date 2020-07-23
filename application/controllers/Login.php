<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('authentication');
    }

	public function index() {
		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('login_view/login_index');
		$this->load->view('foundation_view/footer');
	}

	public function ajax_adlogin_process() {
		$this->load->model('auth_model');

		// echo json_encode($this->input->post());
		$rtarfMail = $this->input->post('email');
		$password = $this->input->post('password');

		$checkADReturn = $this->authentication->check_ad($rtarfMail, $password);

		// check user password SD
		if ($checkADReturn['status'] === true && $checkADReturn['http_code'] == 200) {
			$ADToken = json_decode($checkADReturn['response']);
			$checkTokenReturn = $this->authentication->check_token($ADToken->TOKEN);
			
			// check token
			if ($checkTokenReturn['status'] === true && $checkTokenReturn['http_code'] == 200) {
				$ADData = json_decode($checkTokenReturn['response']);
				$userType = $this->auth_model->get_user_type($ADData->EMAIL);

				// check privilege existence 
				if ($userType->num_rows() > 0) {
					$userData = $userType->row(); // return first row
					$sesData['usertype'] 	= $userData->TYPE_NAME; 
					$sesData['nameth'] 		= $ADData->BIOG_NAME; 
					$sesData['nameen'] 		= $ADData->BIOG_NAME_ENG; 
					$sesData['email'] 		= $ADData->EMAIL; 
					$sesData['mid'] 		= $ADData->BIOG_ID; 
					$sesData['cid'] 		= $ADData->REG_CID; 
					$sesData['isLogged']	= true; 
					$this->session->set_userdata($sesData);
	
					$result['status'] 	= true;
					$result['data']		= $sesData;
				} else {
					$result['status'] 		= false;
					$result['text']			= 'ไม่พบสิทธิผู้ใช้นี้';
					$result['http_code']	= 403;
				}
			} else {
				$result['status'] 		= false;
				$result['text']			= 'TOKEN นี้ ไม่พบข้อมูลผู้ใช้';
				$result['http_code']	= $checkTokenReturn['http_code'];
			}
		} else {
			$result['status'] 		= false;
			$result['text']			= 'Email หรือ Password ไม่ถูกต้อง';
			$result['curldata']		= $checkADReturn; // return http code and curl data
		}		

		echo json_encode($result);
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('login/index');
	}
}
