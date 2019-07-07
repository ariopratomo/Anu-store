 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {
    
    public function getcart($idu){

        $this->db->select('*');
        
        $this->db->where('id_user' ,$idu);
        $this->db->where('status_tmp' ,0);
    
        $this->db->from('cart');

        $this->db->join('products', 'cart.id_product = products.id_products', 'left');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function idu($email_tmp){
        $this->db->where('email',$email_tmp);
		$this->db->select('id_user');
        $c= $this->db->get('user')->row_array();
        $string = implode($c);
            return $string;
    }
    
    public function tprice($idu){
        $this->db->select_sum('c_price');
    $this->db->where('id_user' ,$idu);
    $this->db->where('status_tmp' ,0);
    $this->db->from('cart');
    $anu = $this->db->get()->row_array();
    $string = implode($anu);
            return $string;
    }
    public function tsprice($idu){
    
    $this->db->where('id_user' ,$idu);
    $this->db->where('status_tmp' ,0);
    $this->db->from('cart');
    $anu = $this->db->get()->num_rows();
    return $anu;
    }
    public function tweight($idu){
        $this->db->select_sum('c_weight');
    $this->db->where('id_user' ,$idu);
    $this->db->where('status_tmp' ,0);
    $this->db->from('cart');
    $anu = $this->db->get()->row_array();
    $string = implode($anu);
            return $string;
    }
    
    public function pPrice(){
        $this->db->where('id_products',$this->input->post('id_product'));
		$this->db->select('price_total');
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
    public function anu(){
        
            $usersCount = count($_POST["idc"]);
            for($i=0;$i<$usersCount;$i++) {
            // $this->db->query( "DELETE cart  WHERE id_cart='" . $_POST["idc"][$i] . "'");
            
                $this->db->where_in('id_cart', $_POST["idc"]);
            
            $delete = $this->db->delete('cart');
            return $delete;
            }
            
            
    }
    public function getcart1($idu){

 
        
        $this->db->where('id_user' ,$idu);
        $this->db->where('status_tmp' ,0);
    
        $this->db->from('cart');

        $query = $this->db->get();
        return $query->result_array();
    }
    public function getid_order($idu){
        $this->db->limit(1);
        $this->db->select('id_order');
        $this->db->where('id_user',$idu);
        $this->db->where('status','Menunggu Pembayaran');
        $this->db->order_by('id_order','DESC');
        $idorder=$this->db->get('orders');
    return $idorder->row_array();

    }

    public function carta($idu){
        $this->db->where('id_user', $idu); // Select where id matches the posted id
        $query = $this->db->get('cart', 1);
        return $query->num_rows();
    }
    

}

/* End of file ModelName.php */