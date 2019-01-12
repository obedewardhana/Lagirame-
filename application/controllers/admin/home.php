<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class home extends CI_Controller {

    function __construct(){
                parent::__construct();
                $this->load->helper(array('url','form','html'));
                $this->load->library(array('table'));
                $this->load->library(array('form_validation'));
                $this->load->library('pagination');
                $this->load->helper('string');   ;
                $this->load->model('user_model','',true);
                $this->load->model('event_model','',true);
                $this->load->model('category_model','',true);
                $this->load->model('order_model','',true);
                $this->load->model('confirmation_model','',true);
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

	function index() {

        $data['acaras'] = $this->event_model->total_event();
        $data['kategoris'] = $this->category_model->total_categories();
        $data['penggunas'] = $this->user_model->total_users();
        $data['pesanans'] = $this->order_model->total_orders();

        $uid=$this->session->userdata('user_id');
        $data['users']=$this->user_model->getbyid($uid);
        $this->template_admin->display('admin/home',$data);
   				 }

    function logout(){
                $this->session->sess_destroy();
                redirect('home');
                }

    function search(){
                $search       =   $this->input->post('search');
                $data['hasil']     =   $this->event_model->search($searchevents);

                    if ($data['hasil'] =   $this->event_model->search($searchevents))
                          {
                          $data['jumlah'] = $this->event_model->totalsearch($searchevents);
                          $data['searchevents'] = $searchevents;
                          $this->template->display('event/search_result',$data);
                          }
                        else
                          {
                          $this->session->set_flashdata('error', 'Maaf, kami tidak menemukan keyword anda.');   
                            //$this->template->display('user/my_account',$alert);
                            redirect('home');
                          //$this->template->display('pegawai/tidak_ketemu');
                          }
                          
                        if(empty($_POST['searchevents']))
                          {
                          redirect('home');
                          }
            }

}

?>
