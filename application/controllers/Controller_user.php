<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_user extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('authentication');

		$this->load->model('controller_user_model');

		$isLogged = $this->authentication->check_type_user('admin');
		if ($isLogged == false) {
			$this->authentication->go_home();
		}
	}

	public function index()
	{
		$data['inpData'] = $this->controller_user_model->get_inspection()->result_array();
		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('controller_user_view/controller_user_menu');
		// $this->load->view('controller_user_view/controller_user_navbar');
		// $this->load->view('controller_user_view/controller_user_nav/inspection_nav');
		$this->load->view('controller_user_view/controller_user_index', $data);
		$this->load->view('foundation_view/footer');
	}

	public function ajax_get_inspection()
	{
		$data = $this->controller_user_model->get_inspection();
		$checkRow = $data->num_rows();
		$result = $checkRow > 0 ? $data->result_array() : [];

		echo json_encode($result);
	}

	public function ajax_add_inspection()
	{
		$postArray = $this->input->post();
		$insert = $this->controller_user_model->insert_inspection($postArray);

		if ($insert) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'บันทึกข้อมูลไม่ได้';
		}

		echo json_encode($result);
	}

	public function ajax_get_inspection_row()
	{
		$id = $this->input->post('id');
		$data['ins_row'] = $this->controller_user_model->get_inspection_row($id)->row_array();
		$data['all_ins'] = $this->controller_user_model->get_inspection()->result_array();
		echo json_encode($data);
	}

	public function ajax_delete_inspection_row()
	{
		$postArray = $this->input->post();
		$delete = $this->controller_user_model->delete_inspection_row($postArray);

		if ($delete) {
			$result['status'] 	= true;
			$result['text'] 	= 'ลบข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'ลบข้อมูลไม่ได้';
		}
		echo json_encode($result);
	}

	public function ajax_update_insprection()
	{
		$postArray = $this->input->post();
		$update = $this->controller_user_model->update_inspection($postArray);

		if ($update) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'บันทึกข้อมูลไม่ได้';
		}
		echo json_encode($result);
	}

	public function list_inspecting()
	{
		$data = '';
		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('controller_user_view/controller_user_menu');
		$this->load->view('controller_user_view/controller_user_list_inspecting', $data);
		$this->load->view('foundation_view/footer');
	}

	public function ajax_insert_inspection_event()
	{
		echo json_encode($this->input->post());
	}

	public function subject_inspection()
	{
		$data = '';
		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('controller_user_view/controller_user_menu');
		$this->load->view('controller_user_view/subject_inspection_view', $data);
		$this->load->view('foundation_view/footer');
	}

}
