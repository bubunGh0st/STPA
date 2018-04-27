<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0009"))) redirect('Blank');
        
        $this->load->model('SiteModel');
    }

	public function index()
	{
		if(isset($_POST["btnSubmitAdd"])){
			$transaction = true;

			if($transaction){
				
				$this->SiteModel->insertSite($_POST);
				redirect('Site');
			}
		}

		if(isset($_POST["btnSubmitEdit"])){
			$transaction = true;

			if($transaction){
				$this->SiteModel->updateSite($_POST);
				redirect('Site/index/?warning=2');
			}
		}

		if(isset($_POST["btnSubmitDelete"])){
			$transaction = true;
			if(!$this->SiteModel->isDeleteSite($_POST["SiteID"])){
				$transaction=false;
				redirect('Site/index/?warning=1');
			}
			if($transaction){
				$this->SiteModel->deleteSite($_POST["SiteID"]);
				redirect('Site');
			}
		}

		$data["getSites"]=$this->SiteModel->getSites();
		$this->load->view('templates/header');
		$this->load->view('site',$data);
		$this->load->view('templates/footer');
	}

	public function getSite()
	{
		header("Content-type: application/json");
        $getSite=$this->SiteModel->getSite($_POST["SiteID"]);
        $result["SiteName"] = $getSite->SiteName;
        $result["Address"] = $getSite->Address;
        $result["Contact"] = $getSite->Contact;

        echo(json_encode($result));
	}
}
