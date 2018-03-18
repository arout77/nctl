<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 * 	- or -
	 * 		http://example.com/index.php/welcome/index
	 * 	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['content'] = 'login/index';
		$this->load->view('template/main_content', $data);
	}

	public function validate()
	{
		$this->load->library('MY_Encryption');
		if (strpos($this->input->post('username'), '@'))
		{
			// Email login
			$sql = "SELECT username, password, email, is_admin
					FROM users
					WHERE email = ?";
		}
		else
		{
			// Username login
			$sql = "SELECT username, password, email, is_admin
					FROM users
					WHERE username = ?";
		}

		$query = $this->db->query($sql, array($this->input->post('username')));

		if ($query)
		{
			// Valid email / username, now check password
			foreach ($query->result_array() as $row)
			{
				if (!$this->encryption->decrypt($_POST['password'], $row['password']))
				{
					// Password incorrect
					redirect('login/?error');
					exit;
				}
				else
				{
					// Email and passwords match; register the session now
					$this->session->set_userdata('username', $row['username']);
					$this->session->set_userdata('email', $row['email']);
					$this->session->set_userdata('is_admin', $row['is_admin']);
					// $this->session->set_userdata('first_name', $row['first_name']);
					// $this->session->set_userdata('last_name', $row['last_name']);
					// $this->session->set_userdata('full_name', $row['first_name'] . ' ' . $row['last_name']);
					redirect('dashboard');
					exit;
				}
			}
		}
		else
		{
			// Email not valid
			exit('Invalid username / email');
		}
	}
}
