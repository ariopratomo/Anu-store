<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Chekout extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model', 'products');
		$this->load->model('Home_model', 'homp');
		$this->load->model('Anu_model', 'anu');
		$this->load->model('Cart_model', 'cart');
    }
    

    public function index()
    {
      
      $data['user'] = $this->db->get_where('user',['email'=> 
              $this->session->userdata('email')])->row_array();
      $email_tmp = $this->session->userdata('email');
      $idu = $this->cart->idu($email_tmp);
      $data['tprice'] = $this->cart->tprice($idu);
      $data['tweight'] = $this->cart->tweight($idu);
      $tsprice = $this->cart->tsprice($idu);
      
      // $data['product'] = $this->products->getProducts();
      $data['keranjang'] = $this->cart->getcart($idu);
          if ($data['user'] && $tsprice>0 ) {
              $this->load->view('home/templates/header', $data);
              $this->load->view('home/templates/navbar');
              $this->load->view('home/chekout');
              $this->load->view('home/templates/footer');
              $date= date("Y-m-d");
              $id_order =$idu.time();
              $service = explode(",",$this->input->post('layanan', TRUE));
              $dest = explode(",",$this->input->post('kota', TRUE));
              $total = $this->input->post('total', TRUE);
              $receiver = $this->input->post('receiver', TRUE);
              $tlp = $this->input->post('tlp', TRUE);
              $kurir= $this->input->post('kurir', TRUE);
              $saddress= $this->input->post('saddress', TRUE);
              $shipping_c= $this->input->post('ongkir', TRUE);
              $id_cart=$this->cart->getcart1($idu);
              $idorders=$this->cart->getid_order($idu);
            
              
              if ($this->input->post('bayar')=='Bayar' ) {
                $data=[
                    'total' => $total,
                    'receiver' => $receiver,
                    'tlp' => $tlp,
                    'kurir'=> $kurir,
                    's_address'=> $saddress,
                      'dest'=>$dest[1],
                      'service'=>$service[1],
                    'status' => 'Menunggu Pembayaran',
                    'date' => $date,
                    'shipping_c'=>$shipping_c,
                    'id_order'=>$id_order,
                    'id_user' => $idu,
                    'c_total' => $data['tprice'],
                    'resi' => ''
                  ];
                  if ($this->db->insert('orders',$data)) {
                      // $idcart = count($_POST["id_cart"]);
                      // $idp =  count($_POST["id_product"]);
                      // for($i=0;$i<$idcart;$i++) {
                      //   for($l=0;$l<$idp;$l++){
                      //     $ewew =$this->db->query( "INSERT order_details set id_cart='" . $_POST["id_cart"][$i] . "', id_product='" . $_POST["id_product"][$i] . "'" );
                          
                      //   }
                            
                      //       }
                      foreach ($id_cart as $cart) {
                          $data = array(
                              // 'id_cart' => $cart['id_cart'],
                              'id_product' => $cart['id_product'],
                              'qty' => $cart['qty'],
                              'note' => $cart['note'],
                              'o_weight' => $cart['c_weight'],
                              'c_price' => $cart['c_price'],
                              'id_orders' => $id_order
                            );
                        $od=$this->db->insert('order_detail',$data);
                      }
                      
                      if($od){
                        // $usersCount = count($_POST["status_tmp"]);
                        // for($i=0;$i<$usersCount;$i++) {
                        //   echo  $_POST["status_tmp"][$i];
                        // // mysqli_query($conn, "UPDATE users set userName='" . $_POST["userName"][$i] . "' WHERE userId='" . $_POST["userId"][$i] . "'");
                        // }
                        $anu = $this->cart->anu();
                        if($anu){
                        
                          redirect('history_order');
                        }
                      }
                      
                  }
              }

          }
          elseif($data['user']  && $tsprice<1 ){
            
            redirect('keranjang ');
          }
          
          else{
              $this->session->set_flashdata('message','Anda Belum Login');
              redirect('/');
          }

        // $idcart = count($_POST["id_cart"]);
        // for($i=0;$i<$idcart;$i++) {
        //     echo  $_POST["id_cart"][$i] ;
        //     $this->db->query( "INSERT order_detail set id_cart='" . $_POST["id_cart"][$i] . "'" );
        //     }

    }

    public function city()
   {
      $prov = $this->input->post('prov', TRUE);

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$prov",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "key:  8176d64a24340a53e06006a71172e699"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
         $data = json_decode($response, TRUE);

         echo '<option value="" selected disabled>Kota / Kabupaten</option>';

         for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
            echo '<option value="'.$data['rajaongkir']['results'][$i]['city_id'].','.$data['rajaongkir']['results'][$i]['postal_code'].'">'.$data['rajaongkir']['results'][$i]['city_name'].'</option>';
         }
      }
   }
   public function getcost()
	{
		$asal = 151;
		$dest = $this->input->post('dest', TRUE);
        $kurir = $this->input->post('kurir', TRUE);
        $email_tmp = $this->session->userdata('email');
        $idu = $this->cart->idu($email_tmp);
        $berat = $this->cart->tweight($idu);
        if($berat<0){
            $berat1 = 0;
        }
        elseif($berat>0){
            $berat1 = $berat;
        }
        

		// foreach ($this->cart->contents() as $key) {
		// 	$berat += ($key['weight'] * $key['qty']);
		// }

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$asal&destination=$dest&weight=$berat&courier=$kurir",
          
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key:  8176d64a24340a53e06006a71172e699"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $data = json_decode($response, TRUE);

		  echo '<option value="" selected disabled>Layanan yang tersedia</option>';

		  for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {

				for ($l=0; $l < count($data['rajaongkir']['results'][$i]['costs']); $l++) {

					echo '<option value="'.$data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'].','.$data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')">';
					echo $data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')</option>';

				}

		  }
		}
	}

	public function cost()
	{
		$biaya = explode(',', $this->input->post('layanan', TRUE));
		$total = $this->input->post('tprice') + $biaya[0];

		echo $biaya[0].','.$total;
	}

}


/* End of file Chekout.php */