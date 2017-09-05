<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/Base_model.php';

/**
* 
*/
class Product_model extends Base_model
{
	function isProductExist($prod_id)
	{
		# code...
	}

	function getProduct($prod_id = 'all')
	{
		if ($prod_id === 'all') {
			$this->db->select('*');
			$this->db->from('products');
			return $this->db->get()->result_array();
		}
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('prod_id', $prod_id);
		return $this->db->get()->result_array();
	}
}