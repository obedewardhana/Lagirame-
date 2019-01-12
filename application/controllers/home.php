<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	function __construct(){
				parent::__construct();
				$this->load->helper(array('url','form','html'));
				$this->load->library('form_validation');
				$this->load->model('event_model','',true);
				$this->load->model('user_model','',true);
				$this->load->model('category_model','',true);
				$this->load->library('session');		
				$this->load->library('upload');
				$this->load->library('cart');
				$this->load->library('pagination');
				//$this->is_logged_in();
				}

	function index()
	{
		$this->page();
	}



	function syarat_ketentuan()
	{
		$this->template->display('syarat_ketentuan');
	}


    function page($offset=0)
		{
			 $jumlah_data = $this->event_model->total_event();
		     $config['base_url'] = base_url().'home/page/';
			 $config['total_rows'] = $jumlah_data;
			 $config['per_page'] = 6;
			 $config['uri_segment'] = '3';
			 $config['use_page_numbers'] = TRUE;

		    		  $config['full_tag_open'] = '<ul class="pagination">';
                      $config['full_tag_close'] = '</ul>';
                      $config['first_link'] = false;
                      $config['last_link'] = false;
                      $config['first_tag_open'] = '<li>';
                      $config['first_tag_close'] = '</li>';
                      $config['prev_link'] = '&laquo';
                      $config['prev_tag_open'] = '<li class="prev">';
                      $config['prev_tag_close'] = '</li>';
                      $config['next_link'] = '&raquo';
                      $config['next_tag_open'] = '<li>';
                      $config['next_tag_close'] = '</li>';
                      $config['last_tag_open'] = '<li>';
                      $config['last_tag_close'] = '</li>';
                      $config['cur_tag_open'] = '<li class="active"><a href="#">';
                      $config['cur_tag_close'] = '</a></li>';
                      $config['num_tag_open'] = '<li>';
                      $config['num_tag_close'] = '</li>';

			 $this->pagination->initialize($config);
			 $page_num =  ($this->uri->segment(3,1)-1)*$config['per_page'];

			 $query= $this->event_model->getallevent(6,$page_num);
			 $data['rows'] = null;

					if($query){
					   $data['rows'] = $query;
					  }
			 $this->template->display('home',$data);


        }


	
	
	
}


	
	