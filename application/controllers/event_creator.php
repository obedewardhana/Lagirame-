<?php 
	if ( ! defined('BASEPATH'))
	exit('No Direct Script Access Allowed');
	//session_start();	
	class event_creator extends CI_Controller {
			public function __construct(){
				parent::__construct();
				$this->load->helper(array('url','form','html'));
				$this->load->library(array('table'));
				$this->load->library('form_validation');
                $this->load->library('pagination');
                $this->load->library('session');     ;
                $this->load->model('event_model','',true);
                $this->load->model('category_model','',true);
                $this->load->model('ec_model','',true);
				$this->load->model('user_model','',true);
				$this->load->model('order_model','',true);
				$this->load->library('email');
				$this->load->library('GoogleMaps');
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


			function my_account(){

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
                	redirect('event_creator/my_account');
		        } 
				$uid=$this->session->userdata('user_id');
		        $data['user']=$this->ec_model->getbyid($uid);		        
                //$data['events']= $this->ec_model->geteventbyid($uid);
		        $this->template->display('event_creator/my_account',$data);
			}

			function add_event(){

                $user_id = $this->input->post('user_id',true);
				$title = $this->input->post('title',true);
				$start_date = $this->input->post('start_date',true);
				$end_date = $this->input->post('end_date',true);
				$image = $this->input->post('image',true);
				$location = $this->input->post('location',true);
				$city = $this->input->post('city',true);
				$description = $this->input->post('description',true);
				$type = $this->input->post('type',true);
				$price = $this->input->post('price',true);
				$capacity = $this->input->post('capacity',true);
				$status = $this->input->post('status',true);
				$category_id = $this->input->post('category_id',true);

								
				$this->form_validation->set_rules('title', 'Judul', 'required|min_length[5]|max_length[75]|xss_clean|is_unique[event.title]');
				$this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
				$this->form_validation->set_rules('end_date', 'Tanggal Berakhir', 'required');	
				$this->form_validation->set_rules('location', 'Lokasi', 'required|min_length[3]|max_length[100]|xss_clean');
				$this->form_validation->set_rules('city', 'Kota', 'required|min_length[3]|max_length[100]|xss_clean');
				$this->form_validation->set_rules('description', 'Deskripsi', 'required|min_length[10]|xss_clean');
				$this->form_validation->set_rules('type', 'Tipe', 'required');
				$this->form_validation->set_rules('price', 'harga');
				$this->form_validation->set_rules('capacity', 'Kapasitas', 'required');
				$this->form_validation->set_rules('category_id', 'Kategori', 'trim|required');

				$this->form_validation->set_message('required','%s Harus Diisi.');

				if ($this->form_validation->run() == TRUE) {
                if ($_FILES['image']['error'] != 4) {
                    $config['upload_path'] = 'uploads';
					$config['allowed_types'] = 'jpg|jpeg|gif|png';
					$config['max_size'] = '300000';
					$config['max_width']  = '3000';
					$config['max_height']  = '3000';			
	     			$this->upload->initialize($config);	

                    if (!$this->upload->do_upload()) {
                    	//$data['error']="Anda Tidak Memilih File Gambar.";
            			//$this->template->display('event_creator/add_event',$data);
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('event_creator/add_event');
                    } else {
                        		$image = $this->upload->data();
						    	$imgdata = file_get_contents($image['full_path']);
						        $data = array(
								'user_id' => $user_id,
								'title' => $title,
								'start_date' => $start_date,
								'end_date' => $end_date,
								'location' => $location,
								'city' => $city,
								'description' => $description,
								'image' => $imgdata,
								'type' => $type,
								'price' => $price,
								'capacity' => $capacity,
								'status' => $status,
								'category_id' => $category_id
								);
								
						       //$this->event_model->save($data);
						       if ($this->event_model->save($data)) {
	                           	 	$this->session->set_flashdata('success', 'Event berhasil dibuat!');
	                            	redirect('event_creator/my_account');
	                        	} else {
	                            	$this->session->set_flashdata('error', 'Gagal, Coba Lagi!');
	                            	redirect('event_creator/add_event');
	                        	}
		                    }
		                }
		           
		        	} $this->template->display('event_creator/add_event');

				}

				


				function edit_event($event_id) {

			        
			        $id = $this->input->post('event_id');
			        
			        $this->form_validation->set_rules('title', 'Title', 'required|min_length[5]|max_length[75]|xss_clean');
					$this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
					$this->form_validation->set_rules('end_date', 'Tanggal Berakhir', 'required');	
					$this->form_validation->set_rules('location', 'Lokasi', 'required|min_length[3]|max_length[100]|xss_clean');
					$this->form_validation->set_rules('city', 'Kota', 'required|min_length[3]|max_length[100]|xss_clean');
					$this->form_validation->set_rules('description', 'Deskripsi', 'required|min_length[10]|xss_clean');
					$this->form_validation->set_rules('type', 'Tipe', 'required');
					$this->form_validation->set_rules('price', 'harga');
					$this->form_validation->set_rules('capacity', 'Kapasitas', 'required');
					$this->form_validation->set_rules('category_id', 'Kategori', 'trim|required');

					$this->form_validation->set_message('required','%s Harus Diisi.');


			        if ($this->form_validation->run() == TRUE) 
			        {


			                    $config['upload_path'] = 'uploads';
								$config['allowed_types'] = 'jpg|jpeg|gif|png';
								$config['max_size'] = '300000';
								$config['max_width']  = '3000';
								$config['max_height']  = '3000';
			                    //$this->load->library('upload', $config);
			                    $this->upload->initialize($config);


			                        if (!$this->upload->do_upload()) {
			                        $this->session->set_flashdata('error', $this->upload->display_errors());
			                        redirect('event_creator/edit_event/'.$event_id);
			                    } else {
			                        $image = $this->upload->data();
						    		$imgdata = file_get_contents($image['full_path']);

			                         if ($this->ec_model->updateEvent($id,$imgdata)) {
			                            $this->session->set_flashdata('success', 'Event berhasil diupdate');
			                            redirect('event_creator/my_account');
			                        } else {
			                            $this->session->set_flashdata('error', 'Gagal, Coba Lagi!');
			                            redirect('event_creator/my_account');
			                        }
			                           
			                      
			                    }
			                
			                
			        }
			        $data['events']=$this->event_model->getById($event_id);
		        	$this->template->display('event_creator/edit_event',$data);
			    }


			

			  
}
