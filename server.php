<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'incidentmonitor');

	// initialize variables
	$keyword = "";
	$no = "";
	// insert
	if (isset($_POST['submit'])) {
		$keyword = $_POST['keyword'];
		$arr=explode("\n",$keyword);

		// if($_SERVER['REQUEST_METHD']=='POST'){
			foreach($arr as $key => $value){

				mysqli_query($db, "INSERT INTO keywordtable (keyword) VALUES ('$value')"); 
				$_SESSION['message'] = "keyword Added"; 
				header('location: index.php');
			}
		}
	// }

	//delete
	if (isset($_GET['del'])) {
		$no = $_GET['del'];
		mysqli_query($db, "DELETE FROM keywordtable WHERE id=$no");
		$_SESSION['message'] = "Address deleted!"; 
		header('location: index.php');
	}

	