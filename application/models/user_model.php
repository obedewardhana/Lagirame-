<?php
class user_model extends CI_model{


    private $primary_key='user_id';
    private $table_name='user';

    function __construct(){
    parent::__construct();
    }   

    function checkLogin() {
        $this->db->select('email,password,name,level');
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            return TRUE;
        }
    }

    function cek_user($data) {
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('password', md5($this->input->post('password')));
            $query = $this->db->get('user', $data);
            return $query;
        }

    function validate(){
			$this->db->where('username',$this->input->post('username'));
			$this->db->where('password',md5($this->input->post('password')));
			$login = $this->db->get('event_creator');

			if ($login->num_rows==1) {
			return TRUE;
		}
						
    }

    function getalluserumum($limit=null,$offset=NULL)
            {
                //$date = new DateTime("now");
                //$curr_date = $date->format('Y-m-d ');
                $level ='user_umum';
                $this->db->select('*');
                $this->db->where('level',$level);
                $this->db->order_by('user_id', 'desc');
                $this->db->limit($limit,$offset);
                $query = $this->db->get('user');
                return $query->result();
            }

    function getuseridname($uid)
            {
                $this->db->select('*');
                $this->db->where('user_id',$uid);
                $query = $this->db->get('user');
                return $query->result();
            }

    function total_user_umum(){
        $level ='user_umum';
        $this->db->where('level',$level);
        return $this->db->get('user')->num_rows();
    }

    function total_users(){
        return $this->db->get('user')->num_rows();
    }


    function save ($person){
		$this->db->insert($this->table_name,$person);
		return $this->db->insert_id();
			}

    function add ($data=array()){
		$orig_db_debug = $this->db->db_debug;
		$this->db->db_debug = FALSE;

		if ($this->db->insert_batch('event_creator', $data)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
		
	}

    function get_paged_list(){
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        return $query;
    }

    function update($user_id) {
        if ($this->input->post('password')) {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
            );
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
            );
        }
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
    }

    function delete_user_umum ($user_id){         
        $this->db->where('user_id', $user_id);
        $this->db->delete('user');
    }


    function update_user_umum($user_id) {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'level' => $this->input->post('level'),
            );
        
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
    }

    function getemail($email)
    {
        $this->db->select('*');
        $this->db->where('email',$email);
        $q=$this->db->get('user');
        
        if ($q->num_rows() == 1) {
            return $q->row_array();
        }
    }

    function getuid($uid)
    {
        $this->db->select('*');
        $this->db->where('user_id',$uid);
        $q=$this->db->get('user');
        
        if ($q->num_rows() == 1) {
            return $q->row_array();
        }
    }

    function setPaymentDeadline($days) {

        $dueDate = mktime(0, 0, 0, date("m"), date("d") + $days, date("Y"));
        return date("Y-m-d", $dueDate);
    }

    function getbyid($uid){
        return $this->db->get_where('user',array('user_id'=>$uid))->row();
    }

    function getbyuserid($user_id){
        return $this->db->get_where('user',array('user_id'=>$user_id))->row();
    }

    function getUserById($user_id) {
        $this->db->select('*');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function get_user_id($uid)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user_id', $uid);
            $query = $this->db->get();
            return $query->row_array();
        }

    function findByEmail($email) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_user_details($email)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('email', $email);
            $query = $this->db->get();
            return $query->row_array();
        }

    function createToken($data) {

            $this->db->set('reset_token', $data['reset_token']);
            $this->db->where('email', $data['email']);
            return $this->db->update('user'); 
        
    }

    function generateRandomCode($length = 8) {
        // Available characters
        $chars = '0123456789abcdefghjkmnoprstvwxyz';

        $Code = '';
        // Generate code
        for ($i = 0; $i < $length; ++$i) {
            $Code .= substr($chars, (((int) mt_rand(0, strlen($chars))) - 1), 1);
        }
        return strtoupper($Code);
    }


     function get_user_details_reset_password($initoken)
        {
            $this->db->select('*');
            $this->db->from('user');          
            $this->db->where('reset_token',$initoken);
            $query = $this->db->get();
            return $query->row_array();
        }


    function resetPassword($data) {
        $this->db->set('password', $data['password']);
        $this->db->where('reset_token', $data['reset_password_link']);
        $this->db->where('email', $data['email']);
        return $this->db->update('user'); 
    }

    function truncateToken($data) {
        $this->db->set('reset_token', ' ');
        $this->db->where('email', $email);
        return $this->db->update('user');
    }


  

    function findByEmailAnddResetPasswordToken($email, $token) {

        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('reset_token', $token);
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function findByEmailAndRsesetPasswordToken($email, $token){  
     return $this->db->get_where('user',array('email'=>$email,'reset_token'=>$token))->row();
    
   }  


    function findAll() {
        $this->db->order_by('level', 'desc');
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


}

?>