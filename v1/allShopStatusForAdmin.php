<?php
	
	require_once '../includes/DbOperations.php';

	$response = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		if (isset($_POST['no']) == "1"){

			$db = new DbOperations();
			
			$response = $db->getAllShopStatusForAdmin();

			$response['error'] = false;
		}else{

			$response['error'] = true;
			$response['message'] = "Code is incorrect";
		}
		

	}

	echo json_encode($response);