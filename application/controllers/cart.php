<?php 
	if ( ! defined('BASEPATH'))
	exit('No Direct Script Access Allowed');

	class cart extends CI_Controller {
			function __construct(){
				parent::__construct();
				$this->load->helper(array('url','form','html'));
				$this->load->library('form_validation');
				$this->load->model('event_model','',true);
				$this->load->model('user_model','',true);
				$this->load->model('category_model','',true);
				$this->load->library('cart');
				$this->load->library('session');		
				$this->load->library('upload');
				$this->is_logged_in();
				}

			function is_logged_in(){
				$is_logged_in=$this->session->userdata('is_logged_in');
					if(!isset($is_logged_in)||$is_logged_in!= true) {
					redirect(base_url());
					} 
				}

			function index() {
			        $data['carts'] = $this->cart->contents();
			        $this->template->display('order/cart',$data);
			    }

			function add_cart($event_id){
				$is_logged_in=$this->session->userdata('is_logged_in');
				if(!isset($is_logged_in)||$is_logged_in!= true) {
					$this->session->set_flashdata('error', 'Anda harus login sebelum memesan tiket.');	
		            redirect('user/login');
					} else{

					$events = $this->event_model->getById($event_id);
					$insert_data = array( 
							 'id' => $events->event_id,
							 'name' => $events->title,
							 'price' => $events->price,
							 'qty' => 1 );
					$this->cart->insert($insert_data);
					}
					$this->template->display('order/cart');
			    }

			    function remove($rowid) {
						if ($rowid=="all"){
							$this->cart->destroy();
						}else{
							$data = array(
								'rowid'   => $rowid,
								'qty'     => 0
							);

							$this->cart->update($data);
						}
						
						redirect('cart');
					}	


			  function update_cart(){                
		        $cart_info =  $_POST['cart'] ;
		 		foreach( $cart_info as $id => $cart)
				{	
		                    $rowid = $cart['rowid'];
		                    $price = $cart['price'];
		                    $amount = $price * $cart['qty'];
		                    $qty = $cart['qty'];
		                    
		                 $data = array(
						'rowid'   => $rowid,
		                'price'   => $price,
		                'amount' =>  $amount,
						'qty'     => $qty
					);
		             
					$this->cart->update($data);
				}
				redirect('cart');        
			}  
			

						  
}

	