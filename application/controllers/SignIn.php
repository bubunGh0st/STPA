<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignIn extends CI_Controller {

	public function index()
	{
		if(isset($_POST["btnSubmit"])){
			 redirect('Blank');
		}

		$this->load->view('templates/headerBlank');
		$this->load->view('signIn');
	}
}
