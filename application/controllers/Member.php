<?php

defined('BASEPATH') || exit('No direct script access allowed');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../../.env');
$dotenv->load();

class Member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_member');
		if (! $this->session->userdata('user_id')) {
			header('location:' . $_ENV['APP_HOST']);
		}
	}

	public function index()
	{
		$data_session = [
			'title'        => 'Member',
			'active_class' => 'member',
		];
		$this->session->set_userdata($data_session);
		$this->load->view('member/member_view');
	}

	public function find_members()
	{
		$list = $this->model_member->get_member_datatables();
		$data = [];
		$no   = $_POST['start'];
		$n    = 0;

		foreach ($list as $user) {
			$n++;
			$row    = [];
			$row[]  = $n;
			$row[]  = $user->member_name;
			$row[]  = $user->member_email;
			$row[]  = $user->member_telephone;
			$row[]  = $user->discount . ' %';
			$btn_edit   = $this->session->userdata('update') ? '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_member(' . "'" . $user->member_id . "'" . ')"><i class="far fa-edit"></i></a>' : '';
			$btn_delete = $this->session->userdata('delete') ? '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_member(' . "'" . $user->member_id . "'" . ')"><i class="far fa-trash-alt"></i></a>' : '';
			$row[]      = $btn_edit . ' ' . $btn_delete;
			$data[] = $row;
		}
		$output = [
			'draw'            => $_POST['draw'],
			'recordsTotal'    => $this->model_member->count_all(),
			'recordsFiltered' => $this->model_member->count_filtered(),
			'data'            => $data,
		];
		echo json_encode($output);
	}

	public function find_member($member_id)
	{
		$res = $this->model_member->find_member($member_id);
		echo json_encode($res);
	}

	public function save_member()
	{
		$data = [
			'member_name'      => $this->input->post('member_name'),
			'member_email'     => $this->input->post('member_email'),
			'member_telephone' => $this->input->post('member_telephone'),
			'discount'         => $this->input->post('discount'),
		];
		$res = $this->model_member->save_member($data);
		echo json_encode(
			[
				'status' => $res,
			]
		);
	}

	public function update_member()
	{
		$data = [
			'member_name'      => $this->input->post('member_name'),
			'member_email'     => $this->input->post('member_email'),
			'member_telephone' => $this->input->post('member_telephone'),
			'discount'         => $this->input->post('discount'),
			'updated_at'       => date('Y-m-d h:i:s'),
		];
		$res = $this->model_member->update_member($this->input->post('member_id'), $data);
		echo json_encode(
			[
				'status' => $this->input->post('member_id'),
			]
		);
	}
	public function hapus_member($id)
	{
		$this->model_member->delete_by_id($id);
		echo json_encode(['status' => true]);
	}
}
