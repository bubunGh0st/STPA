<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
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

		$data["getModules"]=$this->ModulesModel->getModules();
		$this->load->view('templates/header');
		$this->load->view('modules',$data);
		$this->load->view('templates/footer');
	}
}
