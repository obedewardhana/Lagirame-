<?php
class ec_model extends CI_model{

	private $primary_key='user_id';
    private $table_name='user';

    function __construct(){
    parent::__construct();
    }   

	function getbyid($uid){
        return $this->db->get_where('user',array('user_id'=>$uid))->row();
    }

	function geteventbyid($id)
    	{
       	$this->db->select('*');
    	$this->db->from('event');
    	$this->db->where('user_id',$id);
        $this->db->order_by('event_id', 'desc');
    	$query = $this->db->get();
       	return $query->result_array();
    	}


    function getalleventcreator($limit=null,$offset=NULL)
            {
                //$date = new DateTime("now");
                //$curr_date = $date->format('Y-m-d ');
                $level ='event_creator';
                $this->db->select('*');
                $this->db->where('level',$level);
                $this->db->order_by('user_id', 'desc');
                $this->db->limit($limit,$offset);
                $query = $this->db->get('user');
                return $query->result();
            }

    function total_event_creator(){
        $level ='event_creator';
        $this->db->where('level',$level);
        return $this->db->get('user')->num_rows();
    }


     function updateEvent($id,$imgdata) {
         $data = array(
                                'user_id' => $this->input->post('user_id'),
                                'title' => $this->input->post('title'),
                                'start_date' => $this->input->post('start_date'),
                                'end_date' => $this->input->post('end_date'),
                                'location' => $this->input->post('location'),
                                'city' => $this->input->post('city'),
                                'description' => $this->input->post('description'),
                                'image' => $imgdata,
                                'type' => $this->input->post('type'),
                                'price' => $this->input->post('price'),
                                'capacity' => $this->input->post('capacity'),
                                'category_id' => $this->input->post('category_id'),

                                );
        $this->db->where('event_id', $id);
        $this->db->update('event', $data);

        return TRUE;
    }

    function update_event_creator($user_id) {
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


    function getbyuserid($user_id){
        return $this->db->get_where('user',array('user_id'=>$user_id))->row();
    }

    function delete_event_creator ($user_id){         
        $this->db->where('user_id', $user_id);
        $this->db->delete('user');
    }



	}?>