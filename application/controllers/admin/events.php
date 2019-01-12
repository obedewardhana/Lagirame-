<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class events extends CI_Controller {

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


    function all_events($offset=0)
        {
             $jumlah_data = $this->event_model->total_event();
             $config['base_url'] = base_url().'admin/events/all_events';
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

             $query= $this->event_model->getallevents(4,$page_num);
             $data['rows'] = null;

                    if($query){
                       $data['rows'] = $query;
                      }
             $this->template_admin->display('admin/events/all_events',$data);


        }

        function detail_event($event_id){
                    $data['events']=$this->event_model->getById($event_id);
                    $this->template_admin->display('admin/events/event_detail',$data);
                }


        function update_status($event_id){

                        $this->event_model->update_status($event_id);
                        $this->session->set_flashdata('success', 'Data Event berhasil di update!'); 
                        redirect('admin/events/all_events');
                       
                        $this->template_admin->display('admin/events/all_events');
                }

        function update_capacity($event_id){
                        $this->form_validation->set_rules('capacity', '*Kapasitas', 'trim|required|max_length[50]|xss_clean');
                        if ($this->form_validation->run() == TRUE) { 
                        $this->event_model->update_capacity($event_id);
                        $this->session->set_flashdata('success', 'Data Event berhasil di update!'); 
                        redirect('admin/events/all_events');
                       }
                        $this->template_admin->display('admin/events/all_events');
                }

        function delete_event ($event_id){
                $this->event_model->delete_event($event_id); 
                redirect('admin/events/all_events');            
            }

        function search(){
              $search      =   $this->input->post('search');
              $data['hasil']     =   $this->event_model->searchevents($search);

                if ($data['hasil'] =   $this->event_model->searchevents($search))
                    {
                    $data['jumlah'] = $this->event_model->total_event($search);
                    $data['search'] = $search;
                    $this->template->display('admin/events/search_result',$data);
                    }
                  else
                    {
                    $this->session->set_flashdata('error', 'Maaf, kami tidak menemukan event yang anda cari.'); 
                    redirect('admin/events/all_events');
                    }
                    
                  if(empty($_POST['searchevents']))
                    {
                    redirect('admin/events/all_events');
                    }
          }



}

?>
