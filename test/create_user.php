<?php

if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit ();
}

$testHelper = new GwpmTestHelper() ;

$user_key = isset($_POST['user_key']) ? $_POST['user_key'] : null ;
$noOfUsers = isset($_POST['noOfUsers']) ? $_POST['noOfUsers'] : null;
$gender =  isset($_POST['gender']) ? $_POST['gender'] : null; 

$tempage = $testHelper->createDateRangeArray( '1980-10-01', '1985-10-05') ;

if(!isNull($user_key)) {

	$testHelper->createUsers($user_key, $noOfUsers, $gender) ;
	
} else {
	?>
		<form method="post" >
		<div style='width: 200px;'>User Key: </div><input type="text" name="user_key" ><br />
		<div style='width: 200px;'>No of users: </div><input type="text" name="noOfUsers" ><br />
		<div style='width: 200px;'>gender (1-Male or 2-Female): </div><input type="text" name="gender" ><br />
		<input type="submit" value="createUser"><br />
		</form>
	<?php
}