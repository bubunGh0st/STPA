<?php 

class SignInModelTest extends CIPHPUnitTestCase{

	protected function setUp(){
		/*$CI =& get_instance();
		$CI->load->model('SignInModel');*/
		// SignInModel is already loaded on Controller
		$this->SignInModel = new SignInModel();
		$this->ModulesModel = new ModulesModel();
    }
 
    protected function tearDown(){
        $this->SignInModel = NULL;
        $this->ModulesModel = NULL;
    }

	public function testIsSession(){
		$output = $this->SignInModel->isSession();
		$this->assertFalse($output);
	}

	public function testIsSignIn_successful(){
		$post["Email"]="scaventum@gmail.com";
		$post["Password"]="12345";
		$output = $this->SignInModel->isSignIn($post);
		$this->assertEquals('1',$output);
	}

	public function testIsSignIn_InvalidEmail(){
		$post["Email"]="scavenm@gmail.com";
		$post["Password"]="12345";
		$output = $this->SignInModel->isSignIn($post);
		$this->assertEquals('2',$output);
	}

	public function testIsSignIn_InvalidPass(){
		$post["Email"]="scaventum@gmail.com";
		$post["Password"]="qRzZ6S";
		$output = $this->SignInModel->isSignIn($post);
		$this->assertEquals('3',$output);
	}
}