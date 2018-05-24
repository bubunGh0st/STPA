<?php
class CoursesModelDBTest extends TestCase
{
	protected function setUp()
	{
		/*CI = & get_instance();
		$CI->load->Model('ModulesModel'); */
		//ModulesModel is already loaded on controller
		$this->ModulesModel = new ModulesModel();
	}

	protected function TearDown()
	{
		$this->ModulesModel = NULL;
	}

	//To insert into module database.
	public function testinsertModule()
	{
		$Email = "ria.urfriend@gmail.com";
        $post["ModuleID"] = "M0001";
        $post["ModuleName"] = "Roles";
        $output = $this->ModulesModel->insertModule($post,$Email);
	}
        
    //Edit Module
    public function testupdateModule(){
    	$Email = "ria.urfriend@gmail.com";
    	$post["ModuleID"] = "M0001";
    	$post["ModuleName"] = "Staff";
    	$output = $this->ModulesModel->updateModule($post,$Email);

    }

    //delete module
    public function testdeleteModule()
    {
    	$Email = "ria.urfriend@gmail.com";
    	$ModuleID = "M0001";
    	$output = $this->ModulesModel->deleteModule($ModuleID,$Email);
    }
       
   


}