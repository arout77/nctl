<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

/**
 * CodeIgniter Extended Encryption Class
 *
 * An extension to CI's encryption class to provide PHP 5.5's password_hash() function
 *
 * @package CodeIgniter
 * @subpackage Extended libraries
 * @category Extended libraries
 * @author Andrew Rout
 * @link
 */

class MY_Encryption
{
	public function encrypt($string)
	{
		// Encrypt a submitted password using
		// default PHP encryption method
		$options = [
			'cost' => 14,
		];

		return password_hash($string, PASSWORD_DEFAULT, $options);
	}

	public function decrypt($string, $hashed_password)
	{
		if (password_verify($string, $hashed_password))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}

}