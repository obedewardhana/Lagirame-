<?php
class event_model extends CI_model{

private $primary_key='event_id';
private $table_name='event';

function __construct(){
parent::__construct();
}

function save ($person){
		$this->db->insert($this->table_name,$person);
		return $this->db->insert_id();
			}

function create($filename) {
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'title' => $this->input->post('title'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'image' => $filename,
            'location' => $this->input->post('location'),
            'city' => $this->input->post('city'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'price' => $this->input->post('price'),
            'capacity' => $this->input->post('capacity'),
            'status' => $this->input->post('status'),
            'category_id' => $this->input->post('category_id')
        );

        $this->db->insert('event', $data);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }
			
	
function coba(){
		$this->db->select('*');
		$this->db->from('event');
		$query = $this->db->get();
		return $query;
	}

function add ($data=array()){
		$orig_db_debug = $this->db->db_debug;
		$this->db->db_debug = FALSE;

		if ($this->db->insert_batch('event', $data)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
		
}

function update_status($event_id){  
		$status= $this->input->post('status');
				
		$data = array(		'status' => $status);
		$this->db->where('event_id',$event_id);
		$this->db->update('event', $data);
		}

function update_capacity($event_id){  
		$capacity= $this->input->post('capacity');
				
		$data = array(		'capacity' => $capacity);
		$this->db->where('event_id',$event_id);
		$this->db->update('event', $data);
		}

function getById($event_id){ 
		return $this->db->get_where('event',array('event_id'=>$event_id))->row();
	}

function getbycategoryid($category_id){
		$status ='Terpublikasi'; 
		$this->db->select('*');
		$this->db->where('category_id',$category_id);
		$this->db->where('status',$status);
		$this->db->order_by('start_date', 'asc');
		$query = $this->db->get('event');
	   	return $query->result();
	}

function getbytype($type){
		$status ='Terpublikasi'; 
		$this->db->select('*');
		$this->db->where('type',$type);
		$this->db->where('status',$status);
		$this->db->order_by('start_date', 'asc');
		$query = $this->db->get('event');
	   	return $query->result();
	}

function getbytypename($type)
{
   	$this->db->select('*');
   	$this->db->where('type',$type);
	$query = $this->db->get('event');
   	return $query->row_array();
}


function getnamebycategoryid($category_id){ 
		$this->db->select('c.name');
		$this->db->from('category as c');
		$this->db->join('event as e', 'c.category_id = e.category_id','left');
		$this->db->where('e.category_id',$category_id);
		$query = $this->db->get();
		return $query->row_array();
	}


function get_paged_list(){
		$query = $this->db->query('select * from event, category where event.category_id=category.category_id');
		return $query;
	}

function get_paged_list1(){
		$this->db->select('*');
		$this->db->from('event');
		$query = $this->db->get();
		return $query;
	}

function getallevent($limit=null,$offset=NULL)
{
	//$date = new DateTime("now");
 	//$curr_date = $date->format('Y-m-d ');
 	$status ='Terpublikasi';
   	$this->db->select('*');
	$this->db->where('MONTH(start_date)',date('m'));
	$this->db->where('status',$status);
	$this->db->order_by('start_date', 'asc');
	$this->db->limit($limit,$offset);
	$query = $this->db->get('event');
   	return $query->result();
}

function getallevents($limit=null,$offset=NULL)
            {
                $this->db->select('*');
                $this->db->order_by('event_id', 'desc');
                $this->db->limit($limit,$offset);
                $query = $this->db->get('event');
                return $query->result();
            }

function getallcategories()
{
   	$this->db->select('*');
	$query = $this->db->get('category');
   	return $query->result();
}

function totalevent(){
  return $this->db->count_all_results('event');
 }

function total_event(){
		return $this->db->get('event')->num_rows();
	}

function geteventbyid($id)
{
    $this->db->select('*');
	$this->db->from('event');
    $this->db->where('ec_id',$id);
    //$this->db->join('event_creator', 'event_creator.ec_id = event.ec_id');
    $q=$this->db->get();
    return $q->result_array();
}

function totalsearch($searchevents){  
	    $status ='Terpublikasi';
	    //$this->db->join('category', 'category.category_id = event.category_id');
		$this->db->like('title',$searchevents);
		$this->db->or_like('start_date',$searchevents);			
		$this->db->or_like('end_date',$searchevents);		
		$this->db->or_like('city',$searchevents);
		$this->db->or_like('location',$searchevents);
		//$this->db->or_like('type',$searchevents);
		$this->db->or_like('price',$searchevents);
		$this->db->or_like('capacity',$searchevents);
		$this->db->or_like('description',$searchevents);
		$this->db->where('status',$status);
        return $this->db->get('event')->num_rows();
    }

function search($searchevents){  
	    $status ='Terpublikasi';
	    //$this->db->join('category', 'category.category_id = event.category_id');	   
		$this->db->like('title',$searchevents);	
		$this->db->or_like('start_date',$searchevents);			
		$this->db->or_like('end_date',$searchevents);		
		$this->db->or_like('city',$searchevents);
		$this->db->or_like('location',$searchevents);
		//$this->db->or_like('type',$searchevents);
		$this->db->or_like('price',$searchevents);
		$this->db->or_like('capacity',$searchevents);
		$this->db->or_like('description',$searchevents);
		$this->db->where('status',$status);
        $query  =   $this->db->get('event');
        return $query->result();
    }

function searchevents($search){    
		$this->db->like('title',$search);	
		$this->db->or_like('start_date',$search);			
		$this->db->or_like('end_date',$search);		
		$this->db->or_like('city',$search);
		$this->db->or_like('location',$search);
		$this->db->or_like('price',$search);
		$this->db->or_like('capacity',$search);
		$this->db->or_like('description',$search);
		$this->db->or_like('status',$search);
        $query  =   $this->db->get('event');
        return $query->result();
    }


 function delete_event ($event_id){         
        $this->db->where('event_id', $event_id);
        $this->db->delete('event');
    }
		
}
?>