<?php
class category_model extends CI_model{
private $primary_key='category_id';
private $table_name='category';

function __construct(){
parent::__construct();
}


function save ($person){
		$this->db->insert($this->table_name,$person);
		return $this->db->insert_id();
			}

function get_paged_list(){
		$this->db->select('*');
		$this->db->from('category');
		$query = $this->db->get();
		return $query;
	}

function getallcategories()
{
   	$this->db->select('*');
	$query = $this->db->get('category');
   	return $query->result();
}

function getnamebyid($category_id)
{
   	$this->db->select('name');
   	$this->db->where('category_id',$category_id);
	$query = $this->db->get('category');
   	return $query->row_array();
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

function total_categories(){
        return $this->db->get('category')->num_rows();
    }

function getallcategory($limit=null,$offset=NULL)
            {
                
                $this->db->select('*');
                $this->db->order_by('category_id', 'asc');
                $this->db->limit($limit,$offset);
                $query = $this->db->get('category');
                return $query->result();
            }

function update_category($category_id){  
		$name= $this->input->post('name');
				
		$data = array(		'name' => $name);
		$this->db->where('category_id',$category_id);
		$this->db->update('category', $data);
		}

function getbyid($category_id){
        return $this->db->get_where('category',array('category_id'=>$category_id))->row();
    }

function delete_category($category_id){         
        $this->db->where('category_id', $category_id);
        $this->db->delete('category');
    }



function signup()
        {	$name = $this->input->post('name');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $email = $this->input->post('email');
            $organization = $this->input->post('organization');
            
            $data = array(            		
                    'name'=> $name,
                   	'username'=>$username,
                    'password'=>$password,
                    'email'=>$email,
                    'organization'=>$organization                    
                    );
            $this->db->insert('event_creator',$data); 
            }

function check_if_username_exists($username){
			$this->db->where('username',$username);
			$result = $this->db->get('event_creator');

			if ($result->num_rows() > 0) {
							return FALSE;
						}	else {
							return TRUE;
						}		
		}

function check_if_email_exists($email){
			$this->db->where('email',$email);
			$result = $this->db->get('event_creator');

			if ($result->num_rows() > 0) {
							return FALSE;
						}	else {
							return TRUE;
						}		
		}

		

}
?>