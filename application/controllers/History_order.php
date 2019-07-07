<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class History_order extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Products_model', 'products');
		$this->load->model('Home_model', 'homp');
		$this->load->model('Anu_model', 'anu');
        $this->load->model('Cart_model', 'cart');
        $this->load->model('History_model', 'history');
		
		
	}

	public function index()
	{ 
		$data['user'] = $this->db->get_where('user',['email'=> 
						$this->session->userdata('email')])->row_array();
		$data['category'] = $this->products->getCategories();
        $data['product'] = $this->products->getProducts();
        $email_tmp = $this->session->userdata('email');
		$idu = $this->cart->idu($email_tmp);
        $data['order'] = $this->history->getOrder($idu);
        if ($data['user']) {
        $this->load->view('home/templates/header', $data);
		$this->load->view('home/templates/navbar');
		$this->load->view('home/history');
        $this->load->view('home/templates/footer');
            if ($this->input->post('upload')=='upload'){
                $data=[
                    "id_user" => $this->input->post('id_user'),
                    "id_order" => $this->input->post('id_order'),
                    "code_bank" => $this->input->post('code_bank'),
                    "acc_name" => $this->input->post('acc_name'),
                    "dest_rek" => $this->input->post('dest_rek'),
                    "norek" => $this->input->post('norek'),
                ];
                $upload_image = !empty($_FILES['image']['name']);

                if ($upload_image) {

                    $config['upload_path']   = './include/assets/img/proof/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name']     = $this->input->post('id_order')."_".time('Y');
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
                $insert=$this->db->insert('payment',$data);
                if($insert){
                    $this->db->update('orders',['status'=>"Proses"]);
                    $this->db->where('id_order', $this->input->post('id_order'));
                    
                    redirect('history_order','refresh');
                    
                }
            }
        }
        else{
            redirect(base_url());
        }
        
		
    }
    
    public function detail($id){
        $data['user'] = $this->db->get_where('user',['email'=> 
                        $this->session->userdata('email')])->row_array(); 
        if ($data['user']) {
            $data['inpo']=$this->history->getinpo($id);
            $data['inpo1']=$this->history->getinpo1($id);
            $this->load->view('home/inpo',$data);
            if ($this->input->post('upload')=='upload'){
                $data=[
                    "id_user" => $this->input->post('id_user'),
                    "id_order" => $this->input->post('id_order'),
                    "code_bank" => $this->input->post('code_bank'),
                    "acc_name" => $this->input->post('acc_name'),
                    "dest_rek" => $this->input->post('dest_rek'),
                    "norek" => $this->input->post('norek'),
                ];
                $upload_image = !empty($_FILES['image']['name']);

                if ($upload_image) {
    
                    $config['upload_path']   = './include/assets/img/proof/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name']     = $this->input->post('id_order')."_".time('Y');
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
                 $insert=$this->db->insert('payment',$data);
                 if($insert){
                     $this->db->update('orders',['status'=>"Proses"]);
                     $this->db->where('id_order', $this->input->post('id_order'));
                     
                 }
            }
        }
        else{
            redirect(base_url());
        }
    }

}

/* End of file History_order.php */