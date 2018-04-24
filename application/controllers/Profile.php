<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller { 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('ProfileModel');
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

		$this->load->view('templates/header');
		$this->load->view('profile');
		$this->load->view('templates/footer');
	}
} 