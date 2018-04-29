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

			//edit course header
			if(isset($_POST["btnSubmit"])){
				$transaction = true;

				if($transaction){
					$_POST["CourseID"]=$data["getCourse"]->CourseID;
					$this->CoursesModel->updateCourse($_POST);
					redirect('Courses/detail/'.$data["getCourse"]->CourseID."?warning=1");
				}
			}

			$data["getEditTrimester"]=$this->Dashboard_staffModel->getEditTrimester($id);
			$data["getTrimesterStaff"]=$this->Dashboard_staffModel->getTrimesterStaff($id);
			$data["getTrimesterAssignment"]=$this->Dashboard_staffModel->getTrimesterAssignment($id);
			$this->load->view('templates/header');
			$this->load->view('courses_detail_staff',$data);
			$this->load->view('templates/footer');
		}else{
			redirect('Courses');
		}
	}
}
