<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignOut extends CI_Controller {

	public function index()
	{
		$this->session->unset_userdata('email');
		redirect('SignIn');
	}
}
