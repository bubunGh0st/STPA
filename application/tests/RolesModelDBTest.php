<?php
class RolesModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('RolesModel'); */
		//RolesModel is already loaded on controller
		$this->RolesModel = new RolesModel();
	}

	protected function TearDown()
	{
		$this->RolesModel = NULL;
	}

	//To insert into role database.
	public function testinsertRole(){
		$Email = "ria.urfriend@gmail.com";
        $post["RoleID"] = "Staff";
        $post["RoleName"] = "staff";
        $output = $this->RolesModel->insertRole($post,$Email);
	}

	//Edit Module
	public function testupdateRole(){
		$Email = "ria.urfriend@gmail.com";
        $post["RoleID"] = "Staff";
        $post["RoleName"] = "Administrator";
        $output = $this->RolesModel->updateRole($post,$Email);
	}


	//grant module to role
	public function testgrantModule(){
		$Email = "ria.urfriend@gmail.com";
        $post["RoleID"] = "Admin";
        $post["ModuleID"] = "M0001";
        $output = $this->RolesModel->grantModule($post,$Email);
	}

	//revoke module from role
	public function testrevokeModule(){
		$Email = "ria.urfriend@gmail.com";
        $post["RoleID"] = "Admin";
        $post["ModuleID"] = "M0001";
        $output = $this->RolesModel->revokeModule($post,$Email);
	}

	 //delete role
	public function testdeleteRole(){
		$Email = "ria.urfriend@gmail.com";
        $RoleID = "Staff";
        $output = $this->RolesModel->deleteRole($RoleID,$Email);
	}
        

        
       
        

}