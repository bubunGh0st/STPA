<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgetPassword extends CI_Controller {

	
	public function index()
	{
		if(isset($_POST["btnSubmit"])){
			$checkEmail = $this->ForgetPasswordModel->checkEmail($_POST);

			if($checkEmail == False){
				redirect('ForgetPassword/index/?warning=1');
			}
			else{
				
			}
		}
		$this->load->view('templates/headerBlank');
		$this->load->view('forgetPassword');
	}
}
