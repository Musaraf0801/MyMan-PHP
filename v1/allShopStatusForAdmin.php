<?php
	
	require_once '../includes/DbOperations.php';

	$response = array();

	$response['error'] = false;

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		if (isset($_POST['no']) == "1"){

			$db = new DbOperations();
			
			$res = $db->getAllShopStatusForAdmin();



			//$response['error'] = false;
		}else{

			$response['error'] = true;
			$response['message'] = "Code is incorrect";
		}
		

	}

	if ($response['error'] === true){
		echo json_encode($response);	
	}
