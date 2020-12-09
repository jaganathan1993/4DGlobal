<?php  
 class Client_model extends CI_Model  
 {  

	public function add_client_data($client){
		$this->db->insert_batch('client',$client);  
        $this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Client Added Successfully!');
        redirect('client/add_client');
	}

	public function client_data(){
		$dep = $this->db->query("SELECT * FROM client ORDER BY client asc");
		return $dep->result();
	}

 }  

 ?>