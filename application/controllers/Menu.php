<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    
    public function __construct(){
    
        parent::__construct();
        $this->load->model('Menu_model','menu');
        is_logged_in();

    }

    public function index(){
        $data['title'] = 'Menu Management';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('admin_menu')->result_array();

        $this->form_validation->set_rules('menu','Menu','required');
        if($this->form_validation->run()==false){
            $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/templates/sidebar');
        $this->load->view('menu/index');
        $this->load->view('admin/templates/footer');
        }
        else{
            $this->db->insert('admin_menu',['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Menu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
            redirect('menu');
        }

    }

    public function delete($id){
    
        $this->menu->deleteMenu($id);
        $this->session->set_flashdata('message','<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
        redirect('menu');
    }
    
    public function update($m_id){
    
        $this->menu->updateMenu($m_id);
        $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Update Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
        redirect('menu');
    }

    public function submenu(){
    
        $data['title'] = 'Submenu Management';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        
        $data['subMenu']=$this->menu->getsm();
        $data['menu'] = $this->db->get('admin_menu')->result_array();

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('menu_id','Menu','required');
        // $this->form_validation->set_rules('url','Url','required');
        $this->form_validation->set_rules('icon','Menu','required');

        if($this->form_validation->run()==false){
        
            $this->load->view('admin/templates/header',$data);
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/templates/sidebar');
            $this->load->view('menu/submenu');
            $this->load->view('admin/templates/footer');
        } else {
            $data = ['title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')

        ];
         $this->db->insert('admin_sub_menu',$data);
            $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New SubMenu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
            redirect('menu/submenu');
        }
       
    }
    public function deletesm($id){
    
        $this->menu->deletesm($id);
        $this->session->set_flashdata('message','<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/submenu');
    }
    public function updatesm($sm_id){
        $this->menu->updatesm($sm_id);
        $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Update Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/submenu');
    }
    public function subsubmenu(){
    
        $data['title'] = 'Subsubmenu Management';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        $data['subMenu']=$this->menu->getsm();
        $data['subsubMenu']=$this->menu->getssm();
       

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('submenu_id','Menu','required');
        $this->form_validation->set_rules('url','Url','required');
        $this->form_validation->set_rules('icon','Menu','required');

        if($this->form_validation->run()==false){
        
            $this->load->view('admin/templates/header',$data);
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/templates/sidebar');
            $this->load->view('menu/subsubmenu');
            $this->load->view('admin/templates/footer');
        } else {
            $data = ['menu_title' => $this->input->post('title'),
            'submenu_id' => $this->input->post('submenu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')

        ];
         $this->db->insert('admin_sub_submenu',$data);
            $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New SubMenu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
            redirect('menu/subsubmenu');
        }
       
    }
    public function deletessm($id){
    
        $this->menu->deletessm($id);
        $this->session->set_flashdata('message','<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/subsubmenu');
    }
    public function updatessm($ssm_id){
        $this->menu->updatessm($ssm_id);
        $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Update Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/subsubmenu');
    }

}