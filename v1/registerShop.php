<?php
	
	require_once '../includes/DbOperations.php';

	$response = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		if (isset($_POST['shopName']) and isset($_POST['seatCapacity']) and isset($_POST['openingTime']) and isset($_POST['closingTime']) and isset($_POST['leaveDay']) and isset($_POST['ownerName']) and isset($_POST['contactNumber']) and isset($_POST['Pricing']) and isset($_POST['email']) and isset($_POST['street']) and isset($_POST['city']) and isset($_POST['pincode']) and isset($_POST['state']))
			{

			$db = new DbOperations();	
			$result = $db->createShop(
				$_POST['shopName'],
				$_POST['seatCapacity'],
				$_POST['openingTime'],
				$_POST['closingTime'],
				$_POST['leaveDay'],
				$_POST['ownerName'],
				$_POST['contactNumber'],
				$_POST['Pricing'],
				$_POST['email'],
				$_POST['street'],
				$_POST['city'],
				$_POST['pincode'],
				$_POST['state']
				);

			if ($result == 1){

				$response['error'] = false;
				$response['message'] = "Shop registered Successfully..!!";

			}elseif($result == 2){

				$response['error'] = true;
				$response['message'] = "Some error occurs.. Please try again..!!";

			}elseif($result == 0) {

				$response['error'] = true;
				$response['message'] = "Account already exists..!";

			}		

		}else{

			$response['error'] = true;
			$response['message'] = "Required fields are missing";

		}

	}else{

		$response['error'] = true;
		$response['message'] = "Invalid Request";

	}

	echo json_encode($response);