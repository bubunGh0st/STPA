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

	public function testisInsertUser(){
		$post["Email"]="scaventum@gmail.com";
		$newPassword="12345";
		$post["FName"]="Ryan";
		$post["LName"]="Djoenaidi";
		$post["Title"]="Mr";
		$post["SiteSuggestion"]="";

		$post["SiteID"]=array();

		$post["SiteID"][0]="";

		$output = $this->SignUpModel->insertUser($post,$newPassword);
		$this->assertFalse($output);

	}
}