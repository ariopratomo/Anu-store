<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu_model extends CI_Model {
    public function deleteMenu($id){
        $this->db->where('id',$id);
        $this->db->delete('admin_menu');
    }
    public function updateMenu($m_id){
        $data = ['menu' => $this->input->post('menu')];
            $this->db->where('id', $m_id);
            $this->db->update('admin_menu', $data);
    }

    // Submenu
    public function getsm()
    {
        $query = " SELECT `admin_sub_menu`.*, `admin_menu`.`menu`
                    FROM `admin_sub_menu` JOIN `admin_menu`
                    ON `admin_sub_menu`.`menu_id` = `admin_menu`.`id`
        ";

        return $this->db->query($query)->result_array();
    }
    
    public function deletesm($id){
        $this->db->where('id',$id);
        $this->db->delete('admin_sub_menu');
    }




    public function updatesm($sm_id){
    $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->where('id', $sm_id);
            $this->db->update('admin_sub_menu', $data);
    }


    // ssm

    public function getssm()
    {
        $query = " SELECT `admin_sub_submenu`.*, `admin_sub_menu`.`title`,`admin_menu`.`menu`
                    FROM `admin_sub_submenu` JOIN `admin_sub_menu`
                    ON `admin_sub_submenu`.`submenu_id` = `admin_sub_menu`.`id`
                     JOIN `admin_menu`
                    ON `admin_sub_menu`.`menu_id` = `admin_menu`.`id`
        ";

        return $this->db->query($query)->result_array();
    }
    public function deletessm($id){
        $this->db->where('id',$id);
        $this->db->delete('admin_sub_submenu');
    }
    public function updatessm($ssm_id){
    $data = [
                'menu_title' => $this->input->post('title'),
                'submenu_id' => $this->input->post('submenu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->where('id', $ssm_id);
            $this->db->update('admin_sub_submenu', $data);
    }
}