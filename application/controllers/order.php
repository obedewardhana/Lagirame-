<?php 
	if ( ! defined('BASEPATH'))
	exit('No Direct Script Access Allowed');

	class order extends CI_Controller {
			function __construct(){
				parent::__construct();
				$this->load->helper(array('url','form','html'));
				$this->load->library('form_validation');
				$this->load->model('event_model','',true);
				$this->load->model('user_model','',true);
				$this->load->model('category_model','',true);
				$this->load->model('order_model','',true);
				$this->load->library('cart');
				$this->load->library('session');		
				$this->load->library('upload');
				$this->is_logged_in();
				}

			function is_logged_in(){
				$is_logged_in=$this->session->userdata('is_logged_in');
					if(!isset($is_logged_in)||$is_logged_in!= TRUE) {
					$this->session->set_flashdata('error','Anda harus login dulu.');
					redirect('user/register');
					} 
				}


			function proceed() {
						$is_logged_in=$this->session->userdata('is_logged_in');
							if($is_logged_in == FALSE){
								$this->session->set_flashdata('error','Anda harus login dulu.');
								redirect('user/register');
							}else{


		                        $uid = $this->session->userdata('user_id');
		                        $user = $this->user_model->get_user_id($uid);
		                        $orderCode = $this->user_model->generateRandomCode(8);		                        
		                        $duedate = date('Y-m-d H:i:s', mktime( date('H'),date('i'),date('s'),date('m'),date('d') + 2,date('Y'))); 
		                        $total =  $this->cart->total();
		                       		                        
		                        $order['status'] = 'Tunda';		                        
		                        $order['total'] = $total;		                        
		                        $order['user_id'] = $user['user_id'];
		                        $order['code'] = $orderCode;		                        
		                        $order['order_date'] = date('Y-m-d');
		                        $order['payment_deadline'] = $duedate;

		                    if($this->db->insert('order', $order)){

								$orderId = $this->db->insert_id();
							foreach ($this->cart->contents() as $item) {
		                        $event = $this->event_model->getById($item['id']);
		                        $detail['event_id'] = $item['id'];
		                        $detail['quantity'] = $item['qty'];;
		                        $detail['price'] = $item['price'];
		                        $detail['order_id'] = $orderId;

		                        $this->db->insert('order_detail', $detail);
		                    } 
							//------- Send Invoice to Customer Email------------------//
							
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

			                $this->email->to($this->session->userdata('email'));
			                $this->email->from('lagirameofficial@gmail.com','Lagirame');
			                $this->email->subject('Invoice Pemesanan');
			                $message = '';
			                $email['order'] = $this->order_model->getbycode($orderId);
			                $email['orderDetails'] = $this->order_model->getByOrderId($email['order']['order_id']);
			                $message .= $this->load->view('order/invoice', $email, TRUE);

			                $this->email->message($message);
			                $this->email->send();

			                //------- Send Invoice to Customer Email------------------//
							$this->cart->destroy();
							$this->session->set_flashdata('success', 'Order berhasil dilakukan, periksa email anda !');
							redirect('home');
						}else {
			                $this->session->set_flashdata('error', 'Order Gagal, Coba Lagi !');
			                redirect('home');
			            }
					}
				}

	        function detail($orderCode) {
			        $data['order'] = $this->order_model->getByOrderCode($orderCode);
			        if (empty($data['order'])) {

			            redirect('home');
			        }
			        $data['orderDetails'] = $this->order_model->getByOrderId($data['order']['order_id']);
			        $this->template->display('order/detail', $data);
			    }
			            
	        
	

						  
}

	
//localhost/belajarCI/index.php/blog
//localhost/belajarCI/index.php/blog/komentar
/* End of file Blog.php */
/* Location:  */