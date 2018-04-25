<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ForgetPassword extends CI_Controller {
	public function __construct() {	
		parent::__construct();	
		$this->load->model('ForgetPasswordModel');		
	}
	
	public function index()
	{
		if(isset($_POST["btnSubmit"])){
			$checkEmail = $this->ForgetPasswordModel->checkEmail($_POST);
			if($checkEmail == False){
				redirect('ForgetPassword/index/?warning=1');
			}
			else{
				$newPassword = $this->ForgetPasswordModel->generateRandomString();

				$this->ForgetPasswordModel->updatePassword($_POST["Email"],$newPassword);

				$subject = "STPA Reset Password";
				$messagex = "Your new password is ".$newPassword.". Once you signed in, you will be redirected to change your password.";
				$this->ForgetPasswordModel->sendEmail($_POST["Email"],$messagex,$subject);

				
				redirect('ForgetPassword/index/?warning=2');
			}
		}
		$this->load->view('templates/headerBlank');
		$this->load->view('forgetPassword');
	}
}