<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_staff extends CI_Controller {

	
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('dashboard_staff');
		$this->load->view('templates/footer');
	}
}
