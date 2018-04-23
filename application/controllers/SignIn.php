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
				if($getProfile!=NULL){
	        		$this->session->set_userdata('Email', $getProfile->Email);
	        		$this->session->set_userdata('FName', $getProfile->FName);
	        		$this->session->set_userdata('LName', $getProfile->LName);
	        		$this->session->set_userdata('Title', $getProfile->Title);
	        		$this->session->set_userdata('RoleID', $getProfile->RoleID);
	        		$this->session->set_userdata('Status', $getProfile->Status);
		        }
				if($this->session->userdata['RoleID']=="SYS-ADMIN"){
					redirect('approval');
				}else if($this->session->userdata['RoleID']=="SITE-ADMIN"){
					redirect('courses');
				}else if($this->session->userdata['RoleID']=="STAFF"){
					redirect('dashboard_staff');
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
