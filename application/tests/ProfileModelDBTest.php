<?php
class ProfileModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('ProfileModel'); */
		//ProfileModel is already loaded on controller
		$this->ProfileModel = new ProfileModel();
	}

	protected function TearDown()
	{
		$this->ProfileModel = NULL;
	}

	//To update profile
	public function testupdateProfile(){
		$Email = "ria.urfriend@gmail.com";
		$post["FName"] = "Ravita";
        $post["LName"] = "Negi";
        $post["Title"] = "Associate";

       $output = $this->ProfileModel->updateProfile($post,$Email);
        
	 	
    }

}