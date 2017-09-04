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
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Session_model');
	}

	function logout() {
		$this->session->sess_destroy();
		redirect(BASEURL . 'login');
	}

	function authen()
	{
		// https://stackoverflow.com/questions/18821492/code-igniter-how-to-return-json-response-from-controller
		$param = $this->get_params();
		$user = isset($param['acc_user']) ? $param['acc_user'] : false;
		$pass = isset($param['acc_pass']) ? $param['acc_pass'] : false;

		$res = $this->Session_model->get_authen($user, $pass);
		$result = $this->init_result($res);
		if (!$res) {
			$result['status_code'] = Status::ERR_AUTHEN_INVALID;
			$result['status_message'] = Status::ERR_AUTHEN_INVALID_MSG;
		} else {
			$result['redirect'] = 'create';
		}

		$userdata = array(
			'username' => $user,
		);
		$this->session->set_userdata($userdata);

		return $this->output
		            ->set_content_type('application/json')
		            ->set_status_header(200)
		            ->set_output(json_encode($result));
	}
}