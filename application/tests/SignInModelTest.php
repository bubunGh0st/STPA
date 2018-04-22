<?php 

class SignInModelTest extends TestCase{

	protected function setUp(){
		/*$CI =& get_instance();
		$CI->load->model('SignInModel');*/
		// SignInModel is already loaded on Controller
		$this->SignInModel = new SignInModel();
    }
 
    protected function tearDown(){
        $this->SignInModel = NULL;
    }

	public function testIsSession(){
		$output = $this->SignInModel->isSession();
		$this->assertFalse($output);
	}
}