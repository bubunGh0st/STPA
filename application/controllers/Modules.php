<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        
        $this->load->model('ModulesModel');
    }

	public function index()
	{
		if(isset($_POST["btnSubmitAdd"])){
			$transaction = true;

			if($transaction){
				$_POST["ModuleID"]=$this->ModulesModel->autogenerateID();
				$this->ModulesModel->insertModule($_POST);
				redirect('Modules');
			}
		}

		if(isset($_POST["btnSubmitEdit"])){
			$transaction = true;

			if($transaction){
				$this->ModulesModel->updateModule($_POST);
				redirect('Modules/index/?warning=2');
			}
		}

		if(isset($_POST["btnSubmitDelete"])){
			$transaction = true;
			if(!$this->ModulesModel->isDeleteModule($_POST["ModuleID"])){
				$transaction=false;
				redirect('Modules/index/?warning=1');
			}
			if($transaction){
				$this->ModulesModel->deleteModule($_POST["ModuleID"]);
				redirect('Modules');
			}
		}

		$data["getModules"]=$this->ModulesModel->getModules();
		$this->load->view('templates/header');
		$this->load->view('modules',$data);
		$this->load->view('templates/footer');
	}

	public function getModule()
	{
        $data["getModule"]=$this->ModulesModel->getModule($_POST["ModuleID"]);
        echo($data["getModule"]->ModuleName);
	}
}
