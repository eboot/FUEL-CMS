<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('base_module_model.php');

class Blocks_model extends Base_module_model {
	
	public $required = array('name');
	public $filters = array('description');
	
	public function __construct()
	{
		parent::__construct('blocks');
	}
	
	public function list_items($limit = NULL, $offset = NULL, $col = 'name', $order = 'desc')
	{
		$this->db->select('id, name, SUBSTRING(description, 1, 50) as description, SUBSTRING(view, 1, 150) as view, published', FALSE);
		$data = parent::list_items($limit, $offset, $col, $order);
		foreach($data as $key => $val)
		{
			$data[$key]['view'] = htmlentities($val['view'], ENT_QUOTES, 'UTF-8');
		}
		return $data;
	}
	
	public function form_fields()
	{
		$fields = parent::form_fields();
		$CI =& get_instance();
		$CI->load->helper('directory');
		$CI->load->helper('file');
		return $fields;
	}

}

class Block_model extends Base_module_record {
}
