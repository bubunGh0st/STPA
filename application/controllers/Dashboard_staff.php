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
		//assigning course to staff
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

		//removing course from staff
		if(isset($_POST["btnSubmitDel"])){
			$transaction = true;

			if($transaction){
				$_POST["Email"]=$this->session->userdata['Email'];
				$this->Dashboard_staffModel->removeCourse($_POST);
				redirect('Dashboard_staff');
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
				if(date("Ymd",strtotime($_POST["FinishTime"]))<date("Ymd",strtotime($data["getTrimester"]->StartDate))){
					
					redirect('Dashboard_staff/detail/'.$data["getTrimester"]->TrimesterID."?warning=2");
					$transaction=false;
				}


				if($transaction){
					$_POST["TrimesterID"]=$data["getTrimester"]->TrimesterID;
					$this->Dashboard_staffModel->insertAssignment($_POST);
					redirect('Dashboard_staff/detail/'.$data["getTrimester"]->TrimesterID."?warning=3");
				}
			}

			if(isset($_POST["btnSubmitTimeDist"])){
				$transaction = true;

				if($_POST["CompletionHours"]<0){
					$transaction=false;
				}if($_POST["CompletionWeeks"]<0){
					$transaction=false;
				}if($_POST["ReadingHours"]<0){
					$transaction=false;
				}if($_POST["ContactHours"]<0){
					$transaction=false;
				}if($_POST["RevisionHours"]<0){
					$transaction=false;
					redirect('Dashboard_staff/detail/'.$data["getTrimester"]->TrimesterID."?warning=5");
				}
				
				if($transaction){
					$_POST["TrimesterID"]=$data["getTrimester"]->TrimesterID;
					$this->Dashboard_staffModel->updateTrimesterHours($_POST);
					redirect('Dashboard_staff/detail/'.$data["getTrimester"]->TrimesterID."?warning=6");
				}
			}

			if(isset($_POST["btnSubmitActivate"])){
				$transaction = true;
				
				if($transaction){
					$_POST["TrimesterID"]=$data["getTrimester"]->TrimesterID;
					$this->Dashboard_staffModel->activateTrimester($_POST["TrimesterID"]);
					redirect('Dashboard_staff/detail/'.$data["getTrimester"]->TrimesterID."?warning=7");
				}
			}

			if(isset($_POST["btnSubmitDeactivate"])){
				$transaction = true;
				
				if($transaction){
					$_POST["TrimesterID"]=$data["getTrimester"]->TrimesterID;
					$this->Dashboard_staffModel->deactivateTrimester($_POST["TrimesterID"]);
					redirect('Dashboard_staff/detail/'.$data["getTrimester"]->TrimesterID."?warning=8");
				}
			}

			

			$data["getEditTrimester"]=$this->Dashboard_staffModel->getEditTrimester($id);
			$data["getActivateTrimester"]=$this->Dashboard_staffModel->getActivateTrimester($id);
			$data["getDeactivateTrimester"]=$this->Dashboard_staffModel->getDeactivateTrimester($id);
			$data["getTrimesterStaff"]=$this->Dashboard_staffModel->getTrimesterStaff($id);
			$data["getTrimesterAssignment"]=$this->Dashboard_staffModel->getTrimesterAssignment($id);
			$data["getTotalAssignmentHours"]=$this->Dashboard_staffModel->getTotalAssignmentHours($id);
			$data["getTotalWeeksTrimester"]=$this->Dashboard_staffModel->getTotalWeeksTrimester($id);
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
		redirect('Dashboard_staff/detail/'.$TrimesterID."?warning=4");
	}
}
