<?php
class Dashboard_staffModelTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('Dashboard_staffModelTest'); */
		//Dashboard_staff is alraedy laoded on controller
		$this->Dashboard_staffModel = new Dashboard_staffModel();

	}

	protected function tearDown()
	{
		$this->Dashboard_staffModel = NULL;
	}


	//To return all courses assigned to staff

	public function testgetStaffCourses()
	{
		$Email = "scaventum@yahoo.com";
		$output = $this->Dashboard_staffModel->getStaffCourses($Email);
		$this->assertNotEmpty($output);
	}

       
	//To return all courses NOT assigned to staff

	public function testgetStaffNotCourses()
	{
		$Email = "toufique.mallick@gmail.com";
		$output = $this->Dashboard_staffModel->getStaffNotCourses($Email);
		$this->assertNotEmpty($output);

		$Email = "toique.mallick@gmail.com";
		$output = $this->Dashboard_staffModel->getStaffNotCourses($Email);
		$this->assertEmpty($output);

	}

	//to return one row all columns from selected tr_course_trimester

	public function testgetTrimester()
	{
		$TrimesterID = "1";
		$output = $this->Dashboard_staffModel->getTrimester($TrimesterID);
		$this->assertNotNull($output);


		$TrimesterID = "9";
		$output = $this->Dashboard_staffModel->getTrimester($TrimesterID);
		$this->assertNull($output);
	}
	
	//to return one row all columns from selected tr_course_trimester by AssignmentID

	public function testgetTrimesterByAssignment()
	{
		$AssignmentID = "1";
		$output = $this->Dashboard_staffModel->getTrimesterByAssignment($AssignmentID);
		$this->assertNotNull($output);

		$AssignmentID = "10";
		$output = $this->Dashboard_staffModel->getTrimesterByAssignment($AssignmentID);
		$this->assertNull($output);
	}

	//to return total assessment hours of Trimester
	public function testgetTotalAssignmentHours()
	{
		$TrimesterID = "1";
		$output = $this->Dashboard_staffModel->getTotalAssignmentHours($TrimesterID);
		$this->assertNotNull($output);

		$TrimesterID = "11";
		$output = $this->Dashboard_staffModel->getTotalAssignmentHours($TrimesterID);
		$this->assertNull($output);

	}

	
    
    //to return total weeks of Trimester

	public function testgetTotalWeeksTrimester()
	{
		$TrimesterID = "1";
		$output = $this->Dashboard_staffModel->getTotalWeeksTrimester($TrimesterID);
		$this->assertNotNull($output);

		$TrimesterID = "15";
		$output = $this->Dashboard_staffModel->getTotalWeeksTrimester($TrimesterID);
		$this->assertNull($output);
	}
   

    //return all staff related to this course trimester
    public function testgetTrimesterStaff()
    {
    	$TrimesterID = "1";
    	$output = $this->Dashboard_staffModel->getTrimesterStaff($TrimesterID);
    	$this->assertNotEmpty($output);

    	$TrimesterID = "11";
    	$output = $this->Dashboard_staffModel->getTrimesterStaff($TrimesterID);
    	$this->assertEmpty($output);
    }



    //return all Assignment  related to this course trimester

    public function testgetTrimesterAssignment()
    {
    	$TrimesterID = "1";
    	$output = $this->Dashboard_staffModel->getTrimesterAssignment($TrimesterID);
    	$this->assertNotEmpty($output);

    	$TrimesterID = "20";
    	$output = $this->Dashboard_staffModel->getTrimesterAssignment($TrimesterID);
    	$this->assertEmpty($output);



    }
       

    //to check if trimester can be edited

    public function testgetEditTrimester()
    {
    	$TrimesterID = "1";
    	$output = $this->Dashboard_staffModel->getEditTrimester($TrimesterID);
    	$this->assertFalse($output);


    	$TrimesterID = "2";
    	$output = $this->Dashboard_staffModel->getEditTrimester($TrimesterID);
    	$this->assertTrue($output);

    }
    
    //to check if trimester can be activated

    public function testgetActivateTrimester()
    {
    	$TrimesterID = "2";
    	$output = $this->Dashboard_staffModel->getActivateTrimester($TrimesterID);
    	$this->assertTrue($output);

    	$TrimesterID = "1";
    	$output = $this->Dashboard_staffModel->getActivateTrimester($TrimesterID);
    	$this->assertFalse($output);


    }


    //to check if trimester can be deactivated

    public function testgetDeactivateTrimester()
    {
    	$TrimesterID = "1";
    	$output = $this->Dashboard_staffModel->getDeactivateTrimester($TrimesterID);
    	$this->assertTrue($output);

    	$TrimesterID = "2";
    	$output = $this->Dashboard_staffModel->getDeactivateTrimester($TrimesterID);
    	$this->assertFalse($output);

    }

    


    
         
   
    
   

    
        


}
