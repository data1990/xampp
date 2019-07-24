<?php 
class Users_model extends My_model
{
	function __construct()
	{
		parent::__construct();
		$this->table ='members';
	}
}
?>