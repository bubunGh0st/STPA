<?php

class UsersModelTest extends TestCase
{
	protected function setUp(){
		/*$CI =& get_instance();
		$CI->load->model('RolesModel');*/
		// SignUpModel is already loaded on Controller
		$this->UsersModel = new UsersModel();

	}

	protected function tearDown(){

		$this->UsersModel = NULL;
	}

	//Testing for getting all users
	public function testgetUsers()
	{

		$output = $this->UsersModel->getUsers();
		$this->assertNotEmpty($output);
	}

	//Testing to return one row all columns from selected ms_user
    public function testgetUser()
    {
    	$Email= "scaventum@gmail.com";
    	$output = $this->UsersModel->getUser($Email);
    	$this->assertNotNull($output);
                   
    }

    //get all user sites
    public function testgetUserSite(){

    		$Email = "scaventum@gmail.com";
    		$output = $this->UsersModel->getUserSite($Email);
    		$this->assertEmpty($output);
               
    }


    //To check if module is in ms_role_module table
    public function testisDeleteUser(){

    		$Email = "s@s.com";
    		$output = $this->UsersModel->isDeleteUser($Email);
    		$this->assertFalse($output);

            
    }

}
