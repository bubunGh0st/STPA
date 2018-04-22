<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->session->set_userdata('email', 'scaventum@gmail.com');

        if ($this->SignInModel->isSession() == FALSE)
        {
            redirect('SignOut');
        } 
    }

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('blank');
		$this->load->view('templates/footer');
	}
}
