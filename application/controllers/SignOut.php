<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignOut extends CI_Controller {

	public function index($warning = '')
	{
		$this->session->unset_userdata('Email');
		if($warning == ""){
			redirect('SignIn');
		}else{
			redirect('SignIn/index/?warning='.$warning);
		}

	}
}
