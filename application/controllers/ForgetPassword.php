<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ForgetPassword extends CI_Controller {
	public function __construct() {	
		parent::__construct();	
		$this->load->model('ForgetPasswordModel');		
	}
	
	public function index()
	{
		if(isset($_POST["btnSubmit"])){
			$checkEmail = $this->ForgetPasswordModel->checkEmail($_POST);
			if($checkEmail == False){
				redirect('ForgetPassword/index/?warning=1');
			}
			else{
				$newPassword = $this->ForgetPasswordModel->generateRandomString();

				$this->ForgetPasswordModel->updatePassword($_POST["Email"],$newPassword);

				require_once 'vendor/autoload.php';
				// Create the Transport
				$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl'))
				  ->setUsername('stp.weltec@gmail.com')
				  ->setPassword('chinki1990')
				;
				// Create the Mailer using your created Transport
				$mailer = new Swift_Mailer($transport);
				// Create a message
				$message = (new Swift_Message('STPA Password Reset'))
				  ->setFrom(['stp.weltec@noreply.com' => 'STPA'])
				  ->setTo([$_POST["Email"]])
				  ->setBody("Your new password is ".$newPassword.". Once you signed in, you will be redirected to change your password.");
				// Send the message
				$result = $mailer->send($message);
				redirect('ForgetPassword/index/?warning=2');
			}
		}
		$this->load->view('templates/headerBlank');
		$this->load->view('forgetPassword');
	}
}