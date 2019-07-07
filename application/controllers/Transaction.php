<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('Products_model', 'products');
            $this->load->model('Home_model', 'homp');
            $this->load->model('Anu_model', 'anu');
            $this->load->model('Cart_model', 'cart');
            $this->load->model('History_model', 'history');
            
            
        }
        public function index(){
            $data['title'] = 'Dashboard';
            $data['admin'] = $this->db->get_where('admin',['email' => 
            $this->session->userdata('email')])->row_array();
            $data['order'] = $this->db->query("SELECT * FROM `orders`
            JOIN `user` ON `user`.`id_user`=`orders`.`id_user` 
             ORDER BY `date` ASC")->result_array();
            $this->load->view('admin/templates/header',$data);
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/templates/sidebar');
            $this->load->view('transaction/transaction');
            $this->load->view('admin/templates/footer');
            

            if ($this->input->post('input') == "Input") {
                $id_order = $this->input->post('id_order');
                $this->form_validation->set_rules('resi','Resi','required|trim');
                
                $data=['status' =>'Terkirim',
                        'resi'  => $this->input->post('resi'),
                        ];
                
                $this->db->where('id_order',$id_order);
                $this->db->update('orders',$data);
                redirect(base_url('transaction'),'refresh');
                
            }
        }

        public function delete_order($id){     
            $this->db->where('id_order',$id);
            $this->db->delete('orders'); 
            redirect(base_url('transaction'));
        }

        public function detail_order($id){
            $data['inpo']=$this->history->getinpo($id);
            $data['inpo1']=$this->history->getinpo1($id);
            $this->load->view('transaction/detail',$data);
        }
        public function reject_order($id){     
            $this->db->where('id_order',$id);
            $data=['status'=>'Ditolak'];
            $this->db->update('orders',$data); 
            redirect(base_url('transaction'));
        }
    

}

/* End of file Transaction.php */