<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
	public function getProduct()
	{
	
  	$this->db->select('*');
  	$this->db->from('product');
  	$this->db->join('category', 'product.category_id = category.category_id','left');
  	$this->db->join('sub_category', 'product.subcategory_id = sub_category.id_sc','left');	
  	$this->db->order_by('id_product', 'asc');

  	$query = $this->db->get();
  	return $query->result_array();

	}

  public function getProductByid($p_id)
  {
    return $this->db->get_where('product',['id_product'=>$p_id])->result_array();

  }

  public function delprod($id)
  {
    $this->db->where('id_product',$id);
        $this->db->delete('product');
  }

  public function getcat(){
  	$hasil=$this->db->query("SELECT * FROM category");
          return $hasil;
  }
  	public function getCategory(){
  		$this->db->select('*');
  		$this->db->from('category');
  		$this->db->order_by('category','ASC');
  		$query = $this->db->get();
  	return $query->result_array();

  	}

  public function deleteCategory($id){
        $this->db->where('category_id',$id);
        $this->db->delete('category');
  }
	
	public function updateCat($c_id){
        $data = ['category' => $this->input->post('category')];
            $this->db->where('category_id', $c_id);
            $this->db->update('category', $data);
  }

  public function getsubcat(){
	    
    $this->db->select('*');
		$this->db->from('sub_category');
		$this->db->join('category', 'category.category_id = sub_category.category_id');
		$this->db->order_by('subcategory','ASC');

		$query = $this->db->get();
		return $query->result_array();
  }

  public function deletesubCat($id_sc){
        $this->db->where('id_sc',$id_sc);
        $this->db->delete('sub_category');
  }
  
  public function updatesubCat($id_sc){
        	$data = ['category_id' => $this->input->post('category_id'),
        				'subcategory' => $this->input->post('subcategory')];
            $this->db->where('id_sc', $id_sc);
            $this->db->update('sub_category', $data);
    }

   // Coba Chain
 //   function fetch_category()
 // {
 //  $this->db->order_by("category", "ASC");
 //  $query = $this->db->get("category");
 //  return $query->result();
 // }

   function fetch_subcat($category_Id)
   {
    $this->db->where('category_id', $category_Id);
    $this->db->order_by('subcategory', 'ASC');
    $query = $this->db->get('sub_category');
    $output = '<option value="">Select Subcategory</option>';
    foreach($query->result() as $row)
    {
     $output .= '<option value="'.$row->id_sc.'">'.$row->subcategory.'</option>';
    }
    return $output;
   }

   public function getMyproduct(){
    $this->db->select('*');
    $this->db->from('myproducts');
    $this->db->join('products', 'myproducts.product_id = products.product_id', 'left');
    $this->db->join('stock', 'myproducts.stock_id = stock.stock_id', 'left');
    return $this->db->get('')->result_array();
   }

}

/* End of file product.php */
/* Location: ./application/models/product.php */