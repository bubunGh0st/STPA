<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_staff extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0008"))) redirect('Blank');
        $this->load->model('Dashboard_staffModel');

    }

	public function index()
	{
		if(isset($_POST["btnSubmit"])){
			$transaction = true;

			if($transaction){
				if(isset($_POST["TrimesterID"])){
					$_POST["Email"]=$this->session->userdata['Email'];
					$this->Dashboard_staffModel->assignCourse($_POST);
					redirect('Dashboard_staff');
				}else{
					redirect('Dashboard_staff/index/?warning=1');

				}
				
			}
		}

		$data["getStaffCourses"]=$this->Dashboard_staffModel->getStaffCourses($this->session->userdata['Email']);
		$data["getStaffNotCourses"]=$this->Dashboard_staffModel->getStaffNotCourses($this->session->userdata['Email']);
		$this->load->view('templates/header');
		$this->load->view('dashboard_staff',$data);
		$this->load->view('templates/footer');
	}

	public function detail($id = "")
	{
		$data["getTrimester"]=$this->Dashboard_staffModel->getTrimester($id);
		if($data["getTrimester"]!=NULL){

			if(isset($_POST["btnSubmitAddAssignment"])){
				$transaction = true;

				if(date("Ymd",strtotime($_POST["FinishTime"]))>=date("Ymd",strtotime($data["getTrimester"]->FinishDate))){
					
					redirect('Dashboard_staff/detail/'.$data["getTrimester"]->TrimesterID."?warning=1");
					$transaction=false;
				}

				if($transaction){
					$_POST["TrimesterID"]=$data["getTrimester"]->TrimesterID;
					$this->Dashboard_staffModel->insertAssignment($_POST);
					redirect('Dashboard_staff/detail/'.$data["getTrimester"]->TrimesterID."?warning=2");
				}
			}

			$data["getEditTrimester"]=$this->Dashboard_staffModel->getEditTrimester($id);
			$data["getTrimesterStaff"]=$this->Dashboard_staffModel->getTrimesterStaff($id);
			$data["getTrimesterAssignment"]=$this->Dashboard_staffModel->getTrimesterAssignment($id);
			$data["getTotalAssignmentHours"]=$this->Dashboard_staffModel->getTotalAssignmentHours($id);
			$this->load->view('templates/header');
			$this->load->view('courses_detail_staff',$data);
			$this->load->view('templates/footer');
		}else{
			redirect('Dashboard_staff');
		}
	}

	public function deleteAssignment($id = "")
	{
		$TrimesterID=$this->Dashboard_staffModel->getTrimesterByAssignment($id)->TrimesterID;
		$this->Dashboard_staffModel->deleteAssignment($id);
		redirect('Dashboard_staff/detail/'.$TrimesterID."?warning=3");
	}
}
