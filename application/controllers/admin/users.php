<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class users extends CI_Controller {

    function __construct(){
                parent::__construct();
                $this->load->helper(array('url','form','html'));
                $this->load->library(array('table'));
                $this->load->library(array('form_validation'));
                $this->load->library('pagination');
                $this->load->helper('string');   ;
                $this->load->model('user_model','',true);
                $this->load->model('ec_model','',true);
                $this->load->library('email');
                $this->load->library('template_admin');
                $this->is_logged_in();
                $this->check_level();
                }

     function is_logged_in(){
				$is_logged_in=$this->session->userdata('is_logged_in');
					if(!isset($is_logged_in)||$is_logged_in!= true) {
					redirect(base_url());
					} 
				}

    function check_level(){
                $level=$this->session->userdata('level');
                    if($level != 'admin') {
                    redirect('home');
                    } 
                }

	function all_user_umum($offset=0)
        {
             $jumlah_data = $this->user_model->total_user_umum();
             $config['base_url'] = base_url().'admin/users/all_user_umum';
             $config['total_rows'] = $jumlah_data;
             $config['per_page'] = 4;
             $config['uri_segment'] = '4';
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
             $page_num =  ($this->uri->segment(4,1)-1)*$config['per_page'];

             $query= $this->user_model->getalluserumum(4,$page_num);
             $data['rows'] = null;

                    if($query){
                       $data['rows'] = $query;
                      }
             $this->template_admin->display('admin/users/all_user_umum',$data);


        }



        function all_event_creators($offset=0)
        {
             $jumlah_data = $this->ec_model->total_event_creator();
             $config['base_url'] = base_url().'admin/users/all_event_creators';
             $config['total_rows'] = $jumlah_data;
             $config['per_page'] = 4;
             $config['uri_segment'] = '4';
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
             $page_num =  ($this->uri->segment(4,1)-1)*$config['per_page'];

             $query= $this->ec_model->getalleventcreator(4,$page_num);
             $data['rows'] = null;

                    if($query){
                       $data['rows'] = $query;
                      }
             $this->template_admin->display('admin/users/all_event_creators',$data);


        }

        function update_user_umum($user_id){
            $this->form_validation->set_rules('name', '*Nama', 'trim|required|min_length[6]|max_length[50]|xss_clean'); 
            $this->form_validation->set_rules('email', '*Email', 'trim|required|valid_email|max_length[30]|xss_clean');  
            $this->form_validation->set_rules('phone', '*Nomor Telepon', 'trim|required|min_length[5]|max_length[50]|xss_clean');
            $this->form_validation->set_rules('address', '*Alamat', 'trim|required|min_length[6]|max_length[100]|xss_clean'); 
            $this->form_validation->set_message('required','%s Harus Diisi.');

            if ($this->form_validation->run() == TRUE) {
                    $this->user_model->update_user_umum($user_id);
                    $this->session->set_flashdata('success', 'Data User berhasil di update!'); 
                    redirect('admin/users/all_user_umum');
                } 
                $data['users']=$this->user_model->getbyuserid($user_id);
                $this->template_admin->display('admin/users/update_user_umum',$data);
        }

        function update_event_creator($user_id){
            $this->form_validation->set_rules('name', '*Nama', 'trim|required|min_length[6]|max_length[50]|xss_clean'); 
            $this->form_validation->set_rules('email', '*Email', 'trim|required|valid_email|max_length[30]|xss_clean');  
            $this->form_validation->set_rules('phone', '*Nomor Telepon', 'trim|required|min_length[5]|max_length[50]|xss_clean');
            $this->form_validation->set_rules('address', '*Alamat', 'trim|required|min_length[6]|max_length[100]|xss_clean'); 
            $this->form_validation->set_message('required','%s Harus Diisi.');

            if ($this->form_validation->run() == TRUE) {
                    $this->ec_model->update_event_creator($user_id);
                    $this->session->set_flashdata('success', 'Data User berhasil di update!'); 
                    redirect('admin/users/all_event_creators');
                } 
                $data['users']=$this->ec_model->getbyuserid($user_id);
                $this->template_admin->display('admin/users/update_event_creator',$data);
        }

        function delete_user_umum ($user_id){
                $this->user_model->delete_user_umum($user_id); 
                redirect('admin/users/all_user_umum');            
            }

        function delete_event_creator ($user_id){
                $this->ec_model->delete_event_creator($user_id); 
                redirect('admin/users/all_user_umum');            
            }


}

?>
