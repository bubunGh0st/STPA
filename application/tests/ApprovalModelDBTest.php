<?php
class ApprovalModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('ApprovalModel'); */
		//ApprovalModel is already loaded on controller
		$this->ApprovalModel = new ApprovalModel();
	}

	protected function TearDown()
	{
		$this->ApprovalModel = NULL;
	}

	//User approval
	public function testapproveUser(){

		$Email = "ria.urfriend@gmail.com";
        $post["Password"] = "12345";
        
       	$output = $this->ApprovalModel->approveUser($post,$Email);
	}


	//User Rejection
	public function testrejectUser()
	{
		$Email = "negiravita@gmail.com";
        
       	$output = $this->ApprovalModel->rejectUser($Email);
	}

	//add new site from suggestion
	public function testaddSite(){
		$Email = "negiravita@gmail.com";
       
        $post["Contact"] = "02102831362";
        $post["Address"] = "Upper hutt, Wellington";
        $post["SiteName"] = "Upper hutt";
       

        $output = $this->ApprovalModel->addSite($post,$Email);
	}
       
	
}