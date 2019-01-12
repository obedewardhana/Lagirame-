<?php 
	if ( ! defined('BASEPATH'))
	exit('No Direct Script Access Allowed');

	class event extends CI_Controller {
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
				}



			function eventdetails($event_id){
			    	$data['events']=$this->event_model->getById($event_id);
					$this->template->display('event/details',$data);
			    }

			function search(){
				$searchevents       =   $this->input->post('searchevents');
				$data['hasil']     =   $this->event_model->search($searchevents);

					if ($data['hasil'] =   $this->event_model->search($searchevents))
						  {
						  $data['jumlah'] = $this->event_model->totalsearch($searchevents);
						  $data['searchevents'] = $searchevents;
						  $this->template->display('event/search_result',$data);
						  }
						else
						  {
						  $this->session->set_flashdata('error', 'Maaf, kami tidak menemukan event yang anda cari.');	
				            //$this->template->display('user/my_account',$alert);
		                	redirect('home');
						  //$this->template->display('pegawai/tidak_ketemu');
						  }
						  
						if(empty($_POST['searchevents']))
						  {
						  redirect('home');
						  }
			}



				    function categories($category_id){
				    	$data['categories']=$this->event_model->getbycategoryid($category_id);
				    	$data['catename']=$this->category_model->getnamebyid($category_id);
						$this->template->display('event/categories',$data);
				    }

				    function types($type){
				    	$data['types']=$this->event_model->getbytype($type);
				    	$data['typename']=$this->event_model->getbytypename($type);
						$this->template->display('event/types',$data);
				    }

				    
			


		
	
						

						  
}

	
//localhost/belajarCI/index.php/blog
//localhost/belajarCI/index.php/blog/komentar
/* End of file Blog.php */
/* Location:  */