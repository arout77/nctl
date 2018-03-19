<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->username)
		{
			redirect('login/index');
			exit;
		}

		$this->load->model('user_model');
	}

	public function index()
	{
		$data['content'] = 'register/index';
		$this->load->view('template/main_content', $data);
	}
}
