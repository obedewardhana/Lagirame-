<?php
class confirmation_model extends CI_model{


    private $primary_key='confirmation_id';
    private $table_name='confirmation';

    function __construct(){
    parent::__construct();
    }   

    function save ($person){
		$this->db->insert($this->table_name,$person);
		return $this->db->insert_id();
			}

	function getByOrderId($order_id) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get('confirmation', 1);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getById($confirmation_id) {
        $this->db->where('confirmation_id', $confirmation_id);
        $query = $this->db->get('confirmation', 1);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function update($data, $id) {
        $this->db->where('confirmation_id', $id);
        $this->db->update($this->table, $data);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        }
        return FALSE;
    }



}

?>