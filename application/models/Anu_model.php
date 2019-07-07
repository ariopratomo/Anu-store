<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anu_model extends CI_Model {

	
    // Test
    function provinsi(){
		$this->db->order_by('province','ASC');
		$provinces= $this->db->get('provinces');
			
		return $provinces->result_array();
	}

	
	function kabupaten($provId){

		$kabupaten="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('regency','ASC');
		$kab= $this->db->get_where('regencies',array('province_id'=>$provId));

		foreach ($kab->result_array() as $data ){
			$kabupaten.= "<option value='$data[id]'>$data[regency]</option>";
		}

		return $kabupaten;

	}

	function kecamatan($kabId){
		$kecamatan="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('district','ASC');
		$kec= $this->db->get_where('districts',array('regency_id'=>$kabId));

		foreach ($kec->result_array() as $data ){
			$kecamatan.= "<option value='$data[id]'>$data[district]</option>";
		}

		return $kecamatan;
	}

	function kelurahan($kecId){
		$kelurahan="<option value='0'>--pilih--</pilih>";

		$this->db->order_by('village','ASC');
		$kel= $this->db->get_where('villages',array('district_id'=>$kecId));

		foreach ($kel->result_array() as $data ){
			$kelurahan.= "<option value='$data[id]'>$data[village]</option>";
		}

		return $kelurahan;
	}

}

/* End of file Anu_model.php */
/* Location: ./application/models/Anu_model.php */