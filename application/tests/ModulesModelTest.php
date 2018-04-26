<?php
class ModulesModelTest extends TestCase{

	protected function setUp(){
		/*$CI =& get_instance();
		$CI->load->model('ModulesModel');*/
		// ModulesModel is already loaded on Controller
		$this->ModulesModel = new ModulesModel();
    }
 
    protected function tearDown(){
        $this->ModulesModel = NULL;
    }

	public function testautogenerateID(){
		
		$output = $this->ModulesModel->autogenerateID();
		$this->assertEquals("M0009",$output);

	}

	public function testisDeleteModule(){

            $moduleid= "M0001";
            $output = $this->ModulesModel->isDeleteModule($moduleid);
			$this->assertFalse($output);
	}

      //not granted     
     public function testisGranted(){

            $moduleid= "M0001";
            $output = $this->ModulesModel->isGranted($moduleid);
			$this->assertFalse($output);
	}
	// granted
	public function testisGrantedAccess(){

            $moduleid= array("M0001");
            $email= "scaventum@gmail.com";
            $output = $this->ModulesModel->isGranted($moduleid,$email);
			$this->assertTrue($output);
	}
	

	

}