<?php
require 'Myobject.php';
 
class MyobjectTests extends PHPUnit_Framework_TestCase
{
    private $Myobject;
 
    protected function setUp()
    {
        $this->Myobject = new Myobject();
    }
 
    protected function tearDown()
    {
        $this->Myobject = NULL;
    }
 
    public function testAdd()
    {
        $result = $this->Myobject->show(1);
        $this->assertEquals(1, $result);
    }
 
}