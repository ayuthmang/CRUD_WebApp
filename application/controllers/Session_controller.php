<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_controller.php';

/**
* 
*/
class Session_controller extends Base_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Session_model');
	}

	function login()
	{

	}

	function authen()
	{
		// https://stackoverflow.com/questions/18821492/code-igniter-how-to-return-json-response-from-controller
		$param = $this->get_params();
		$user = $param['acc_user'];
		$pass = $param['acc_pass'];

		// echo !'';

		$res = $this->Session_model->get_authen($user, $pass);
		$result = $this->init_result($res);
		return $this->output
		            ->set_content_type('application/json')
		            ->set_status_header(200)
		            ->set_output(json_encode($result));
	}
}