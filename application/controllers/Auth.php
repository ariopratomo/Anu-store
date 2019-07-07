<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

     public function __constract()
    {
        parent::__constract();
        $this->load->library('form_validation');
    }

    public function index(){
        if($this->session->userdata('email')){
            redirect('admin');
        }
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');       
        
        if ( $this->form_validation->run() == false ){
            
        $data['title'] = 'News Portal Login Page';
        $this->load->view('auth/templates/auth-header');
        $this->load->view('auth/login');
        $this->load->view('auth/templates/auth-footer');

        } else{
            $this->_login();
        }

    }
        private function _login(){
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $admin = $this->db->get_where('admin',['email' => $email])->row_array();

            if($admin){
                // if admin active
                if($admin['is_active'] == 1){
                    // check password
                    if(password_verify($password, $admin['password'])){
                        $data = [
                            'email' => $email,
                            'role_id' => $admin['role_id']
                        ];
                        $this->session->set_userdata($data);
                             redirect('admin');
                    } else {
                        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password!</div>');
                        redirect('auth');
                    }     
                } else {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated! </div>');
                    redirect('auth');
                }

            }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered!</div>');
                    redirect('auth');
            }

        }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
         $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">You have been logout!</div>');
            redirect('auth');
    }
    public function not_found(){
        $this->load->view('auth/blocked');
    }
    

}