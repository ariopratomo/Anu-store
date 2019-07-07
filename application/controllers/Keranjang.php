<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Products_model', 'products');
		$this->load->model('Home_model', 'homp');
		$this->load->model('Anu_model', 'anu');
		$this->load->model('Cart_model', 'cart');
		
		
	}

    public function index()
    {
        $data['category'] = $this->products->getCategories();
		$data['user'] = $this->db->get_where('user',['email'=> 
						$this->session->userdata('email')])->row_array();
		$email_tmp = $this->session->userdata('email');
		$idu = $this->cart->idu($email_tmp);
		$data['tprice'] = $this->cart->tprice($idu);
		$data['tweight'] = $this->cart->tweight($idu);
		
		$data['product'] = $this->products->getProducts();
		$data['keranjang'] = $this->cart->getcart($idu);
		
		// $arr = array();
        
        

		if ($data['user']) {
			
			
        $this->load->view('home/templates/header', $data);
		$this->load->view('home/templates/navbar');
		$this->load->view('home/keranjang');
		$this->load->view('home/templates/footer');
		}
		else{
			$this->session->set_flashdata('message','Anda Belum Login');
			redirect('/');
		}
    }
    
    public function tambah_keranjang (){
		$data['user'] = $this->db->get_where('user',['email'=> 
						$this->session->userdata('email')])->row_array();
		$data['id_product'] = $this->db->get_where('cart',['id_product' => $this->input->post('id_product')])->row_array();
		$email_tmp = $this->session->userdata('email');
		$idu = $this->cart->idu($email_tmp);
		  $tsprice = $this->cart->tsprice($idu);
		  $tssprice =$this->homp->tssprice($idu);
		
		
 		if ($data['user']) {

			
				// $id_product = $this->homp->cartIdproduct();
				// $qty = $this->homp->CartQty();
				// $price = $this->homp->cartPrice();
				// $weight = $this->homp->cartWeight();
				// $id_user = $this->homp->cartIduser();
				// $stock = $this->homp->pStock();
				
				// // $qty2 = $this->homp->cartQty2();
				// // $qty1= $this->input->post('qty')+$qty2;
				if ( $idu == $this->input->post('id_user') && $this->input->post('qty')+$this->homp->cartQty2()<=$this->homp->pStock() && $tssprice>=1 ){
					$qty = $this->homp->CartQty();
					$price = $this->homp->cartPrice();
					$weight = $this->homp->cartWeight();
					$id_user = $this->homp->cartIduser();
					$array = [
						'id_product'=> $this->input->post('id_product'),
						'qty'     => $this->input->post('qty')+$qty,
						'c_price'   => $this->input->post('total_price') * $this->input->post('qty')+$price,
						'c_weight'   => $this->input->post('weight') * $this->input->post('qty')+$weight,
						'note' => $this->input->post('note')
						];
						$this->db->where('id_product',$array['id_product']);
						$this->db->where('id_user', $this->input->post('id_user'));
						$this->db->where('status_tmp',0);
						$this->db->update('cart',$array);
						redirect('keranjang');
				}
				elseif ( $idu == $this->input->post('id_user') && $this->input->post('qty')+$this->homp->cartQty2()>$this->homp->pStock() ){
					$this->session->set_flashdata('message', 'Jumlah melebihi stock');

					// redirect('keranjang');
					echo "<script type='text/javascript'>history.go(-1);</script>";
				}
				elseif($tssprice<=0){
					
					$array = [
						'id_product'=> $this->input->post('id_product'),
						'id_user' => $this->input->post('id_user'),
						'qty'     => $this->input->post('qty'),
						'c_price'   => $this->input->post('total_price') * $this->input->post('qty'),
						'note' => $this->input->post('note'),
						'c_weight'   => $this->input->post('weight') * $this->input->post('qty')
						
						];
						$this->db->where('status_tmp',0);
						$this->db->insert('cart',$array);
						redirect('keranjang');
				}
				
			

		

 		}
 		else{
			$this->session->set_flashdata('message','Anda Belum Login');
			redirect('/');
		}
		
		
	}

	public function delcart($id){
		$this->db->where('id_cart', $id);
		$del = $this->db->delete('cart');
		if ($del) {
			$this->session->set_flashdata('message','Dihapus');
			redirect('keranjang');
		}
		
	}
	public function updatecart($id){
		$price = $this->cart->pPrice();
		$stock = $this->cart->pStock();
		$weight = $this->homp->pWeight();
		if ($this->input->post('qty')>$stock) {
			$this->session->set_flashdata('message', 'Jumlah melebihi stock');

		redirect('keranjang');
		}else{
			$data = ['note' => $this->input->post('note'),
			'c_price' => $this->input->post('qty') * $price,
					  'qty' => $this->input->post('qty'),
					  'c_weight'   => $this->input->post('qty') * $weight
					  
					
				];
				$this->db->where('id_cart', $id);
				$this->db->update('cart', $data);
			$this->session->set_flashdata('message', 'Keranjang berhasil di update');
	
			redirect('keranjang');
		}
			
	}

	public function transaksi(){
	$this->cart->anu();
	
	}

}

/* End of file Controllername.php */