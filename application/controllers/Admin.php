<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// if (!$name = $this->session->userdata('is_admin'))
		// {
		// 	redirect('errors/access_denied');
		// 	exit;
		// }

		$this->load->model('user_model');
	}

	public function index()
	{
		$data['content'] = 'register/index';
		$this->load->view('template/main_content', $data);
	}

	public function signup_submit()
	{
		$this->load->library('encryption');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');
		$email = $this->input->post('email');
		$is_admin = $this->input->post('is_admin') ?? 0;

		// if ($password !== $confirm_password || empty($username) || empty($password) || empty($email))
		// {
		// 	exit('0');
		// }

		$password = $this->encryption->encrypt($password);

		$this->user_model->create_new_user($username, $password, $email, $is_admin);

		exit('1');
	}
}
