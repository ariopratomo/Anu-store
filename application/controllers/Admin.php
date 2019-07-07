<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
    
        parent::__construct();
        $this->load->library('form_validation');
        // if(!$this->session->userdata('email')){
        //     redirect('auth');
        // }
        is_logged_in();


    }

    public function index(){
        $data['title'] = 'Dashboard';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        $data['user_count']= $this->db->count_all('user', FALSE);
        $data['p_count']= $this->db->count_all('products', FALSE);
        $data['t_count']= $this->db->count_all('orders');
        $data['pay_count']= $this->db->where('status','Proses')->count_all_results('orders');
        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/index');
        $this->load->view('admin/templates/footer');
        
    }
    public function admin_data(){
        $data['title'] = 'Dashboard';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        $data['admin_data'] = $this->db->query("SELECT * FROM `admin` JOIN `admin_role` ON `admin_role`.`id`=`admin`.`role_id`")->result_array();
        $data['adm']=$this->db->get('admin')->result_array();
        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/admin-data');
        $this->load->view('admin/templates/footer');
    }

    public function role()
    {
       is_logged_in();
        $data['title'] = 'Role';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();

        $data['role']=$this->db->get('admin_role')->result_array();
        
        $this->form_validation->set_rules('role','Role','required');
        if($this->form_validation->run()==false){
            $this->load->view('admin/templates/header',$data);
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/role');
            $this->load->view('admin/templates/footer');
        } else {
            $this->db->insert('admin_role',['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Menu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/role');
        }

    }

     public function roleAccess($role_id){
        
        is_logged_in();
        $data['title'] = 'Role Acess';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        $data['role']=$this->db->get_where('admin_role',['id'=>$role_id])->row_array();
        $this->db->where('id !=',1);
        $data['menu'] = $this->db->get('admin_menu')->result_array();
        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/role-access');
        $this->load->view('admin/templates/footer');
        
    }

    public function changeaccess()

    {
        is_logged_in();
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data =[
            'role_id'=> $role_id,
            'menu_id'=> $menu_id
        ];
        $access = $this->db->get_where('admin_access_menu',$data);
        if ($access->num_rows()<1) {
            $this->db->insert('admin_access_menu',$data);
        } else {
            $this->db->delete('admin_access_menu',$data);
        }
         $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function profile(){
         
        $data['title'] = 'Admin Profile';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name','Full Name','required|trim');
        if($this->form_validation->run()==false){
            $this->load->view('admin/templates/header',$data);
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/profile',$data);
            $this->load->view('admin/templates/footer');
        }
        else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // image check
            $upload_image = !empty($_FILES['image']['name']);
            if ($upload_image) {
                $config['upload_path'] = './include/assets/img/avatar/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']  = '2048';
                
                $this->load->library('upload', $config);
                
                if ( ! $this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else{
                    
                    $old_image = $data['admin']['image'];
                    if ($old_image!='default.png') {
                        unlink(FCPATH.'include/assets/img/avatar/'.$old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image',$new_image);
                    
                }
                
            }


            $this->db->set('name',$name);
            $this->db->where('email', $email);
            $this->db->update('admin');
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('admin/profile');
        }
        
    }

    public function changepassword(){
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();   
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|min_length[6]');
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('password');
        if (!password_verify($current_password,$data['admin']['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Wrong current password!</div> ');
            redirect('admin/profile');
        }else {
            if($current_password == $new_password){
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">New password cannot be same as  current password!</div> ');
            redirect('admin/profile');
            }else{
                $password_hash=password_hash($new_password,PASSWORD_DEFAULT);
                $this->db->set('password',$password_hash);
                $this->db->where('email',$this->session->userdata('email'));
                $this->db->update('admin');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Changed!</div> ');
                redirect('admin/profile');
            }
        }
        
        
    }

    public function addadmin(){
        $data['title'] = 'Add Admin';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        
        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/addadmin');
        $this->load->view('admin/templates/footer');
        if($this->input->post('add')=='add'){
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
            $role = $this->input->post('role');
            $data=['name'=>$name,
                    'email'=>$email,
                    'password'=>$password,
                    'role_id'=>$role,
                    'username'=>'null',
                    'image' => 'default.png',
                    'is_active'=>1,
                    'date_created'=>time()
                    ];
            $this->db->insert('admin', $data);
            redirect(base_url('admin/admin_data'));
            
        }
        
    }
    public function actived($id){
        $this->db->where('id_admin',$id);
        
        $active =$this->db->update('admin',['is_active'=>1]);
        if ($active) {
           redirect('admin/admin_data','refresh');
        }
        else {
            echo "<script>alert('Gagal')</script>";
        }

    }
    public function notactive($id){
        $this->db->where('id_admin',$id);
        
        $active =$this->db->update('admin',['is_active'=>0]);
        if ($active) {
           redirect('admin/admin_data','refresh');
        }
        else {
            echo "<script>alert('Gagal')</script>";
        }

    } 
    public function user_data(){
        $data['title'] = 'Dashboard';
        $data['admin'] = $this->db->get_where('admin',['email' => 
        $this->session->userdata('email')])->row_array();
        $data['user_data'] = $this->db->order_by('fullname','ASC')->get('user')->result_array();
        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/user-data');
        $this->load->view('admin/templates/footer');
    }

    public function uactived($id){
        $this->db->where('id_user',$id);
        
        $active =$this->db->update('user',['is_active'=>1]);
        if ($active) {
           redirect('admin/user_data','refresh');
        }
        else {
            echo "<script>alert('Gagal')</script>";
        }

    }
    public function unotactive($id){
        $this->db->where('id_user',$id);
        
        $active =$this->db->update('user',['is_active'=>0]);
        if ($active) {
           redirect('admin/user_data','refresh');
        }
        else {
            echo "<script>alert('Gagal')</script>";
            
        }

    } 
    

// Product Gagal

//    public function product(){

//         $this->load->model('Product_model','product');
//         $data['title'] = 'Product';
//         $data['admin'] = $this->db->get_where('admin',['email' => 
//                          $this->session->userdata('email')])->row_array();
      
//         $data['product'] = $this->product->getProduct();

//         $this->load->view('admin/templates/header',$data);
//         $this->load->view('admin/templates/navbar');
//         $this->load->view('admin/templates/sidebar');
//         $this->load->view('product/index',$data);
//         $this->load->view('admin/templates/footer');
        
//     }

    // Gagagl

//     public function newproduct(){

//         $this->load->model('Product_model','product');
//         $data['title'] = 'Category';
//         $data['admin'] = $this->db->get_where('admin',['email' => 
//                          $this->session->userdata('email')])->row_array();

//         $this->form_validation->set_rules('product','Product Name','required');
//         $this->form_validation->set_rules('stock','Stock','required');
//         $this->form_validation->set_rules('category','Category','required');
//         $this->form_validation->set_rules('subcategory','Subcategory','required');
//         $this->form_validation->set_rules('price','Price','required');
//         $this->form_validation->set_rules('discount','Discount','required');
//         $this->form_validation->set_rules('price_total','Price Total','required');
//         $this->form_validation->set_rules('description','Description','required');

//         $data['category'] = $this->product->getCategory();
//         $data['subcategory']=$this->product->getsubcat();

//         if($this->form_validation->run()==false){
            
//             $this->load->view('admin/templates/header',$data);
//             $this->load->view('admin/templates/navbar');
//             $this->load->view('admin/templates/sidebar');
//             $this->load->view('product/new_product',$data);
//             $this->load->view('admin/templates/footer');
//         }
//         else{
//             $data = [
//                 'category_id' => $this->input->post('category'),
//                 'subcategory_id' => $this->input->post('subcategory'),
//                 'product' => $this->input->post('product'),
//                 'description' => $this->input->post('description'),
//                 'price' => $this->input->post('price'),
//                 'discount' => $this->input->post('discount'),
//                 'price_total' => $this->input->post('price_total'),
//                 'stock' => $this->input->post('stock'),
//                 'dateinput' => time()
//             ];

//             $upload_image = !empty($_FILES['image']['name']);

//             if ($upload_image) {
//                 $config['upload_path'] = './include/assets/img/products/';
//                 $config['allowed_types'] = 'gif|jpg|png';
//                 $config['file_name'] = $this->input->post('category')."_".time('Y');
//                 $config['overwrite'] = true;
//                 $config['max_size']  = '2048';        
//                 $this->load->library('upload', $config);
//                 if ( ! $this->upload->do_upload('image')){
//                     $error = array('error' => $this->upload->display_errors());
//                 }
//                 else{
//                     $image = $this->upload->data('file_name');
//                     $this->db->set('image',$image);
//                 }
                
//             }
//             $this->db->insert('product', $data);
//             $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Product Successfully Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
//             redirect('admin/product');
//         }
//     }
//     // Jquery subcategory
//     public function fetch_subcat(){

//         $this->load->model('Product_model','product');
//         if($this->input->post('category_Id'))

//         {
//             echo $this->product->fetch_subcat($this->input->post('category_Id')); 
//         }
//     }

//     public function delProduct($id){
//         $this->load->model('Product_model','product');

//         $this->db->where('id_product',$id);
//         $query = $this->db->get('product');
//         $row = $query->row();
//         if (!empty($row->image)) {
//              unlink("./include/assets/img/products/$row->image");
//         }
//             $this->product->delprod($id);
//             $this->session->set_flashdata('message','<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
//             redirect('admin/product');
//     }

// // Category 

//     public function category(){

//         $this->load->model('Product_model','product');
//         $data['title'] = 'Category';
//         $data['admin'] = $this->db->get_where('admin',['email' => 
//         $this->session->userdata('email')])->row_array();
//         $this->form_validation->set_rules('category','Category','required');
//         $data['category'] = $this->product->getCategory();
//         if($this->form_validation->run()==false){
            
//             $this->load->view('admin/templates/header',$data);
//             $this->load->view('admin/templates/navbar');
//             $this->load->view('admin/templates/sidebar');
//             $this->load->view('product/category',$data);
//             $this->load->view('admin/templates/footer');
//         }
//         else{
//             $this->db->insert('category',['category' => $this->input->post('category')]);
//             $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New Menu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
//             redirect('admin/category');
//         }
//     }

//     public function deleteCat($id){
//         $this->load->model('Product_model','product');
//             $this->product->deleteCategory($id);
//             $this->session->set_flashdata('message','<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
//             redirect('admin/category');
//     }

//     public function updatecat($c_id){
//         $this->load->model('Product_model','product');
//         $this->product->updateCat($c_id);
//         $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Update Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
//         redirect('admin/category');
//     }

//     // Subcategory

//     public function subcategory()
//         {
//         $this->load->model('Product_model','product');
//         $data['title'] = 'Subcategory';
//         $data['admin'] = $this->db->get_where('admin',['email' => 
//         $this->session->userdata('email')])->row_array();
//         $data['category'] = $this->db->get('category')->result_array();
//         $data['subcategory']=$this->product->getsubcat();

//         $this->form_validation->set_rules('subcategory','Subcategory','required');
//         $this->form_validation->set_rules('category_id','Category','required');
        

//         if($this->form_validation->run()==false){
//             $this->load->view('admin/templates/header',$data);
//             $this->load->view('admin/templates/navbar');
//             $this->load->view('admin/templates/sidebar');
//             $this->load->view('product/subcategory',$data);
//             $this->load->view('admin/templates/footer');
//         } else{
//             $data = [
//                 'subcategory' => $this->input->post('subcategory'),
//                 'category_id' => $this->input->post('category_id')
                
//             ];
//             $this->db->insert('sub_category', $data);
//             $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">New SubMenu Added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
//         redirect('admin/subcategory');
            
//         } 
//     }

//     public function deletesubCat($id_sc){
//             $this->load->model('Product_model','product');
//             $this->product->deletesubCat($id_sc);
//             $this->session->set_flashdata('message','<div class="alert alert-info text-center alert-dismissible fade show" role="alert">Deleted Succesfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
//             redirect('admin/subcategory');
//     }

//     public function updatesubcat($id_sc){
//         $this->load->model('Product_model','product');
//         $this->product->updatesubCat($id_sc);
//         $this->session->set_flashdata('message','<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Update Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
//         redirect('admin/subcategory');
//     }

    

    
}