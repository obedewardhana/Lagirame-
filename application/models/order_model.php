<?php
class order_model extends CI_model{


    private $primary_key='order_id';
    private $table_name='order';

    function __construct(){
    parent::__construct();
    } 


    function crewate(){
        foreach ($carts = $this->cart->contents() as $item) {
                        $uid = $this->session->userdata('user_id');
                        $user = $this->user_model->get_user_id($uid);               
                        $orderCode = $this->user_model->generateRandomCode(8);
                        $orderId = $this->db->insert_id();
                        $total =  $this->cart->total();
                        $duedate = date('Y-m-d H:i:s', mktime( date('H'),date('i'),date('s'),date('m'),date('d') + 2,date('Y')));
                        $event = $this->event_model->getById($item['id']);

                        $data = array(
                            'order_id'          => $orderId,
                            'event_id'          => $item['id'],
                            'quantity'          => $item['qty'],
                            'user_id'           => $user['user_id'],
                            'status'            => 'Tunda',
                            'order_date'        => date('Y-m-d'),
                            'payment_deadline'  => $duedate,
                            'total'             => $total,
                            'code'              => $orderCode

                        );

                        $this->db->insert('order', $data);
                    }  return TRUE;
                }

    function create(){
        foreach ($carts = $this->cart->contents() as $item) {
                        $uid = $this->session->userdata('user_id');
                        $user = $this->user_model->get_user_id($uid);               
                        $orderCode = $this->user_model->generateRandomCode(8);
                        $orderId = $this->input->post('order_id');
                        $total =  $this->cart->total();
                        $duedate = date('Y-m-d H:i:s', mktime( date('H'),date('i'),date('s'),date('m'),date('d') + 2,date('Y')));
                        $event = $this->event_model->getById($item['id']);

                        $order['order_id'] = $orderId;
                        $order['event_id'] = $item['id'];
                        $order['quantity'] = $item['qty'];
                        $order['user_id'] = $user['user_id'];
                        $order['status'] = 'Tunda';
                        $order['order_date'] = date('Y-m-d');
                        $order['payment_deadline'] = $duedate;
                        $order['price'] = $item['price'];
                        $order['amount'] = $item['subtotal'];
                        $order['code'] = $orderCode;

                        $this->db->insert('order', $order);
                    }  return TRUE;
                }


                function update_status($order_id){  
                        $status= $this->input->post('status');
                                
                        $data = array('status' => $status);
                        $this->db->where('order_id',$order_id);
                        $this->db->update('order', $data);
                        }

                    function getbycode($orderId)
                        {
                            $this->db->select('*');
                            $this->db->from('order');
                            $this->db->where('order_id', $orderId);
                            $query = $this->db->get();
                            return $query->row_array();
                        }

                    function getcode($code)
                        {
                            $this->db->select('*');
                            $this->db->from('order');
                            $this->db->where('code', $code);
                            $query = $this->db->get();
                            return $query->row_array();
                        }

                    function update($data, $order_id) {
                        $this->db->where('order_id', $order_id);
                        $this->db->update('order', $data);

                        return TRUE;
                    }

                    function getByOrderCode($code) {
                        $this->db->where('code', $code);
                        $query = $this->db->get('order', 1);
                        if ($query->num_rows() == 1) {
                            return $query->row_array();
                        }
                    }

                    function getByOrderId($orderId) {
                        $this->db->where('order_id', $orderId);
                        $this->db->order_by('od_id', 'DESC');
                        $query = $this->db->get('order_detail');
                        return $query->result();
                    }

                    function getorderbyid($id)
                    {
                    $this->db->select('*');
                    $this->db->from('order');
                    $this->db->where('user_id',$id);
                    $this->db->order_by('order_id', 'DESC');
                    $query = $this->db->get();
                    return $query->result_array();
                    }

                    function total_orders(){
                        return $this->db->get('order')->num_rows();
                    }

                    function getallorder($limit=null,$offset=NULL)
                    {
                        $this->db->select('*');
                        $this->db->limit($limit,$offset);
                        $this->db->order_by('order_id', 'DESC');
                        $query = $this->db->get('order');
                        return $query->result();
                    }

                    function getById($order_id) {
                        $this->db->where('order_id', $order_id);
                        $query = $this->db->get('order', 1);
                        if ($query->num_rows() == 1) {
                            return $query->row_array();
                        }
                    }






}

?>