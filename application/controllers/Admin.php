<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('authentication');

		$isLogged = $this->authentication->check_type_user('admin');
		if ($isLogged == false) {
			$this->authentication->go_home();
		}
	}

	public function index()
	{
		redirect('admin/manage_user');
	}

	public function manage_user()
	{
		$this->load->model('admin_model');
		$res['types'] = $this->admin_model->get_type_users()->result_array();

		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('admin_view/admin_menu');
		$this->load->view('admin_view/admin_list_user', $res);
		$this->load->view('foundation_view/footer');
	}

	public function ajax_get_user()
	{
		$this->load->model('admin_model');
		$user = $this->admin_model->get_user();

		$res['user'] = $user->num_rows() > 0 ? $user->result_array() : [];
		echo json_encode($res);
	}

	public function ajax_get_user_detail()
	{
		$this->load->model('admin_model');
		$data = $this->input->post();
		$res['user'] = $this->admin_model->get_user_detail($data)->row_array();
		$res['types'] = $this->admin_model->get_type_users()->result_array();
		echo json_encode($res);
	}

	public function ajax_update_user()
	{
		$this->load->model('admin_model');
		$data = $this->input->post();
		$update = $this->admin_model->update_user($data);

		if ($update) {
			$result['status'] 	= true;
			$result['text'] 	= 'Update complete';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'Cannot update user';
		}

		echo json_encode($result);
	}

	public function ajax_add_user()
	{
		$this->load->model('admin_model');
		$register = $this->input->post();
		$chkDuplicateUser = $this->admin_model->check_user($register['email']);
		if ($chkDuplicateUser->num_rows() == 0) {
			$insert = $this->admin_model->add_user($register);

			if ($insert) {
				$result['status'] 	= true;
				$result['text'] 	= 'Insert complete';
			} else {
				$result['status'] 	= false;
				$result['text'] 	= 'Cannot Insert user';
			}
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'Duplicate Email';
		}

		echo json_encode($result);
	}

	public function ajax_delete_user()
	{
		$this->load->model('admin_model');
		$data = $this->input->post();
		$delete = $this->admin_model->delete_user($data['email']);

		if ($delete) {
			$result['status'] 	= true;
			$result['text'] 	= 'Delete complete';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'Cannot delete user';
		}

		echo json_encode($result);
	}
}
