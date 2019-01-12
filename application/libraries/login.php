<?php
class template {
protected $_ci;
function __construct()
{
	$this->_ci =&get_instance();
}

function display($template, $data=null)
{
	$this->_ci->load->view('/login.php',$data);
}
}