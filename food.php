<?php header("Location:food_reserve.php");

//$servername = "localhost";
	$servername = "db_service_host:3306";
	$dbname = "cc_project_database";
	$username = "auth_service_user";
	//$password = "";
	$password = "Auth_service@1397";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$type = $_GET['type'];
if ($type == 'reserve') {
	$student_id = $_POST['clientID'];
	$status = '1';
	$insStr = "";

	if (isset($_POST['btnres'])) {
		if (!empty($_POST['cid'])) {
			foreach($_POST['cid'] as $food_id) {
				if($insStr == "") {
					$insStr = "('$food_id','$student_id','$status')";
				} else {
					$insStr .= ",('$food_id','$student_id','$status')";
				}
			}
			$sql = "INSERT INTO food_student (f_id, s_id, fs_status) VALUES $insStr";
			//$conn->exec($sql);
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}

if ($type == 'cancel') {
	//echo "hasan";die();
	$student_id = $_POST['clientID'];
	$cancStr = "";
	//print_r($_POST);die();
	
	if (isset($_POST['btncancel'])) {
		if (!empty($_POST['ckid'])) {
			//echo 'acnskncs'; die();
			foreach($_POST['ckid'] as $fs_id) {
				if($cancStr == "") {
					$cancStr = "('$fs_id')";
				} else {
					$cancStr .= ",('$fs_id')";
				}
			}
			//echo $cancStr;
			$sql = "UPDATE food_student
					SET fs_status = 0
					WHERE fs_id IN ($cancStr)";
					
					//echo $sql;die();
			//$conn->exec($sql);
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		else {
			echo 'error';
		}
	}
}

redirect(base_url().'food_reserve.php');

?>
