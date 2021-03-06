<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignIn extends CI_Controller {

	public function index()
	{
		if(isset($_POST["btnSubmit"])){
			$isSignIn = $this->SignInModel->isSignIn($_POST);
			//if 1 then successful
			if($isSignIn == 1){
        		$this->session->set_userdata('Email', $_POST["Email"]);
				$getProfile = $this->SignInModel->getProfile($this->session->userdata['Email']);
				if($getProfile->Status=="ACTIVE-RESET"){
				redirect('profile/index/?warning=5');
				}else{
					if($getProfile->RoleID=="SYS-ADMIN"){
						redirect('approval');
					}else if($getProfile->RoleID=="SITE-ADMIN"){
						redirect('courses');
					}else if($getProfile->RoleID=="STAFF"){
						redirect('dashboard_staff');
					}
				}
			}
			//if 2 then the email is invalid
			else if($isSignIn == 2){
				redirect('SignIn/index/?warning=2');
			}
			//if 3 then the password is invalid
			else if($isSignIn == 3){
				redirect('SignIn/index/?warning=3');
			}
		}

		$this->load->view('templates/headerBlank');
		$this->load->view('signIn');
	}
}
