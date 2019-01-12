<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

    function __construct(){
                parent::__construct();
                $this->load->helper(array('url','form','html'));
                $this->load->library(array('table'));
                $this->load->library(array('form_validation'));
                $this->load->library('pagination');
                $this->load->helper('string');
                $this->load->model('user_model','',true);
                $this->load->library('email');
                }

    function login()
    {
                $this->template->display('user/login');

    }

    function login_to_page() {
            $data = array('username' => $this->input->post('username', TRUE),
                          'password' => $this->input->post('password', TRUE)
            );

                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]|xss_clean');
                $this->form_validation->set_message('required','%s Harus Diisi.');

            if($this->form_validation->run()==TRUE){
            $hasil = $this->user_model->cek_user($data);
            if ($hasil->num_rows() == 1) {
            foreach ($hasil->result() as $sess) {
                $sess_data['is_logged_in'] = TRUE;
                $sess_data['user_id'] = $sess->user_id;
                $sess_data['email'] = $sess->email;
                $sess_data['level'] = $sess->level;
                $this->session->set_userdata($sess_data);
            }
            if ($this->session->userdata('level')=='admin') {
                redirect('admin/home');
            }
            elseif ($this->session->userdata('level')=='user_umum') {
                redirect('user_umum/my_account');
            }
            elseif ($this->session->userdata('level')=='event_creator') {
                redirect('event_creator/my_account');
            }       
            }

            else{
                    $this->session->set_flashdata('error', 'Password tidak cocok!');  
                    redirect('user/login');
                }
            }

            else{
                 $this->template->display('user/login');
            }
      
         }





    function register(){
                
                //$ec_id = $this->input->post('ec_id',true);
                //$username = $this->input->post('username',true);
                $name = $this->input->post('name',true);
                $password=$this->input->post('password',true);
                $email=$this->input->post('email',true);
                $phone=$this->input->post('phone',true);
                $address = $this->input->post('address',true);
                $level = $this->input->post('level',true);
                                
                //$this->form_validation->set_rules('nip[]','Nip','required');
                //$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha|min_length[3]|max_length[15]|callback_check_if_username_exists|xss_clean');
                $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[6]|max_length[50]|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[32]|required');                
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
                $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim|required|min_length[5]|max_length[50]|xss_clean');
                $this->form_validation->set_rules('address', 'Alamat', 'trim|required|min_length[6]|max_length[30]|xss_clean');
                $this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|required|matches[password]');
                $this->form_validation->set_rules('level', 'Tipe User', 'required');
                $this->form_validation->set_message('required','%s Harus Diisi.');

                if($this->form_validation->run()==FALSE){
                    $this->template->display('user/signup');
                }
                else{
                    $data = array(
                        'name' => $name,
                        'password' => md5($password),
                        'email' => $email,
                        'phone' => $phone,
                        'address' => $address,
                        'level' => $level,

                    );
                    $this->user_model->save($data);

                    $alert["success"]="Akun Sukses Terdaftar!";                  
                    $this->template->display('user/login',$alert);
                    }
                    }


        function forgot_password()
            {
            if(!empty($this->input->post()))
            {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_message('required','%s Harus Diisi.');
                if ($this->form_validation->run() == FALSE)
                {
                        $this->template->display('user/forgot_password');
                }
                else
                {
                    $email = $this->input->post('email');
                    $status = $this->user_model->findByEmail($email);
                    if($status == 1)
                    {
                        $user = $this->user_model->get_user_details($email);

                        $data['reset_token'] = $this->user_model->generateRandomCode(50);
                        $data['email'] = $email;

                        $token_status = $this->user_model->createToken($data);
                        if($token_status)
                        {
                            $email_data = array();
                            $email_data['email'] = $user['email'];
                            $email_data['name'] = $user['name'];
                            $email_data['reset_password_link'] = $data['reset_token'];

                            $this->user_forget_sendmail($email_data);
                             $this->template->display('user/email_sent');
                        }
                        else
                        {
                            $this->session->set_flashdata('failure','Terjadi masalah. silahkan dicoba lagi.');
                            redirect('user/forgot_password');
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('failure','Email anda tidak ditemukan.');
                        redirect('user/forgot_password');
                    }
                }
            }
            else
            {
                $this->template->display('user/forgot_password');
            }
            
        }


    function user_forget_sendmail($email_data)
        {       
            //$this->load->helper('auth/email_helper');
            $template_config = array(
                'email' => $email_data['email'],
                'name' => $email_data['name'],
                'reset_password_link' => $email_data['reset_password_link'],

            );
            $message_details = $this->message_template($template_config);

            $headers = "From: Lagirame";
            $mail_config = array('to' => $email_data['email'],
                                'subject' => 'Reset Password - Lagirame',
                                'message' => $message_details,
                                'headers'=>$headers
                            );
            $this->send_email($mail_config);
        }


        function message_template($template_config)
        {
            $result = array();

            $msg_config = $template_config;
            
                $result['message'] = '<p>Halo &nbsp;&nbsp;'.$msg_config['name'].' </p>';
                $result['message'] .= '<p>Kami sudah menerima permintaan reset password anda. Silahkan klik link reset di bawah ini.</p>';
                $result['message'] .= '<p><a href="'.base_url('user/reset_password').'/'.$msg_config['reset_password_link'].'" target="_blank">Reset Password Link</a></p>';
        
            return $result;
        }
        

        function send_email($email_data)
        {
            $CI = & get_instance();

            $CI->load->library('email');

            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.googlemail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'lagirameofficial@gmail.com';
            $config['smtp_pass']    = 'dazzdazz';
            $config['charset']    = 'iso-8859-1';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; 
            $CI->email->initialize($config);

            $CI->email->from('lagirameofficial@gmail.com', 'Lagirame');
            $CI->email->to($email_data['to']);
            $CI->email->subject($email_data['subject']);

            $body = $CI->load->view('user/email_template',$email_data['message'],TRUE); 
            $CI->email->message($body);

            if($CI->email->send())
                return "email sent!";
            else 
                return "failed";
        }



    function reset_password(){
            $initoken = $this->uri->segment(3);
            $user = $this->user_model->get_user_details_reset_password($initoken);

            if(!empty($user))
            { 
                if($initoken == $user['reset_token'])
                {
                    if($this->input->post())
                    {
                        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
                        $this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|required|matches[password]');
                        $this->form_validation->set_message('required','%s Harus Diisi.');
                        if ($this->form_validation->run() == FALSE)
                        {
                            $data = array();
                            $data['initoken'] = $initoken;
                            $this->template->display('user/reset_password',$data);
                        }
                        else
                        {
                            $password = $this->input->post('password');
                            $input_data['password'] = md5($password);
                            $input_data['email'] = $user['email'];
                            $input_data['reset_password_link'] = $initoken;
                            $status = $this->user_model->resetPassword($input_data);
                            if($status)
                            {
                                $this->user_model->truncateToken($input_data['email']);
                                $this->session->set_flashdata('success','Password reset was successfully complete. Please login with new password.');
                                redirect('user/login');  
                            }
                            else
                            {
                                $this->session->set_flashdata('failure','There was a problem. Please try again later..');
                                redirect('user/forget_password'); 
                            }
                        }
                    }
                    else
                    {
                        $data = array();
                        $data['initoken'] = $initoken;
                        $this->template->display('user/reset_password',$data);
                    }
                }
                else
                {
                    $this->session->set_flashdata('failure','error 2 Invalid request.');
                    redirect('user/forgot_password');     
                }
            }
            else
            {
                $this->session->set_flashdata('failure','error 1 Invalid request.');
                redirect('user/forgot_password');     
            }
        }
        
    function logout(){
                $this->session->sess_destroy();
                redirect('home');
                }



}

/* End of file user.php */
/* Location: ./application/controllers/user.php */