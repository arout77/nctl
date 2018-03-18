<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function create_new_user($username, $password, $email, $is_admin)
	{
		$sql = "INSERT INTO users(username, password, email, is_admin) VALUES(?,?,?,?)";
		return $this->db->query($sql, array($username, $password, $email, $is_admin));
	}

}