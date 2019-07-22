<?php 
class Member_model extends My_model
{
	function __construct()
	{
		parent::__construct();
		$this->table ='members';
	}
}
?>