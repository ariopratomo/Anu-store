<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->model('Products_model', 'products');
		$this->load->model('Home_model', 'homp');
		$this->load->model('Anu_model', 'anu');
		
	}
	public function index()
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required',
											array(
												'required'      => '%s harus diisi.'
											)
										);
										
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]',
											array(
												'required'      => '%s harus diisi.',
												'is_unique'     => '%s ini sudah terdaftar.'
											)
										);

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]',
											array(
												'required'      => '%s harus diisi.',
												'min_length'	=> '%s minimal 6 huruf'
											)
										);
		$this->form_validation->set_rules('passwordc', 'Konfirmasi Password', 'trim|required|matches[password]',
											array(
												'required'      => '%s harus diisi.',
												'matches'	=> '%s harus sama'
											)
										);
		$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required',
											array(
												'required'      => 'Pilih %s anda.'
											)
										);

		$data['provinsi']=$this->anu->provinsi();
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('home/signup/index', $data);
		} else {
			
			$data =[
				'fullname' => htmlspecialchars($this->input->post('nama'),  true),
				'email' => htmlspecialchars($this->input->post('email'), true),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT) ,
				'gender' => $this->input->post('gender'),
				// 'province_id' => $this->input->post('prov'),
				// 'regency_id' => $this->input->post('kab'),
				// 'district_id' => $this->input->post('kec'),
				// 'village_id' => $this->input->post('kel'),
				'address' => htmlspecialchars($this->input->post('alamat'), true),
				'date_created' => date('Y-m-d'),
				'is_active' => 1
			];
			
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message','Berhasil Mendaftar');

			redirect('/');
		}

		
	}

 
	function ambil_data(){

		$modul=$this->input->post('modul');
		$id=$this->input->post('id');

		if($modul=="kabupaten"){
			echo $this->anu->kabupaten($id);
		}
		else if($modul=="kecamatan"){
			echo $this->anu->kecamatan($id);
		
		}
		else if($modul=="kelurahan"){
			echo $this->anu->kelurahan($id);
		}
	}

}

/* End of file signup.php */
/* Location: ./application/controllers/signup.php */  ?>