<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_controller.php';

/**
* 
*/
class Product_controller extends Base_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
	}
	function ajax_get_all_products()
	{
		$param = $this->get_params();
		$res = $this->Product_model->getProduct($param['prod_id']);
		if (!count($res)) {
			$res = $this->init_result(false);
			$res['status_code'] = Status::ERR_NO_PRODUCT_DATA;
			$res['status_message'] = Status::ERR_NO_PRODUCT_DATA_MSG;
			return $this->return_json($res);
		}

		$result = $this->init_result(!0);
		$result['data'] = $res;
		$res = null;
		return $this->return_json($result);
	}
}