<?php
class SiteModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('SiteModel'); */
		//SiteModel is already loaded on controller
		$this->SiteModel = new SiteModel();
	}

	protected function TearDown()
	{
		$this->SiteModel = NULL;
	}

	//To return all sites
    public function testInsertSite(){
        $post["SiteName"]="Weltec Petone";
        $post["Address"]="";
        $post["Contact"]="";
        $email="scaventum@gmail.com";
    	$output = $this->SiteModel->insertSite($post,$email);
    	//$this->assertNotEmpty($output);
    }   


    //Edit Site
    public function testUpdateSite(){
        $post["SiteID"]="4";
        $post["SiteName"]="Weltec Petone";
        $post["Address"]="Wellington Campus";
        $post["Contact"]="02102831362";
        $email="scaventum@gmail.com";
        $output= $this->SiteModel->updateSite($post,$email);
    }

    //Delete Site

    public function testDeleteSite(){
        $SiteID="5";
        $email="scaventum@gmail.com";
        $output= $this->SiteModel->deleteSite($SiteID,$email);
    } 

}