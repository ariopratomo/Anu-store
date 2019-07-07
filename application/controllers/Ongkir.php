 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ongkir extends CI_Controller {
private $api_key= '8176d64a24340a53e06006a71172e699';
	public function index()
	{
		

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: $this->api_key"
		  ),
		));


		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}

			}
			public function tampil()
			{
				$index = $this->index();
				echo '<pre>';
				echo $index;
				echo '</pre>';
			}

}

/* End of file Ongkir.php */
/* Location: ./application/controllers/Ongkir.php */ ?>