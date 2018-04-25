<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0005"))) redirect('Blank');
        $this->load->model('ApprovalModel');
		$this->load->model('ForgetPasswordModel');	
    }

	public function index()
	{
		if(isset($_POST["btnSubmitApprove"])){
			$transaction = true;

			if($transaction){
				$_POST["Password"] = $this->ForgetPasswordModel->generateRandomString();
				$this->ApprovalModel->approveUser($_POST);

				$subject = "STPA Invitation";
				$messagex = "Your registration as Site Admin is approved. Your new password is ".$_POST["Password"].". Once you signed in, you will be redirected to change your password.";
				$this->ForgetPasswordModel->sendEmail($_POST["Email"],$messagex,$subject);

				redirect('Approval/index/?warning=1');
			}
		}

		if(isset($_POST["btnSubmitReject"])){
			$transaction = true;

			if($transaction){
				$this->ApprovalModel->rejectUser($_POST);
				redirect('Approval/index/?warning=2');
			}
		}
		$data["getApprovalList"]=$this->ApprovalModel->getApprovalList();
		$this->load->view('templates/header');
		$this->load->view('approval',$data);
		$this->load->view('templates/footer');
	}

}
