<?php

class Hello extends CI_Controller{
	
	public function get_message(){
		$this->load->model("Result");
		$message = $this->Result->get_result();
		echo $message;
	}
}