<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

     public function __constract()
    {
        parent::__constract();
          $this->load->library('form_validation');
          is_logged_in();
    }

    public function index(){
        $data['title'] = 'Dashboard';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/index');
        $this->load->view('admin/templates/footer');
    }
}