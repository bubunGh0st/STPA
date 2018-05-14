<?php

class MyTestCase extends TestCase {

    function testReadDatabase() {
    $conn = new mysqli("localhost", "root", "","db_stp");

        // fixtures auto loaded, let's read some dataggg
        $query = $conn->query('Select * From ms_site');
        $result=mysqli_num_rows($query);
        $this->assertEquals(2, $result);

    }

}