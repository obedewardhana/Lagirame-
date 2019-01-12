<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class how_to extends CI_Controller {

	function __construct(){
				parent::__construct();
				$this->load->helper(array('url','form','html'));
				$this->load->library('form_validation');
				$this->load->model('event_model','',true);
				$this->load->model('user_model','',true);
				$this->load->model('category_model','',true);
				$this->load->library('session');		
				$this->load->library('upload');
				//$this->is_logged_in();
				}

	function index()
	{
		//$data['rows']=$this->event_model->getallevent();
		$this->template->display('how_to');
	}



			
	
	
	
}


	
	