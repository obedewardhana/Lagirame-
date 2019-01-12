<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class orders extends CI_Controller {

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
                $this->load->library('m_pdf');
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

	 function all_orders($offset=0)
        {
             $jumlah_data = $this->order_model->total_orders();
             $config['base_url'] = base_url().'admin/orders/all_orders';
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

             $query= $this->order_model->getallorder(4,$page_num);
             $data['rows'] = null;

                    if($query){
                       $data['rows'] = $query;
                      }
             $this->template_admin->display('admin/orders/orders',$data);


        }


        function detail($order_id) {
            $data['order'] = $this->order_model->getById($order_id);
            if (empty($data['order'])) {

                redirect('orders/all_orders');
            }
            $data['orderDetails'] = $this->order_model->getByOrderId($data['order']['order_id']);
            $data['confirmation'] = $this->confirmation_model->getByOrderId($data['order']['order_id']);
            $data['user'] = $this->user_model->getUserById($data['order']['user_id']);
            $this->template_admin->display('admin/orders/detail',$data);
        }


        function update_status($order_id){

            $this->order_model->update_status($order_id);
            $this->session->set_flashdata('success', 'Status Order berhasil di update!'); 
            redirect('admin/orders/all_orders');
                       
            $this->template_admin->display('admin/orders/all_orders');
                }


        function cetakpdf($order_id) {

            $data['order'] = $this->order_model->getById($order_id);
            //$order = $this->order_model->getById($order_id);
            $this->load->view('admin/orders/detail', $data);
            $sumber = $this->load->view('admin/orders/detail', $data, TRUE);
            $html = $sumber;
     
        
            $pdfFilePath = "assets/pdf/tiket.pdf";
            //lokasi file css yang akan di load
            //$css = $this->load->view('admin/css/bootstrap.min.css');
            //$stylesheet = file_get_contents($css);

            $this->load->library('m_pdf');
     
            $this->m_pdf->pdf->WriteHTML($html);
            
            //$this->m_pdf->pdf->Output($pdfFilePath, "D"); 
        }


        function approve($order_id) {          

                    $order = $this->order_model->getById($order_id);
                    $users = $this->user_model->getUserById($order['user_id']);
                    $source['order'] = $this->order_model->getById($order_id);
                    $source['orderDetails'] = $this->order_model->getByOrderId($source['order']['order_id']);
                    $source['user'] = $users;
                    $source['confirmation'] = $this->confirmation_model->getByOrderId($order_id);
                    $sumber = $this->load->view('admin/orders/tiket', $source, TRUE);
                    $html = $sumber;
                    $pdfFilePath = "assets/pdf/tiket.pdf";
                    $this->load->library('m_pdf');
                    $stylesheet = file_get_contents('assets/css/pdf.css');
                    $this->m_pdf->pdf->WriteHTML($stylesheet,1);
                    $this->m_pdf->pdf->WriteHTML($html,2);
                    $this->m_pdf->pdf->Output($pdfFilePath, "F"); 


                    $this->load->library('email');
                    $config['protocol']    = 'smtp';
                    $config['smtp_host']    = 'ssl://smtp.googlemail.com';
                    $config['smtp_port']    = '465';
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user']    = 'lagirameofficial@gmail.com';
                    $config['smtp_pass']    = 'dazzdazz';
                    $config['charset']    = 'iso-8859-1';
                    $config['newline']    = "\r\n";
                    $config['mailtype'] = 'html'; 
                     $this->email->initialize($config);
                    $this->email->initialize($config);

                    $user = $this->user_model->getUserById($order['user_id']);
                    $this->email->to($user['email']);
                    $this->email->from('lagirameofficial@gmail.com','Lagirame');
                    $this->email->subject('Tiket Anda');
                    $message = '';
                    $email['order'] = $this->order_model->getById($order_id);
                    $email['orderDetails'] = $this->order_model->getByOrderId($email['order']['order_id']);
                    $email['user'] = $user;
                    $email['confirmation'] = $this->confirmation_model->getByOrderId($order_id);
                    $message .= $this->load->view('admin/orders/approve', $email, TRUE);
                    
                    $this->email->message($message);
                    $this->email->attach('assets/pdf/tiket.pdf');
                    $this->email->send();
                    //-------------------------------------------------//
                    
                    $this->session->set_flashdata('success', 'Tiket berhasil dikirim!'); 
                    redirect('admin/orders/all_orders');
                           
                }

}

?>
