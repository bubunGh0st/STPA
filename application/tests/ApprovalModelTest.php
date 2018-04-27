<?php

class ApprovalModelTest extends TestCase
{
	protected function setUp(){
		/*$CI =& get_instance();
		$CI->load->model('ApprovalModel');*/
		// ApprovalModel is already loaded on Controller
		$this->ApprovalModel = new ApprovalModel();

	}

	protected function tearDown(){

		$this->UsersModel = NULL;
	}


	//To return all approval list
    public function testgetApprovalList(){

            $output = $this->ApprovalModel->getApprovalList();
            $this->assertNotEmpty($output);
               
    }

    //will not get any user sites - email does not exist
    public function testgetUserSiteNoEmail(){
            
            $Email= "scaventum@gmail.com";
            $output = $this->ApprovalModel->getUserSite($Email);
            $this->assertEmpty($output);

            
        }

    //get all user sites
    public function testgetUserSite(){
            
            $Email= "bubun.fa91@gmail.com";
            $output = $this->ApprovalModel->getUserSite($Email);
            $this->assertNotEmpty($output);

            
        }

}