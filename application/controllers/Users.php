<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0004"))) redirect('Blank');
        $this->load->model('UsersModel');
        $this->load->model('SignUpModel');
        $this->load->model('RolesModel');
        $this->load->model('ForgetPasswordModel');

    }

	public function index()
	{
		if(isset($_POST["btnSubmitAdd"])){
			$transaction=true;

			if(!$this->SignUpModel->isSignUp($_POST)){
				redirect('Users/index/?warning=1');
				$transaction=false;
			}

			if($transaction){
				$newPassword = $this->ForgetPasswordModel->generateRandomString();
				$this->UsersModel->insertUser($_POST,$newPassword);
				$subject = "STPA Invitation";
				$messagex = "Greetings, You have been added to STPA system. Your new password is ".$newPassword.". Once you signed in, you will be redirected to change your password.";
				$this->ForgetPasswordModel->sendEmail($_POST["Email"],$messagex,$subject);
				redirect('Users/index/?warning=2');
			}
			
		}

		if(isset($_POST["btnSubmitEdit"])){
			$transaction=true;

			if($transaction){
				$this->UsersModel->updateUser($_POST,$newPassword);
				redirect('Users/index/?warning=3');
			}
			
		}

		if(isset($_POST["btnSubmitDel"])){
			$transaction = true;
			if(!$this->UsersModel->isDeleteUser($_POST["Email"])){
				$transaction=false;
				redirect('Users/index/?warning=4');
			}
			if($transaction){
				$this->UsersModel->deleteUser($_POST["Email"]);
				redirect('Users');
			}
		}

		$data["getUsers"]=$this->UsersModel->getUsers();
		$data["getSites"]=$this->SignUpModel->getSites();
		$data["getRoles"]=$this->RolesModel->getRoles();
		$this->load->view('templates/header');
		$this->load->view('users',$data);
		$this->load->view('templates/footer');
	}

	public function getUser()
	{
    	header("Content-type: application/json");
		//$_POST["Email"]="negiravita@gmail.com";
        $getUser=$this->UsersModel->getUser($_POST["Email"]);
        $getUserSite=$this->UsersModel->getUserSite($_POST["Email"]);

        $result["Email"]=$getUser->Email;
        $result["FName"]=$getUser->FName;
        $result["LName"]=$getUser->LName;
        $result["Title"]=$getUser->Title;
        $result["RoleID"]=$getUser->RoleID;
        $result["SiteID"]=array();
        foreach($getUserSite as $items){
        	$result["SiteID"][]=$items->SiteID;
        }

        //var_dump($result);

        echo(json_encode($result));
	}

}
