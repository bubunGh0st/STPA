<?php 

class SignUpModelTest extends TestCase{

	protected function setUp(){
		/*$CI =& get_instance();
		$CI->load->model('SignUpModel');*/
		// SignUpModel is already loaded on Controller
		$this->SignUpModel = new SignUpModel();
    }
 
    protected function tearDown(){
        $this->SignUpModel = NULL;
    }

	public function testisSignUp(){
		$post["Email"]="scaventum@gmail.com";
		$post["SiteID"]="1";
		$output = $this->SignUpModel->isSignUp($post);
		$this->assertFalse($output);

	}

	public function testisSignUpBlank(){
		$post["Email"]="";
		$output = $this->SignUpModel->isSignUp($post);
		$this->assertFalse($output);

	}

	

}