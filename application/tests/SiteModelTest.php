<?php
class SiteModelTest extends TestCase
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
    public function testgetSites(){

        	$output = $this->SiteModel->getSites();
        	$this->assertNotEmpty($output);
               
         
    }

    //to return one row all columns from selected ms_site
    public function testgetSite(){

    		$SiteID = "1";
    		$output = $this->SiteModel->getSite($SiteID);
    		$this->assertNotNull($output);

    }

	//To check if site is in ms_site table
    public function testisDeleteSite(){

        	$SiteID = "1";
        	$output = $this->SiteModel->isDeleteSite($SiteID);
        	$this->assertNotNull($output);

           
    }
         


}