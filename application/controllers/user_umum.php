<?php 
	if ( ! defined('BASEPATH'))
	exit('No Direct Script Access Allowed');

	class user_umum extends CI_Controller {
			function __construct(){
				parent::__construct();
				$this->load->helper(array('url','form','html'));
				$this->load->library('form_validation');
				$this->load->model('event_model','',true);
				$this->load->model('user_model','',true);
				$this->load->model('category_model','',true);
				$this->load->model('order_model','',true);
				$this->load->library('session');		
				$this->load->library('upload');
				$this->load->library('cart');
				$this->is_logged_in();
				}

			function is_logged_in(){
				$is_logged_in=$this->session->userdata('is_logged_in');
					if(!isset($is_logged_in)||$is_logged_in!= true) {
					redirect(base_url());
					} 
				}


			function my_account() {
				$this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[6]|max_length[50]|xss_clean');                
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');   
                $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim|required|min_length[5]|max_length[50]|xss_clean');
                $this->form_validation->set_rules('address', 'Alamat', 'trim|required|min_length[6]|max_length[30]|xss_clean'); 
                if ($this->input->post('password')):		        	               
                	$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[32]|required'); 
                	$this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|required|matches[password]');
		      		endif;
                $this->form_validation->set_message('required','%s Harus Diisi.');


                 if ($this->form_validation->run() == TRUE) {
		           	$this->user_model->update($this->session->userdata('user_id'));
		            //$alert["success"]="Data Anda telah terupdate!";   
		            $this->session->set_flashdata('success', 'Data Anda berhasil di update!');	
		            //$this->template->display('user/my_account',$alert);
                	redirect('user_umum/my_account');
		        } 
				$uid=$this->session->userdata('user_id');
		        $data['user']=$this->user_model->getbyid($uid);
		        $this->template->display('user/my_account',$data);
			}

			function update() {

                $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[6]|max_length[50]|xss_clean');                
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');   
                $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim|required|min_length[5]|max_length[50]|xss_clean');
                $this->form_validation->set_rules('address', 'Alamat', 'trim|required|min_length[6]|max_length[30]|xss_clean'); 
                if ($this->input->post('password')):		        	               
                	$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[32]|required'); 
                	$this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|required|matches[password]');
		      		endif;
                $this->form_validation->set_message('required','%s Harus Diisi.');


                 if ($this->form_validation->run() == TRUE) {
		           	$this->user_model->update($this->session->userdata('user_id'));
		            $this->session->set_flashdata('success', 'Data Anda berhasil di update!');	
                	redirect('user_umum/my_account');
		        } elseif ($this->form_validation->run()==FALSE) {
		        	$this->template->display('user/my_account',$data);
		        }

			}





	
						

						  
}

	
//localhost/belajarCI/index.php/blog
//localhost/belajarCI/index.php/blog/komentar
/* End of file Blog.php */
/* Location:  */