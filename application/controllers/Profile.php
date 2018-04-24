<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller { 

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        
        $this->load->model('ProfileModel');
        $this->load->model('ForgetPasswordModel');
    }

	public function index()
	{
		if(isset($_POST["btnSubmit"])){
			$transaction=true;

			$_POST["Email"]=$this->session->userdata['Email'];
			if(empty($_POST["FName"])){
				$transaction=false;
				redirect('Profile/index/?warning=1');
			}

			if($transaction){
				$this->ProfileModel->updateProfile($_POST);
				redirect('Profile/index/?warning=2');
			}
		}

		if(isset($_POST["btnSubmitPass"])){
			$transaction=true;

			$_POST["Email"]=$this->session->userdata['Email'];
			if(md5($_POST["currentPassword"])!=$this->session->userdata['Password']){
				$transaction=false;
				redirect('Profile/index/?warning=3');
			}if($_POST["newPassword"]!=$_POST['confirmPassword']){
				$transaction=false;
				redirect('Profile/index/?warning=4');
			}

			if($transaction){
				$this->ForgetPasswordModel->updatePassword($_POST["Email"],$_POST["newPassword"],"ACTIVE");
				redirect('SignOut/index/5');
			}
		}

		$this->load->view('templates/header');
		$this->load->view('profile');
		$this->load->view('templates/footer');
	}
} 