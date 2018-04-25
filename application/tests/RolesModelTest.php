<?php 

class RolesModelTest extends TestCase{

	protected function setUp(){
		/*$CI =& get_instance();
		$CI->load->model('RolesModel');*/
		// SignUpModel is already loaded on Controller
		$this->RolesModel = new RolesModel();
    }
 
    protected function tearDown(){
        $this->RolesModel = NULL;
    }

	public function testgetRole(){
			$RoleID = "STAFF";
			$output = $this->RolesModel->getRole($RoleID);
			$this->assertNotNull($output);

        }

    public function testgetRoleModules(){
			$RoleID = "SITE-ADMIN";
			$ModuleID= "M0001";
			$output = $this->RolesModel->getRoleModules($RoleID);
			$this->assertNotNull($output);

        }


     //Testing to check "To return all modules dont belong to role"
    public function testgetNotRoleModules()
    {
    		$RoleID = "SITE-ADMIN";
			$ModuleID= "N0001";
			$output = $this->RolesModel->getRoleModules($RoleID);
			$this->assertNotEmpty($output);

    }
    
    //check if role id already exists
    public function testisInsertRole()
    {
    	$RoleID = "SYS-ADMIN";
    	$output = $this->RolesModel->isInsertRole($RoleID);
    	$this->assertFalse($output);
    }

	//check if role id used by a user
	public function testisDeleteRole()
	{
		$RoleID = "STAFF";
		$output = $this->RolesModel->isDeleteRole($RoleID);
		$this->assertFalse($output);


	}
	
	

}