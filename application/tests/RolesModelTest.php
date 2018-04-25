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


	

	

}