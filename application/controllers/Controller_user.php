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

	public function ajax_add_subject()
	{
		$data['subject_name'] 	= $this->input->post('subject_name');
		$data['inspection_id'] 	= $this->input->post('inspection_id');
		$data['order_subject']	= $this->input->post('order');
		$data['time']			= date('Y-m-d H:i:s');
		$data['userEmail']		= $this->session->email;

		$insert = $this->controller_user_model->add_subject($data);
		if ($insert) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลไม่สำเร็จ';
		}

		echo json_encode($result);
	}

	public function ajax_update_subject()
	{
		$data['subjectName'] 	= $this->input->post('subjectName');
		$data['subjectID'] 		= $this->input->post('subjectID');
		$data['subjectOrder']	= $this->input->post('subjectOrder');
		$data['subjectLevel']	= $this->input->post('level');
		$data['subjectParentID'] = $this->input->post('parentID');
		$data['time']			= date('Y-m-d H:i:s');
		$data['userEmail']		= $this->session->email;

		$update = $this->controller_user_model->update_subject($data);
		if ($update) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลไม่สำเร็จ';
		}
		echo json_encode($result);
	}

	public function subject_question($subjectID)
	{
		$data['subjectID'] = $subjectID;

		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('controller_user_view/controller_user_menu');
		$this->load->view('controller_user_view/question_subject_view', $data);
		$this->load->view('foundation_view/footer');
	}

	public function ajax_add_question()
	{
		$data['questionName'] 	= $this->input->post('questionName');
		$data['order'] 			= $this->input->post('order');
		$data['subjectID'] 		= $this->input->post('subjectID');
		$data['time']			= date('Y-m-d H:i:s');
		$data['userEmail']		= $this->session->email;
		$insert = $this->controller_user_model->insert_question($data);
		if ($insert) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'บันทึกข้อมูลไม่สำเร็จ';
		}

		echo json_encode($result);
	}

	public function ajax_update_question()
	{
		$data['questionName'] 	= $this->input->post('editQuestionName');
		$data['order'] 			= $this->input->post('editOrder');
		$data['questionID']		= $this->input->post('editQuestionID');
		$data['time']			= date('Y-m-d H:i:s');
		$data['userEmail']		= $this->session->email;
		$update = $this->controller_user_model->update_question($data);
		if ($update) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'บันทึกข้อมูลไม่สำเร็จ';
		}

		echo json_encode($result);
	}

	public function ajax_delete_subject()
	{
		$subjectID 	= $this->input->post('subjectID');
		$delete = $this->controller_user_model->dalete_subject($subjectID);
		if ($delete) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= false;
			$result['text'] 	= 'บันทึกข้อมูลไม่สำเร็จ';
		}

		echo json_encode($result);
	}

	public function ajax_add_sub_subject()
	{
		$data['subject_name'] 	= $this->input->post('subject_name');
		$data['inspection_id'] 	= $this->input->post('inspection_id');
		$data['parentID']		= $this->input->post('parentID');
		$data['order']			= $this->input->post('order');
		$data['level']			= $this->input->post('level');
		$data['time']			= date('Y-m-d H:i:s');
		$data['userEmail']		= $this->session->email;

		$insert = $this->controller_user_model->add_sub_subject($data);
		if ($insert) {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลเรียบร้อย';
		} else {
			$result['status'] 	= true;
			$result['text'] 	= 'บันทึกข้อมูลไม่สำเร็จ';
		}

		echo json_encode($result);
	}
}
