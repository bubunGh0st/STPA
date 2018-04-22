<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata['email'] == FALSE)
        {
            redirect('Sign_out');
        } 

    }

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('dashboard');
		$this->load->view('templates/footer');
	}
}
