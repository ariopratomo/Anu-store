<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Products_model', 'products');
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Products';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();

		$data['products'] = $this->products->getProducts();

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/navbar');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('products/index', $data);
		$this->load->view('admin/templates/footer');
	}

	public function addproducts() {

		$data['title'] = 'Add New Product';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('product', 'Product Name', 'required');
		$this->form_validation->set_rules('stock', 'Stock', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		$this->form_validation->set_rules('discount', 'Discount', 'required');
		$this->form_validation->set_rules('price_total', 'Price Total', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('code_p', 'Products Code', 'required|is_unique[products.code_products]',
			array(
                'is_unique' => 'This %s already exists.'
        ));

          $codecat = $this->input->post('codecat');


		$data['categories']    = $this->products->getCategories();
		// $data['codepe']    = $this->products->getcodep();

		if ($this->form_validation->run() == false) {

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/templates/navbar');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('products/new_products', $data);
			$this->load->view('admin/templates/footer');

		} else {

			$data = [
				'id_categories'    => $this->input->post('category'),
				'name_products'        => $this->input->post('product'),
				'description'    => $this->input->post('description'),
				'price'          => $this->input->post('price'),
				'discount'       => $this->input->post('discount'),
				'price_total'    => $this->input->post('price_total'),
				'stock'          => $this->input->post('stock'),
				'code_products'  => $this->input->post('code_p'),
				'weight'         => $this->input->post('weight'),
				'date'      => date('Y-m-d')
			];

			$upload_image = !empty($_FILES['image']['name']);

			if ($upload_image) {

				$config['upload_path']   = './include/assets/img/products/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name']     = $this->input->post('category')."_".time('Y');
				$config['overwrite']     = true;
				$config['max_size']      = '2048';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('image')) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$image = $this->upload->data('file_name');
					$this->db->set('image', $image);
				}
			}

			$this->db->insert('products', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Product Successfully Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
			redirect('product');
		}
	}

	

	public function delProduct($id) {

		$this->db->where('id_products', $id);
		$query = $this->db->get('products');
		$row   = $query->row();
		if (!empty($row->image)) {
			unlink("./include/assets/img/products/$row->image");
		}
		$this->products->delprod($id);
		$this->session->set_flashdata('message', '<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

		redirect('product');
	}

	public function editproduct($id) {

		$data['title'] = 'Edit Product';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();

		$data['p'] = $this->db->get_where('products',['id_products'=>$id])->row_array();

		$this->form_validation->set_rules('product', 'Product Name', 'required');
		$this->form_validation->set_rules('stock', 'Stock', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		$this->form_validation->set_rules('discount', 'Discount', 'required');
		$this->form_validation->set_rules('price_total', 'Price Total', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		$data['category']    = $this->products->getCategories();

		if ($this->form_validation->run() == false) {

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/templates/navbar');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('products/edit', $data);
			$this->load->view('admin/templates/footer');
		} else {
			$data = [
				'id_categories'    => $this->input->post('category'),
				'name_products'       => $this->input->post('product'),
				'description'    => $this->input->post('description'),
				'price'          => $this->input->post('price'),
				'discount'       => $this->input->post('discount'),
				'price_total'    => $this->input->post('price_total'),
				'stock'          => $this->input->post('stock'),
				'code_products'  => $this->input->post('code_p'),
				'weight'         => $this->input->post('weight'),
				
			];

			$upload_image = !empty($_FILES['image']['name']);
            if ($upload_image) {
                $config['upload_path'] = './include/assets/img/products/';
                $config['allowed_types'] = 'gif|jpg|png';
								$config['max_size']  = '2048';
								$config['file_name']     = $this->input->post('category')."_".time('Y');
								$config['overwrite']     = true;
                
                $this->load->library('upload', $config);
                
                if ( ! $this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else{
									
                    $old_image = $data['p']['image'];
                    unlink(FCPATH.'include/assets/img/products/'.$old_image);
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image',$new_image);
                }
            }
            $this->db->where('id_products', $this->input->post('id_products'));
            $this->db->update('products',$data);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Product Successfullt Edited!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
			redirect('product');
		}
	}

		// Jquery codecat
	public function fetch_codecat() {

		if ($this->input->post('category_Id')) {
			echo $this->products->fetch_codecat($this->input->post('category_Id'));
		}
	}
	// Jquery codep
	public function fetch_codep() {

		if ($this->input->post('category_Id')) {
			echo $this->products->fetch_codep($this->input->post('category_Id'));
		}
	}


	public function categories(){
		$data['title'] = 'Categories';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('name', 'Categoires Name', 'required');
		$this->form_validation->set_rules('code', 'Categoires Code', 'required|is_unique[categories.code_categories]', array(
                'is_unique'     => 'This %s already exists.'
        ));
		$data['categories'] = $this->products->getCategories();
		if ($this->form_validation->run() == false) {

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/templates/navbar');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('products/categories', $data);
			$this->load->view('admin/templates/footer');
		} else {
			$this->db->insert('categories', ['name_categories' => $this->input->post('name'),
											'code_categories' => $this->input->post('code')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Menu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

			redirect('product/categories');
		}
	}

	public function deleteCat($id) {

		$this->products->deleteCategories($id);
		$this->session->set_flashdata('message', '<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

		redirect('product/categories');
	}
	public function updatecat($c_id) {

		$this->products->updateCat($c_id);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Update Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

		redirect('product/categories');
	}

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */ 