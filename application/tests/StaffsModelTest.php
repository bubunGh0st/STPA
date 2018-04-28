<?Php
class StaffsModelTest extends TestCase
{

	protected function setUp(){

		/*CI =& get_instance();
		$CI->load->Model('StaffsModel'); */
		//StaffsModel is already loaded on Controller
		$this->StaffsModel = new StaffsModel();

	}	

	protected function tearDown(){

		$this->StaffsModel = NULL;


	}

	//To return all staffs

	public function testgetStaffs(){
		$Email = "ryan.djoenaidi@it.weltec.ac.nz";
		$output = $this->StaffsModel->getStaffs($Email);
		$this->assertNotEmpty($output);

	}

	//to return one row all columns from selected ms_user(Staff)
	public function testgetStaff()
	{
		$Email = md5("scaventum@yahoo.com");
		$output = $this->StaffsModel->getStaff($Email);
		$this->assertNotNull($output);
	}
        

        

}

