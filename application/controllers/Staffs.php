<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffs extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0007"))) redirect('Blank');

    }

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('staffs');
		$this->load->view('templates/footer');
	}

	public function detail($id = "")
	{
		$data["id"]=$id;
		$this->load->view('templates/header');
		$this->load->view('staffs_detail',$data);
		$this->load->view('templates/footer');
	}
}
