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

	function ajax_add_product()
	{
		$param = $this->get_params();
		$prod = array(
			'name' => $param['prod_name'],
			'detail' => $param['prod_detail'],
			'picture' => isset($param['prod_picture']) ? $param['prod_picture'] : false,
			'price' => isset($param['prod_price']) ? $param['prod_price'] : 0,
			'piece' => isset($param['prod_piece']) ? $param['prod_piece'] : 0,
		);
		$this->_toast_not_die($prod);
		if ($this->isProductExist($prod['name'])) {
			$result = $this->init_result(false);
			$result['status_code'] = Status::ERR_PRODUCT_DUPLICATE;
			$result['status_message'] = Status::ERR_PRODUCT_DUPLICATE_MSG;
			return $this->return_json($result);
		}
		$res = $this->Product_model->addProduct($prod);

		return $this->return_json($this->init_result($res));
	}

	function isProductExist($prod_name)
	{
		return $this->Product_model->isProductExist($prod_name);
	}
}