<?php 
defined('BASEPATH') or exit ("No Direct Script Access Allowed");

	class Login extends CI_controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('User_model');
			$this->load->helper(array('url','form','html'));
		}

		function index(){
			$this->load->view('header');
			$this->load->view('navbar');
		    $this->load->view('User_login');
		    $this->load->view('footer');
		}
		 
		function auth(){
		    $email    = $this->input->post('email',TRUE);
		    $password = md5($this->input->post('password',TRUE));
		    $validate = $this->User_model->validate($email,$password);
		    if($validate->num_rows() > 0){
		        $data  = $validate->row_array();
		        $name  = $data['user_name'];
		        $email = $data['user_email'];
		        $level = $data['user_level'];
		        $sesdata = array(
		            'username'  => $name,
		            'email'     => $email,
		            'level'     => $level,
		            'logged_in' => TRUE
		        );
		        $this->session->set_userdata($sesdata);
		        // akses login untuk admin
		        if($level=='1'){
		            redirect('Halaman');
		 
		        // akses login untuk pelayan
		        }elseif($level=='2'){
		            redirect('Pelayan');
		 
		        // akses login untuk kasir
		        }else{
		            redirect('Kasir');
		        }
		    }else{
		        echo $this->session->set_flashdata('msg','Email atau Password tidak cocok');
		        redirect('Login');
		    }
		  }

		  function register(){
                
                $name = $this->input->post('name',true);
                $password=$this->input->post('password',true);
                $email=$this->input->post('email',true);
                $level = $this->input->post('level',true);
                               
                $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[6]|max_length[50]|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[32]|required');                
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
                $this->form_validation->set_rules('level', 'Tipe User', 'required');
                $this->form_validation->set_message('required','%s Harus Diisi.');

                if($this->form_validation->run()==FALSE){
                    $this->load->view('Login/Register');
                }
                else{
                    $data = array(
                        'user_name' => $name,
                        'password' => md5($password),
                        'user_email' => $email,
                        'user_level' => $level,

                    );
                    $this->User_model->save($data);

                    $alert["success"]="Akun Sukses Terdaftar!";                  
                    $this->load->view('Login/Register',$alert);
                    }
                    }
		 
		  function logout(){
		      $this->session->sess_destroy();
		      redirect('Home');
		  }
	}


?>