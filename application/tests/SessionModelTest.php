<?php
class SessionModelTest extends TestCase
{
	protected function setUp(){

		/*CI =& get_instance();
		$CI->load->Model('StaffsModel'); */
		//StaffsModel is already loaded on Controller
		$this->SessionModel = new SessionModel();

	}	

	protected function tearDown(){

		$this->SessionModel = NULL;


	}


	//To check if session is active in every page
	public function testisSession()
	{
		
		$output = $this->SessionModel->isSession();
		$this->assertFalse($output);
	}

	
   


}