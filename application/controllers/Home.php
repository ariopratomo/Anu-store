<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Products_model', 'products');
		$this->load->model('Home_model', 'homp');
		$this->load->model('Anu_model', 'anu');
		$this->load->model('Cart_model', 'cart');
		$this->load->library('pagination');
		
		$this->load->model('History_model', 'history');
		
	}

	public function index()
	{ 
		
		$data['user'] = $this->db->get_where('user',['email'=> 
						$this->session->userdata('email')])->row_array();
		$data['category'] = $this->products->getCategories();
		$data['products'] = $this->products->getProducts();
		

		// Tes pagination
		//konfigurasi pagination
        $config['base_url'] = site_url('/'); //site url
        $config['total_rows'] = $this->db->count_all('products'); //total row
        $config['per_page'] = 12;  //show record per halaman
        $config["uri_segment"] = 1;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
      $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center ">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(1)) ? $this->uri->segment(1) : 0;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['product'] = $this->homp->getpage($config["per_page"], $data['page']);           
 
		$data['pagination'] = $this->pagination->create_links();
		// $data['product'] = $this->homp->getpage($limit, $start);
// 

		$this->load->view('home/templates/header', $data);
		$this->load->view('home/templates/navbar');
		$this->load->view('home/home');
		$this->load->view('home/templates/footer');

		// tes pagination
		
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user',['email' => $email])->row_array();
		if ($user)
		{
			// Jika User Active
			if($user['is_active'] == 1){
                
                
                    // check password
                
                    if(password_verify($password, $user['password'])){
                        $data = [
									'email' => $user['email'],
									'nama'	=> $user['fullname']
								];
						$this->session->set_userdata($data);
						redirect('/');
 
                       

                    } else {
                        
                        $this->session->set_flashdata('message','Password Salah');
                        redirect('/');
                        
                    }
                    
                }
                else {

                    $this->session->set_flashdata('message','Email Belum Diaktivasi');
                    redirect('/');

                }
		}
		else {
			$this->session->set_flashdata('message','Email Tidak Terdaftar');
                        redirect('/');
		}
		
	}

	public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('message','Anda berhasil keluar');
            redirect('/');
    }
	
	public function p($id)
	{
		$data['category'] = $this->products->getCategories();
		$data['user'] = $this->db->get_where('user',['email'=> 
						$this->session->userdata('email')])->row_array();
		$data['p'] = $this->db->get_where('products',['id_products'=>$id])->row_array();
		$data['product'] = $this->products->getProducts();
		$this->load->view('home/templates/header', $data);
		$this->load->view('home/templates/navbar');
		$this->load->view('home/p');
		$this->load->view('home/templates/footer');
	}

	public function profil(){
		$data['user'] = $this->db->get_where('user',['email'=> 
						$this->session->userdata('email')])->row_array();
		$this->load->view('home/templates/header', $data);
		$email_tmp = $this->session->userdata('email');
		$idu = $this->cart->idu($email_tmp);
		$data['order'] = $this->history->getOrder($idu);
		$this->load->view('home/templates/navbar',$data);
		$this->load->view('home/profil/profil');
		$this->load->view('home/templates/footer');
	}

public function s(){
	$data['user'] = $this->db->get_where('user',['email'=> 
						$this->session->userdata('email')])->row_array();
		$data['category'] = $this->products->getCategories();
		$data['products'] = $this->products->getProducts();
		

		// Tes pagination
		//konfigurasi pagination
        $config['base_url'] = site_url('/s'); //site url
        $config['total_rows'] = $this->db->count_all('products'); //total row
        $config['per_page'] = 12;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center ">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
		// $data['product'] = $this->homp->getpage($config["per_page"], $data['page']);        
		$data['product'] = $this->homp->searcp($config["per_page"], $data['page']);           
 
		$data['pagination'] = "";
		// $data['product'] = $this->homp->getpage($limit, $start);
		// 

		$this->load->view('home/templates/header', $data);
		$this->load->view('home/templates/navbar');
		$this->load->view('home/home');
		$this->load->view('home/templates/footer');
}

public function k($id){
	$data['user'] = $this->db->get_where('user',['email'=> 
						$this->session->userdata('email')])->row_array();
		$data['category'] = $this->products->getCategories();
		$data['products'] = $this->products->getProducts();
		

		// Tes pagination
		//konfigurasi pagination
        $config['base_url'] = site_url('/s'); //site url
        $config['total_rows'] = $this->db->count_all('products'); //total row
        $config['per_page'] = 12;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center ">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link shadow-sm">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
		// $data['product'] = $this->homp->getpage($config["per_page"], $data['page']);        
		$data['product'] = $this->homp->getPbyIdcat($id);           
 
		$data['pagination'] = "";
		// $data['product'] = $this->homp->getpage($limit, $start);
		// 

		$this->load->view('home/templates/header', $data);
		$this->load->view('home/templates/navbar');
		$this->load->view('home/home');
		$this->load->view('home/templates/footer');
}
public function pembayaran(){
    $data['user'] = $this->db->get_where('user',['email'=> 
    $this->session->userdata('email')])->row_array();


    $this->load->view('home/templates/header', $data);
    $this->load->view('home/templates/navbar');
    $this->load->view('home/pembayaran');
    $this->load->view('home/templates/footer');
}





}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */