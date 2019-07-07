<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function getProdbyId($id){
		$this->db->select('*');
  		$this->db->from('products');
  		$this->db->join('categories', 'products.id_categories = categories.id_categories','left');	
  		$this->db->order_by('id_products', 'asc');
  		$this->db->where('id_products', $id);

  		$query = $this->db->get();
  		return $query->result_array();
		
    }
    
    
  public function find($id_products){
    $query = $this->db->get_where('products',array('id_products'=>$id_products));
    return $query->result();

  }
	function validate_add_cart_item(){
     
    $id = $this->input->post('product_id'); // Assign posted product_id to $id
    $cty = $this->input->post('qty'); // Assign posted quantity to $cty
     
    $this->db->where('id_products', $id); // Select where id matches the posted id
    $query = $this->db->get('products', 1); // Select the products where a match is found and limit the query by 1
     
    // Check if a row has matched our product id
    if($query->num_rows > 0){
     
    // We have a match!
        foreach ($query->result() as $row)
        {
            // Create an array with product information
            $data = array(
                'id'      => $id,
                'qty'     => $cty,
                'price'   => $row->price_total,
                'name'    => $row->name_products
            );
 
            // Add the data to the cart using the insert function that is available because we loaded the cart library
            $this->cart->insert($data); 
             
            return TRUE; // Finally return TRUE
        }
     
    }else{
        // Nothing found! Return FALSE! 
        return FALSE;
    }
}
    public function cartPrice(){
        $this->db->where('id_product',$this->input->post('id_product'));
		$this->db->select('c_price');
        $c= $this->db->get('cart')->row_array();
        $string = implode($c);
            return $string;
    }
    public function cartWeight(){
        $this->db->where('id_product',$this->input->post('id_product'));
		$this->db->select('c_weight');
        $c= $this->db->get('cart')->row_array();
        $string = implode($c);
            return $string;
    }
    public function pWeight(){
        $this->db->where('id_products',$this->input->post('id_product'));
		$this->db->select('weight');
        $c= $this->db->get('products')->row_array();
        $string = implode($c);
            return $string;
    }
    public function pStock(){
        $this->db->where('id_products',$this->input->post('id_product'));
		$this->db->select('stock');
        $c= $this->db->get('products')->row_array();
        $string = implode($c);
            return $string;
    }
    public function cartIduser(){
        $this->db->where('id_product',$this->input->post('id_product'));
		$this->db->select('id_user');
        $c= $this->db->get('cart')->row_array();
        $string = implode($c);
            return $string;
    }
    public function cartSize(){
        $this->db->where('id_product',$this->input->post('id_product'));
		$this->db->select('size');
        $c= $this->db->get('cart')->row_array();
        $string = implode($c);
            return $string;
    }
    public function cartQty(){
        $this->db->where('id_product',$this->input->post('id_product'));
        $this->db->select('qty');
        $c= $this->db->get('cart')->row_array();
        $string = implode($c);
            return $string;
    }
    public function cartQty2(){
        $this->db->where('id_product',$this->input->post('id_product'));
        $this->db->where('status_tmp', 0);
        $this->db->select('qty');
        $c= $this->db->get('cart')->row_array();
        $string = implode($c);
            return $string;
    }
    public function cartIdproduct(){
        $this->db->where('id_product',$this->input->post('id_product'));
		$this->db->select('id_product');
        $c= $this->db->get('cart')->row_array();
        $string = implode($c);
            return $string;
    }
    public function tssprice($idu){
    
        $this->db->where('id_user' ,$idu);
        $this->db->where('status_tmp' ,0);
        $this->db->where('id_product',$this->input->post('id_product'));
        $this->db->from('cart');
        $anu = $this->db->get()->num_rows();
        return $anu;
        }
    // tes pagination
    public function getpage($limit, $start){
		$this->db->select('*');
  		$this->db->from('products');
  		$this->db->join('categories', 'products.id_categories = categories.id_categories','left');	
  		$this->db->order_by('id_products', 'asc');
        $this->db->limit($limit, $start);
        
  		$query = $this->db->get();
  		return $query->result_array();
	
    }
    public function searcp(){
        $this->db->select('*');
  		$this->db->from('products');
  		$this->db->join('categories', 'products.id_categories = categories.id_categories','left');	
  		$this->db->order_by('id_products', 'asc');
        $this->db->like('name_products',$this->input->post('cari'));
  		$query = $this->db->get();
  		return $query->result_array();
    }
    public function getPbyIdcat($id){
		$this->db->select('*');
  		$this->db->from('products');
  		$this->db->join('categories', 'products.id_categories = categories.id_categories','left');	
  		$this->db->order_by('id_products', 'asc');
  		$this->db->where('products.id_categories', $id);

  		$query = $this->db->get();
  		return $query->result_array();
		
    }
    
   
}

/* End of file Home_model.php */
/* Location: ./application/models/Home_model.php */