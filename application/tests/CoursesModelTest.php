<?php

class CoursesModelTest extends TestCase
{
    protected function setUp(){

        /*CI =& get_instance();
        $CI->load->model('CoursesModel');*/
        //CoursesModel is already loaded on Controller
        $this->CoursesModel = new CoursesModel();

    }

    protected function tearDown(){

        $this->CoursesModel = NULL;
    }


    //Testing to check To return all courses
        public function testgetCourses(){

            $Email = "negiravita@gmail.com";
            $output = $this->CoursesModel->getCourses($Email);
            $this->assertNotEmpty($output);
                    
    }

    //to return one row all columns from selected ms_course
        public function testgetCourse(){

            $CourseID = "C0000001";
            $output = $this->CoursesModel->getCourse($CourseID);
            $this->assertNotNull($output);
               
            
    }

    //To return all sites associate with the site id
        public function testgetUserSite(){

            $Email = "negiravita@gmail.com";
            $output = $this->CoursesModel->getUserSite($Email);
            $this->assertNotNull($output);
            
    }


    //Auto generate course id
        public function testautogenerateID(){

            $output = $this->CoursesModel->autogenerateID();
            $this->assertEquals("M0000003",$output); 


    }

     //To check if module is in ms_role_module table
        public function testisDeleteCourse(){

            $CourseID = "M001";
            $output = $this->CoursesModel->isDeleteCourse($CourseID);
            $this->assertTrue($output);

           
    }


}


