<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {

    public function getOrder($idu){
        // $this->db->join('order_detail', 'orders.id_order = order_detail.id_orders');
        $this->db->where('id_user',$idu);
        $this->db->order_by('date','ASC');
        $o = $this->db->get('orders')->result_array();	
        return $o;
    }
    public  function getinpo($id){
        $this->db->select('*');
  		$this->db->from('orders');
          $this->db->join('order_detail', 'orders.id_order = order_detail.id_orders','left');
          $this->db->join('user', 'orders.id_user = user.id_user','left');
          
  		$this->db->where('id_order', $id);
  		$query = $this->db->get();
  		return $query->row_array();
    }
    public  function getinpo1($id){
        $this->db->select('*');
  		$this->db->from('order_detail');
          $this->db->join('orders', 'orders.id_order = order_detail.id_orders','left');
          $this->db->join('products', 'products.id_products = order_detail.id_product','left');	
  		$this->db->where('id_orders', $id);
  		$query = $this->db->get();
  		return $query->result_array();
    }

}

/* End of file History_model.php */