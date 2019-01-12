<?php 
	if ( ! defined('BASEPATH'))
	exit('No Direct Script Access Allowed');

	class confirmation extends CI_Controller {
			function __construct(){
				parent::__construct();
				$this->load->helper(array('url','form','html'));
				$this->load->library('form_validation');
				$this->load->model('event_model','',true);
				$this->load->model('user_model','',true);
				$this->load->model('category_model','',true);
				$this->load->model('order_model','',true);
				$this->load->model('confirmation_model','',true);
				$this->load->library('session');		
				$this->load->library('upload');
				$this->load->library('cart');
				//$this->is_logged_in();
				}

			function coba(){
				$this->template->display('confirmation/add_confirmation');
			}

			function add_confirmation($orderCode = null){
				if ($orderCode == null) {
			            $orderCode = $this->input->post('code');
			        }
								
				$this->form_validation->set_rules('name', 'Nama', 'required|min_length[5]|max_length[75]|xss_clean');
				$this->form_validation->set_rules('payment_date', 'Tanggal Transfer', 'required');
				$this->form_validation->set_rules('sender_bank', 'Nama Bank', 'required');	
				$this->form_validation->set_rules('description', 'Deskripsi', 'required|min_length[5]|max_length[100]|xss_clean');

				$this->form_validation->set_message('required','%s Harus Diisi.');
				$order = $this->order_model->getByOrderCode($orderCode);
				if ($this->form_validation->run() == TRUE) {
                if ($_FILES['image']['error'] != 4) {
                    $config['upload_path'] = 'uploads';
					$config['allowed_types'] = 'jpg|jpeg|gif|png';
					$config['max_size'] = '300000';
					$config['max_width']  = '3000';
					$config['max_height']  = '3000';				
					//$this->load->library('upload', $config);
	     			$this->upload->initialize($config);	

                    if (!$this->upload->do_upload()) {
                    	//$data['error']="Anda Tidak Memilih File Gambar.";
            			//$this->template->display('event_creator/add_event',$data);
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('home');
                    } else {
                        		$image = $this->upload->data();
						    	$imgdata = file_get_contents($image['full_path']);

						        $data = array(
								'name' => $this->input->post('name'),
								'payment_date' => $this->input->post('payment_date'),
								'description' => $this->input->post('description'),
								'image' => $imgdata,
								'sender_bank' => $this->input->post('sender_bank'),
								'order_id' => $order['order_id']
								);
								
						       //$this->event_model->save($data);
						       if ($this->confirmation_model->save($data)) {
						       		$orderUpdate = array(
				                        'status' => 'Menunggu Disetujui'
				                    );
				                    $this->order_model->update($orderUpdate, $order['order_id']);
	                           	 	$this->session->set_flashdata('success', 'Konfirmasi berhasil dibuat!');
	                            	redirect('home');
	                        	} else {
	                            	$this->session->set_flashdata('error', 'Gagal, Coba Lagi!');
	                            	redirect('home');
	                        	}
		                    }
		                }
		           
		        	} $data['order'] = $this->order_model->getByOrderCode($orderCode);
		        	  $this->template->display('confirmation/add_confirmation',$data);

				}
						

						  
}
