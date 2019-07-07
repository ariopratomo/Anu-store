<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {
	public function getProducts()
	{
	
  	$this->db->select('*');
  	$this->db->from('products');
  	$this->db->join('categories', 'products.id_categories = categories.id_categories','left');	
  	$this->db->order_by('id_products', 'asc');
  	$query = $this->db->get();
  	return $query->result_array();

	}


  public function getProductByid($p_id)
  {
    return $this->db->get_where('products',['id_products'=>$p_id])->result_array();

  }

  public function delprod($id)
  {
    $this->db->where('id_products',$id);
        $this->db->delete('products');
  }


function fetch_codep($category_Id)
   {

    
    $this->db->where('id_categories', $category_Id);
    $this->db->order_by('code_categories', 'ASC');
    $query = $this->db->get('categories');
    $output = '';
    foreach($query->result() as $row)
    {
     $output .=$row->code_categories;
    }
    

    $this->db->select('right(code_products,4) as kode', false);
    $this->db->order_by('code_products','desc');
    $this->db->limit(1);
    $query=$this->db->get('products');
    if($query->num_rows()<>0){
      $data=$query->row();
      $kode=intval($data->kode)+1;
    } else {
      $kode=1;
    }

    $kodemax=str_pad($kode,4,"0",STR_PAD_LEFT);
    $kodejadi=$output.$kodemax;

    return $kodejadi;

    // $this->db->where('id_categories', $category_Id);
    // $this->db->order_by('code_categories', 'ASC');
    // $query = $this->db->get('categories');
    // $output = '';
    // foreach($query->result() as $row)
    // {
    //  $output .=$row->code_categories;
    // }
    
    // $q = $this->db->query("SELECT MAX(LEFT(code_products,4)) AS kd_max FROM products WHERE DATE(date)=CURDATE()");
    //     $kd = "";
    //     if($q->num_rows()>0){
    //         foreach($q->result() as $k){
    //             $tmp = ((int)$k->kd_max)+1;
    //             $kd = sprintf("%04s", $tmp);
    //         }
    //     }else{
    //         $kd = "0001";
    //     }
    //     date_default_timezone_set('Asia/Jakarta');
    //     return $output.$kd;
    
   }
 
function fetch_codecat($category_Id)
   {
    $this->db->where('id_categories', $category_Id);
    $this->db->order_by('code_categories', 'ASC');
    $query = $this->db->get('categories');
    $output = '';
    foreach($query->result() as $row)
    {
     $output .=$row->code_categories;
    }
    return $output;
   }


  public function getcat(){
  	$hasil=$this->db->query("SELECT * FROM categories");
          return $hasil;
  }
  	public function getCategories(){
  		$this->db->select('*');
  		$this->db->from('categories');
  		$this->db->order_by('name_categories','ASC');
  		$query = $this->db->get();
  	return $query->result_array();
  	}

  public function deleteCategories($id){
        $this->db->where('id_categories',$id);
        $this->db->delete('categories');
  }
	
	public function updateCat($c_id){
        $data = ['name_categories' => $this->input->post('name'),
                  'code_categories' => $this->input->post('code')];
            $this->db->where('id_categories', $c_id);
            $this->db->update('categories', $data);
  }

}

/* End of file product.php */
/* Location: ./application/models/product.php */