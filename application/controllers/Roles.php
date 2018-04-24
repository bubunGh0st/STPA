<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0003"))) redirect('Blank');

        $this->load->model('RolesModel');
    }

	public function index()
	{
	
		if(isset($_POST["btnSubmit"])){
			$transaction = true;
			if(!$this->RolesModel->isInsertRole($_POST["RoleID"])){
				$transaction=false;
				redirect('Roles/index/?warning=1');
			}

			if($transaction){
				$this->RolesModel->insertRole($_POST);
				redirect('Roles');
			}
		}

		if(isset($_POST["btnSubmitDel"])){
			$transaction = true;
			if(!$this->RolesModel->isDeleteRole($_POST["RoleID"])){
				$transaction=false;
				redirect('Roles/index/?warning=2');
			}

			if($transaction){
				$this->RolesModel->deleteRole($_POST["RoleID"]);
				redirect('Roles');
			}
		}

		$data["getRoles"]=$this->RolesModel->getRoles();
		$this->load->view('templates/header');
		$this->load->view('roles',$data);
		$this->load->view('templates/footer');
	}

	public function detail($id = "")
	{
		$data["getRole"]=$this->RolesModel->getRole($id);
		if($data["getRole"]!=NULL){
			$data["getRoleModules"]=$this->RolesModel->getRoleModules($id);
			$data["getNotRoleModules"]=$this->RolesModel->getNotRoleModules($id);

			//edit role header
			if(isset($_POST["btnSubmit"])){
				$transaction = true;

				if($transaction){
					$_POST["RoleID"]=$data["getRole"]->RoleID;
					$this->RolesModel->updateRole($_POST);
					redirect('Roles/detail/'.$data["getRole"]->RoleID."?warning=1");
				}
			}

			//grant module to role
			if(isset($_POST["btnSubmitModule"])){
				$transaction = true;

				if($transaction){
					$_POST["RoleID"]=$data["getRole"]->RoleID;
					$this->RolesModel->grantModule($_POST);
					redirect('Roles/detail/'.$data["getRole"]->RoleID."?warning=2");
				}
			}

			//revoke module from role
			if(isset($_POST["btnSubmitModuleDel"])){
				$transaction = true;

				if($transaction){
					$_POST["RoleID"]=$data["getRole"]->RoleID;
					$this->RolesModel->revokeModule($_POST);
					redirect('Roles/detail/'.$data["getRole"]->RoleID."?warning=3");
				}
			}

			$this->load->view('templates/header');
			$this->load->view('roles_detail',$data);
			$this->load->view('templates/footer');
		}else{
			redirect('Roles');
		}
	}
}
