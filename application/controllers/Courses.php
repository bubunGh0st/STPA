<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->model('CoursesModel');
        if ($this->SignInModel->isSession() == FALSE) redirect('SignOut');
        if (!$this->ModulesModel->isGranted(array("M0006"))) redirect('Blank');

    }

	public function index()
	{
		if(isset($_POST["btnSubmitAdd"])){
			$transaction = true;

			if($transaction){
				$_POST["CourseID"]=$this->CoursesModel->autogenerateID();
				$this->CoursesModel->insertCourse($_POST);
				redirect('Courses');
			}
		}

		if(isset($_POST["btnSubmitDel"])){
			$transaction = true;
			if(!$this->CoursesModel->isDeleteCourse($_POST["CourseID"])){
				$transaction=false;
				redirect('Courses/index/?warning=1');
			}
			if($transaction){
				$this->CoursesModel->deleteCourse($_POST["CourseID"]);
				redirect('Courses');
			}
		}

		$data["getCourses"]=$this->CoursesModel->getCourses($this->session->userdata['Email']);
		$data["getUserSite"]=$this->CoursesModel->getUserSite($this->session->userdata['Email']);
		$this->load->view('templates/header');
		$this->load->view('courses',$data);
		$this->load->view('templates/footer');
	}

	public function detail($id = "")
	{
		$data["getCourse"]=$this->CoursesModel->getCourse($id);
		if($data["getCourse"]!=NULL){

			//edit course header
			if(isset($_POST["btnSubmit"])){
				$transaction = true;

				if($transaction){
					$_POST["CourseID"]=$data["getCourse"]->CourseID;
					$this->CoursesModel->updateCourse($_POST);
					redirect('Courses/detail/'.$data["getCourse"]->CourseID."?warning=1");
				}
			}

			//add course trimester
			if(isset($_POST["btnSubmitAddTrimester"])){
				$transaction = true;

				if(date("Ymd",strtotime($_POST["StartDate"]))>=date("Ymd",strtotime($_POST["FinishDate"]))){
					$transaction = false;
					redirect('Courses/detail/'.$data["getCourse"]->CourseID."?warning=2");

				}

				if($transaction){
					$_POST["CourseID"]=$data["getCourse"]->CourseID;
					$this->CoursesModel->insertTrimester($_POST);
					redirect('Courses/detail/'.$data["getCourse"]->CourseID."?warning=3");
				}
			}

			$data["getUserSite"]=$this->CoursesModel->getUserSite($this->session->userdata['Email']);
			$data["getTrimester"]=$this->CoursesModel->getTrimester($data["getCourse"]->CourseID);
			$this->load->view('templates/header');
			$this->load->view('courses_detail',$data);
			$this->load->view('templates/footer');
		}else{
			redirect('Courses');
		}
	}

	public function deleteTrimester($id = "")
	{
		$CourseID=$_GET["CourseID"];
		//add course trimester

		$transaction = true;
		if(!$this->CoursesModel->isDeleteTrim($id)){
			$transaction = false;
		}

		if($transaction){
			$this->CoursesModel->deleteTrimester($id);
			redirect('Courses/detail/'.$CourseID."?warning=4");
		}else{
			redirect('Courses/detail/'.$CourseID);
		}
	}

	public function detail_staff($id = "")
	{
		$data["id"]=$id;
		$this->load->view('templates/header');
		$this->load->view('courses_detail_staff',$data);
		$this->load->view('templates/footer');
	}
}
