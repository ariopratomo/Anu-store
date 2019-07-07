<?php
function is_logged_in(){
    $anu = get_instance();
    if(!$anu->session->userdata('email')){
        redirect('real_life/404');
    } else {
        $role_id = $anu->session->userdata('role_id');
        $menu =$anu->uri->segment(1);

        $queryMenu = $anu->db->get_where('admin_menu',['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $anu->db->get_where('admin_access_menu',[
            'role_id'=>$role_id,
            'menu_id'=>$menu_id]);

            if($userAccess->num_rows() < 1 ){
                redirect(base_url('real_life/404'));
            }
    }
}
// function id_user(){
//     $anu = get_instance();
//     $id_user = $anu->session->userdata('id_user');
//     if( $id_user ) {
//        return TRUE;
//     }
//     return FALSE; 
// }

function check_access($role_id,$menu_id)
{
    $anu = get_instance();

    $anu->db->where('role_id', $role_id);
    $anu->db->where('menu_id', $menu_id);

    $result=$anu->db->get('admin_access_menu');
    if ($result->num_rows() > 0) {
        return"checked='checked'";
    }
}




function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.').",-";
    return $hasil_rupiah;

}
function tgl_indo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 2, 2);               
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
    $result = $tgl . "-" . $BulanIndo[(int)$bulan-1]. "-". $tahun;
    return($result);
}

function codeprod(){
    $anu = get_instance();
              $anu->db->select('RIGHT(products.code_products,4) as kode', FALSE);
          $anu->db->order_by('code_products','DESC');    
          $anu->db->limit(1);    
          $query = $anu->db->get('products');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = $kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;   
         }