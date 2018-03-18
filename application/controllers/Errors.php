<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller
{
	public function index()
	{
		$data['content'] = 'auth/access_denied';
		$this->load->view('template/main_content', $data);
	}

	public function access_denied()
	{
		$data['content'] = 'auth/access_denied';
		$this->load->view('template/main_content', $data);
	}
}