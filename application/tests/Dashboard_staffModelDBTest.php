<?php
class Dashboard_staffModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('Dashboard_staffModel'); */
		//ApprovalModel is already loaded on controller
		$this->Dashboard_staffModel = new Dashboard_staffModel();
	}

	protected function TearDown()
	{
		$this->Dashboard_staffModel = NULL;
	}

	//To insert in tr_course_trimester_staff
    public function testassignCourse(){

		$Email = "ria.urfriend@gmail.com";
        $post["TrimesterID"] = "1";

        
       	$output = $this->Dashboard_staffModel->assignCourse($post,$Email);
	}

	//To insert in tr_course_trimester_assignment
    public function testinsertAssignment(){

    	$Email = "ria.urfriend@gmail.com";
        $post["TrimesterID"] = "1";
        $post["Title"] = "Human Interface Technology";
        $post["Description"] = "15 credit course";
        $post["FinishTime"] = "2018-08-31 23:59:59";
        $post["CompletionHours"] = "10";

       	$output = $this->Dashboard_staffModel->insertAssignment($post,$Email);
    }

    //To update hours in tr_course_trimester_assignment
    public function testupdateTrimesterHours(){
    	$Email = "ria.urfriend@gmail.com";
        $post["TrimesterID"] = "1";
        $post["ReadingHours"] = "20";
        $post["ContactHours"] = "15";
        $post["CompletionWeeks"] = "15";
        $post["RevisionHours"] = "3";
        $post["CompletionHours"] = "10";

       	$output = $this->Dashboard_staffModel->updateTrimesterHours($post,$Email);
   }

    
    
    //To activate trimester
    public function testactivateTrimester(){
    	$Email = "ria.urfriend@gmail.com";
        $TrimesterID = "1";
        
       	$output = $this->Dashboard_staffModel->activateTrimester($TrimesterID,$Email);
    }

    //To deactivate trimester
    public function testdeactivateTrimester(){
    	$Email = "ria.urfriend@gmail.com";
        $TrimesterID = "1";
        
       	$output = $this->Dashboard_staffModel->deactivateTrimester($TrimesterID,$Email);
    }

            
}