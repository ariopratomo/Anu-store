<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct() {

		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Product_model', 'product');
		is_logged_in();

	}

	public function index() {

		$data['title'] = 'Product';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();

		$data['product'] = $this->product->getProduct();

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/navbar');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('product/index', $data);
		$this->load->view('admin/templates/footer');

	}

	public function addproduct() {

		$data['title'] = 'Add New Product';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('product', 'Product Name', 'required');
		$this->form_validation->set_rules('stock', 'Stock', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('subcategory', 'Subcategory', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		$this->form_validation->set_rules('discount', 'Discount', 'required');
		$this->form_validation->set_rules('price_total', 'Price Total', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		$data['category']    = $this->product->getCategory();
		$data['subcategory'] = $this->product->getsubcat();

		if ($this->form_validation->run() == false) {

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/templates/navbar');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('product/new_product', $data);
			$this->load->view('admin/templates/footer');

		} else {

			$data = [
				'category_id'    => $this->input->post('category'),
				'subcategory_id' => $this->input->post('subcategory'),
				'product'        => $this->input->post('product'),
				'description'    => $this->input->post('description'),
				'price'          => $this->input->post('price'),
				'discount'       => $this->input->post('discount'),
				'price_total'    => $this->input->post('price_total'),
				'stock'          => $this->input->post('stock'),
				'dateinput'      => time()
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

			$this->db->insert('product', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Product Successfully Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
			redirect('product');
		}
	}

	public function editproduct($id) {

		$data['title'] = 'Edit Product';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();

		$data['p'] = $this->db->get_where('product',['id_product'=>$id])->row_array();

		$this->form_validation->set_rules('product', 'Product Name', 'required');
		$this->form_validation->set_rules('stock', 'Stock', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('subcategory', 'Subcategory', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		$this->form_validation->set_rules('discount', 'Discount', 'required');
		$this->form_validation->set_rules('price_total', 'Price Total', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		$data['category']    = $this->product->getCategory();
		$data['subcategory'] = $this->product->getsubcat();

		if ($this->form_validation->run() == false) {

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/templates/navbar');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('product/product_edit', $data);
			$this->load->view('admin/templates/footer');
		} else {
			$data = [
				'category_id'    => $this->input->post('category'),
				'subcategory_id' => $this->input->post('subcategory'),
				'product'        => $this->input->post('product'),
				'description'    => $this->input->post('description'),
				'price'          => $this->input->post('price'),
				'discount'       => $this->input->post('discount'),
				'price_total'    => $this->input->post('price_total'),
				'stock'          => $this->input->post('stock'),
				'dateinput'      => time()
			];

			$upload_image = !empty($_FILES['image']['name']);
            if ($upload_image) {
                $config['upload_path'] = './include/assets/img/products/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']  = '2048';
                
                $this->load->library('upload', $config);
                
                if ( ! $this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else{
                    $old_image = $data['admin']['image'];
                    unlink(FCPATH.'include/assets/img/products/'.$old_image);
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image',$new_image);
                }
            }
            $this->db->where('id_products', $email);
            $this->db->update('admin');
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Product Successfully Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

			redirect('product');
		}
	}
	public function edittest($id) {
		
		$data['p'] = $this->db->get_where('product',['id_product'=>$id])->row_array();

		$this->load->view('product/product_edit_test', $data);
		

		
	}

	// Jquery subcategory
	public function fetch_subcat() {

		if ($this->input->post('category_Id')) {
			echo $this->product->fetch_subcat($this->input->post('category_Id'));
		}
	}

	public function delProduct($id) {

		$this->db->where('id_product', $id);
		$query = $this->db->get('product');
		$row   = $query->row();
		if (!empty($row->image)) {
			unlink("./include/assets/img/products/$row->image");
		}
		$this->product->delprod($id);
		$this->session->set_flashdata('message', '<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

		redirect('product');
	}

	// Category

	public function category() {

		$data['title'] = 'Category';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('category', 'Category', 'required');
		$data['category'] = $this->product->getCategory();
		if ($this->form_validation->run() == false) {

			$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/templates/navbar');
			$this->load->view('admin/templates/sidebar');
			$this->load->view('product/category', $data);
			$this->load->view('admin/templates/footer');
		} else {
			$this->db->insert('category', ['category' => $this->input->post('category')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Menu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

			redirect('product/category');
		}
	}

	public function deleteCat($id) {

		$this->product->deleteCategory($id);
		$this->session->set_flashdata('message', '<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

		redirect('product/category');
	}

	public function updatecat($c_id) {

		$this->product->updateCat($c_id);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Update Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

		redirect('product/category');
	}

	// Subcategory

	// public function subcategory() {

	// 	$data['title'] = 'Subcategory';
	// 	$data['admin'] = $this->db->get_where('admin', ['email' =>
	// 			$this->session->userdata('email')])->row_array();
	// 	$data['category']    = $this->db->get('category')->result_array();
	// 	$data['subcategory'] = $this->product->getsubcat();

	// 	$this->form_validation->set_rules('subcategory', 'Subcategory', 'required');
	// 	$this->form_validation->set_rules('category_id', 'Category', 'required');

	// 	if ($this->form_validation->run() == false) {
	// 		$this->load->view('admin/templates/header', $data);
	// 		$this->load->view('admin/templates/navbar');
	// 		$this->load->view('admin/templates/sidebar');
	// 		$this->load->view('product/subcategory', $data);
	// 		$this->load->view('admin/templates/footer');
	// 	} else {
	// 		$data = [
	// 			'subcategory' => $this->input->post('subcategory'),
	// 			'category_id' => $this->input->post('category_id')

	// 		];
	// 		$this->db->insert('sub_category', $data);
	// 		$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New SubMenu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

	// 		redirect('product/subcategory');

	// 	}
	// }

	// public function deletesubCat($id_sc) {

	// 	$this->product->deletesubCat($id_sc);
	// 	$this->session->set_flashdata('message', '<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

	// 	redirect('product/subcategory');
	// }

	// public function updatesubcat($id_sc) {

	// 	$this->product->updatesubCat($id_sc);
	// 	$this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Update Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');

	// 	redirect('product/subcategory');
	// }

	public function myproduct(){

		$data['product'] = $this->product->getMyproduct();
		$data['title'] = 'Myproduct';
		$data['admin'] = $this->db->get_where('admin', ['email' =>
				$this->session->userdata('email')])->row_array();

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/navbar');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('product/myproduct', $data);
		$this->load->view('admin/templates/footer');
	}



}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */