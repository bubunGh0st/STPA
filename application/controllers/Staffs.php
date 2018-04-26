<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffs extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0007"))) redirect('Blank');

        $this->load->model('StaffsModel');
        $this->load->model('ForgetPasswordModel');
        $this->load->model('CoursesModel');
		$this->load->model('SignUpModel');	
		$this->load->model('UsersModel');	

    }

	public function index()
	{
		if(isset($_POST["btnSubmitAdd"])){
			$transaction = true;
			

			$isSignUp = $this->SignUpModel->isSignUp($_POST);
			if(!$isSignUp){
				$transaction = false;
				redirect('Staffs/index/?warning=1');
			}
			if($transaction){
				$newPassword = $this->ForgetPasswordModel->generateRandomString();
				$this->StaffsModel->insertStaff($_POST,$newPassword);

				$subject = "STPA Invitation";
				$messagex = "Greetings, You have been added to STPA system. Your new password is ".$newPassword.". Once you signed in, you will be redirected to change your password.";
				$this->ForgetPasswordModel->sendEmail($_POST["Email"],$messagex,$subject);

				redirect('Staffs/index/?warning=2');
			}
		}

		if(isset($_POST["btnSubmitDel"])){
			$transaction = true;
			if(!$this->UsersModel->isDeleteUser($_POST["Email"])){
				$transaction=false;
				redirect('Staffs/index/?warning=3');
			}
			if($transaction){
				$this->UsersModel->deleteUser($_POST["Email"]);
				redirect('Staffs');
			}
		}

		$data["getStaffs"]=$this->StaffsModel->getStaffs($this->session->userdata['Email']);
		$data["getUserSite"]=$this->CoursesModel->getUserSite($this->session->userdata['Email']);
		$this->load->view('templates/header');
		$this->load->view('staffs',$data);
		$this->load->view('templates/footer');
	}

	public function detail($id = "")
	{
		$data["getStaff"]=$this->StaffsModel->getStaff($id);
		if($data["getStaff"]!=NULL){

			//edit role header
			if(isset($_POST["btnSubmit"])){
				$transaction = true;

				if($transaction){
					$_POST["Email"]=$data["getStaff"]->Email;
					$this->StaffsModel->updateStaff($_POST);
					redirect('Staffs/detail/'.md5($data["getStaff"]->Email)."?warning=1");
				}
			}

			$data["getUserSite"]=$this->CoursesModel->getUserSite($this->session->userdata['Email']);
			$this->load->view('templates/header');
			$this->load->view('staffs_detail',$data);
			$this->load->view('templates/footer');
		}else{
			redirect('Staffs');
		}
	}
}
