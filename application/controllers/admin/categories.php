<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class categories extends CI_Controller {

    function __construct(){
                parent::__construct();
                $this->load->helper(array('url','form','html'));
                $this->load->library(array('table'));
                $this->load->library(array('form_validation'));
                $this->load->library('pagination');
                $this->load->helper('string');   ;
                $this->load->model('user_model','',true);
                $this->load->model('ec_model','',true);
                $this->load->model('event_model','',true);
                $this->load->model('category_model','',true);
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


    function all_categories($offset=0)
        {
             $jumlah_data = $this->category_model->total_categories();
             $config['base_url'] = base_url().'admin/categories/all_categories';
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

             $query= $this->category_model->getallcategory(4,$page_num);
             $data['rows'] = null;

                    if($query){
                       $data['rows'] = $query;
                      }
             $this->template_admin->display('admin/categories/all_categories',$data);


        }

        function delete_category ($category_id){
                $this->category_model->delete_category($category_id); 
                redirect('admin/categories/all_categories');            
            }


        function update_category($category_id){
                    $this->form_validation->set_rules('name', '*Nama', 'trim|required|max_length[50]|xss_clean'); 
                if ($this->form_validation->run() == TRUE) {
                    $this->category_model->update_category($category_id);
                    $this->session->set_flashdata('success', 'Data Kategori berhasil di update!'); 
                    redirect('admin/categories/all_categories');
                } 
                $data['categories']=$this->category_model->getbyid($category_id);
                $this->template_admin->display('admin/categories/update_categories',$data);
        }


        function add_category(){
                $name = $this->input->post('name',true);
                $this->form_validation->set_rules('name', '*Nama', 'trim|required|max_length[50]|xss_clean'); 

                if ($this->form_validation->run() == TRUE) {
                    $data = array(
                                'name' => $name,
                                );
                    $this->category_model->save($data);
                    $this->session->set_flashdata('success', 'Data Kategori berhasil di tambahkan!'); 
                    redirect('admin/categories/all_categories');
                } 

                $this->template_admin->display('admin/categories/add_category');
        }



}

?>
