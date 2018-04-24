<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0004"))) redirect('Blank');

    }

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('users');
		$this->load->view('templates/footer');
	}

}
