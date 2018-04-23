<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller {

	public function __construct() {	
		parent::__construct();	
		$this->load->model('SignUpModel');	
		$this->load->model('ForgetPasswordModel');	
	}

	public function index()
	{
		if(isset($_POST["btnSubmit"])){
			$isSignUp = $this->SignUpModel->isSignUp($_POST);
			if($isSignUp){
				$newPassword = "";
				$this->SignUpModel->insertUser($_POST,$newPassword);
				redirect('SignIn/index/?warning=4');
			}else{
				redirect('SignUp/index/?warning=1');
			}
			
		}

		$data["getSites"]=$this->SignUpModel->getSites();

		$this->load->view('templates/headerBlank');
		$this->load->view('signUp',$data);
	}
}
