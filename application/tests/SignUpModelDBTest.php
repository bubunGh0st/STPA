<?php 

class SignUpModelDBTest extends TestCase{

	protected function setUp(){
		/*$CI =& get_instance();
		$CI->load->model('SignUpModel');*/
		// SignUpModel is already loaded on Controller
		$this->SignUpModel = new SignUpModel();
    }
 
    protected function tearDown(){
        $this->SignUpModel = NULL;
    }

	public function testinsertUser(){
		$Email="scaventumm@gmail.com";
		$newPassword="12345";
		$post["FName"]="yan";
		$post["LName"]="joenaidi";
		$post["Title"]="Mr";
		$post["SiteSuggestion"]="Petone";

		$post["SiteID"]="1";


		$output = $this->SignUpModel->insertUser($post,$newPassword,$Email);
		

	}
}