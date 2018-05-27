<?php
class UsersModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('UserModel'); */
		//SiteModel is already loaded on controller
		$this->UsersModel = new UsersModel();
	}

	protected function TearDown()
	{
		$this->UsersModel = NULL;
	}

	//To insert new user
    public function testinsertUser(){
        $post["Email"]="ria.urfriend@gmail.com";
        $newPassword="12345";
        $post["FName"]="Ravita";
        $post["LName"]="Negi";
        $post["Title"]="Dame";
        $post["RoleID"]="1";
        $output = $this->UsersModel->insertUser($post,$newPassword);
       
    }


    //Update user details
    public function testupdateUser()
    {
        $Email="ria.urfriend@gmail.com";
        $post["FName"]="Ravita";
        $post["LName"]="Negi";
        $post["Title"]="Dame";
        $post["RoleID"]="1";
        $output = $this->UsersModel->updateUser($post,$Email);
    }

    //delete user details
    public function testdeleteUser()
    {
        $Email = "ria.urfriend@gmail.com";
        $output = $this->UsersModel->deleteUser($Email);
    }
        

}