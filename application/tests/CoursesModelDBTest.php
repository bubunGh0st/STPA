<?php
class CoursesModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('CoursesModel'); */
		//CoursesModel is already loaded on controller
		$this->CoursesModel = new CoursesModel();
	}

	protected function TearDown()
	{
		$this->CoursesModel = NULL;
	}

    //To insert in course database

    public function testinsertCourse(){
        $Email = "ria.urfriend@gmail.com";
        $post["CourseID"] = "1";
        $post["CourseCode"] = "IT6256";
        $post["CourseName"] = "Logical Database";
        $post["SiteID"] = "4";
        $post["CourseCredit"] = "Credit 15";
        $output = $this->CoursesModel->insertCourse($post,$Email);

    }

    //To insert in trimester database

    public function testinsertTrimester(){
        $Email = "ria.urfriend@gmail.com";
        $post["CourseID"] = "1";
        $post["TrimesterName"] = "July-Nov";
        $_POST["StartDate"] = "2018-07-02 00:00:00";
        $_POST["FinishDate"] = "2018-10-02 00:00:00";
        $output = $this->CoursesModel->insertTrimester($post,$Email);

    }

    //Edit Courses

    public function testupdateCourse(){
        $Email = "ria.urfriend@gmail.com";
        $post["CourseID"] = "1";
        $post["CourseCode"] = "IT6256";
        $post["CourseName"] = "Advanced Database";
        $post["SiteID"] = "4";
        $post["CourseCredit"] = "Credit 15";
        $output = $this->CoursesModel->updateCourse($post,$Email);
    }

    //To delete course

    public function testdeleteCourse()
    {
        $CourseID= "1";
        $Email = "ria.urfriend@gmail.com";
        $output = $this->CoursesModel->deleteCourse($CourseID,$Email);
    }

    //To delete trimester
    public function testdeleteTrimester(){
        $TrimesterID = "13";
        $Email = "ria.urfriend@gmail.com";
        $output = $this->CoursesModel->deleteTrimester($TrimesterID,$Email);
    }
        


   

	 

}