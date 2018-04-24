<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
    }

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('blank');
		$this->load->view('templates/footer');
	}
}
