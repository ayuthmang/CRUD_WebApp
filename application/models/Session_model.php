<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/Base_model.php';

/**
* 
*/
class Session_model extends Base_model
{	
	function __construct()
	{
        parent::__construct();
	}

	function get_authen($username = '', $password = '') {
		
		if (!$username || !$password) {
			return false;
		}
		$sql = "select username, password from users where username = '$username'";
		$query = $this->db->query($sql);
		if ($query->num_rows() != 1) {
			return false;
		}

		return ($password == $query->row()->password);
	}
}