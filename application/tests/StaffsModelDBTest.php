<?php
class StaffsModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('StaffsModel'); */
		//StaffsModel is already loaded on controller
		$this->StaffsModel = new StaffsModel();
	}

	protected function TearDown()
	{
		$this->StaffsModel = NULL;
	}

	
	//insert new Staff
    public function testinsertStaff(){
    	$Email = "negiravita@gmail.com";
        $newPassword = "12345";
        $post["FName"] = "Vlad";
        $post["LName"] = "Slokvia";
        $post["Title"] = "Doctorate";
        $post["SiteID"] = "4";

        $output = $this->StaffsModel->insertStaff($post,$newPassword,$Email);

    }

    //Edit staff
    public function testupdateStaff(){
    	$Email = "negiravita@gmail.com";
        $post["FName"] = "Vlad";
        $post["LName"] = "Slokvia";
        $post["Title"] = "General";
        $post["SiteID"] = "4";

        $output = $this->StaffsModel->updateStaff($post,$Email);
    }

}