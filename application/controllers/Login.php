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

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome');
		exit;
	}

	public function validate()
	{
		$this->load->library('Hash');
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
		$rows = count($query->row());

		if ($rows >= 1)
		{
			// Valid email / username, now check password
			foreach ($query->result_array() as $row)
			{
				if (!$this->hash->decrypt($this->input->post('password'), $row['password']))
				{
					// Password incorrect
					exit('Password does not match record found for this user');
				}

				// Email and passwords match; register the session now
				$this->session->set_userdata('username', $row['username']);
				$this->session->set_userdata('email', $row['email']);
				$this->session->set_userdata('is_admin', $row['is_admin']);

				if ($this->session->is_admin == 1)
				{
					redirect('admin/index');
					exit;
				}
				else
				{
					redirect('dashboard');
					exit;
				}

			}
		}

		// Email not valid
		exit('Invalid login credentials');
	}
}
