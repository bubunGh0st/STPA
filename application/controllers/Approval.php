<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0005"))) redirect('Blank');

    }

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('approval');
		$this->load->view('templates/footer');
	}

}
