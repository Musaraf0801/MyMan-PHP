<?php
	
	class DbOperations{

		public $con;

		function __construct(){

			require_once dirname(__FILE__).'/DbConnect.php';

			$db = new DbConnect();

			$this->con = $db->connect();
		}

		/* Create */

		public function createUser($username, $pass, $email) {

			if ($this->isUserExist($username, $email)){
				return 0;
			}else{

				$password = md5($pass);

				$stmt = $this->con->prepare("INSERT INTO `User` (`id`, `username`, `password`, `email`) VALUES (NULL, ?, ?, ?);");

				$stmt->bind_param("sss",$username,$password, $email);

				if ($stmt->execute()) {
					return 1;
				}
				else{
					return 2;
				}
			}

		}

		public function userLogin($username, $pass){

			$password = md5($pass);
			$stmt = $this->con->prepare("SELECT id from User WHERE username = ? AND password = ?");
			$stmt->bind_param("ss", $username, $password);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;
		}

		public function shopLogin($id, $pass){

			$stmt = $this->con->prepare("SELECT id from Shops WHERE id = ? AND password = ?");
			$stmt->bind_param("ss", $id, $pass);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;

		}



		public function getUserByUsername($username){
			$stmt = $this->con->prepare("SELECT * from User WHERE username = ?");
			$stmt->bind_param("s", $username);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}

		public function getUserByShopId($id){
			$stmt = $this->con->prepare("SELECT * from Shops WHERE id = ?");
			$stmt->bind_param("s", $id);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}

		private function isUserExist($username, $email){

			$stmt = $this->con->prepare("SELECT id FROM User WHERE username = ? OR email = ?");
			$stmt->bind_param("ss", $username, $email);
			$stmt->execute();
			$stmt->store_result();

			return $stmt->num_rows > 0;

		}

		public function createShop( $shopName, $seatCapacity, $openingTime, $closingTime, $leaveDay, $ownerName, $contactNumber, $pricing, $email, $street, $city, $pincode){

			if ($this->isShopExist($shopName)){
				return 0;
			}else{
				$stmt = $this->con->prepare("INSERT INTO `Shops` (`shopName`, `seatCapacity`, `openingTime`, `closingTime`, `leaveDays`, `ownerName`, `contactNumber`, `Pricing`,`email`, `street`, `city`, `pincode`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

				//$stnt = $this->con->prepare("INSERT INTO `ShopStatus` (`id`, `shopName`) VALUES (?, ?)");

				$stmt->bind_param("ssssssssssss",$shopName, $seatCapacity, $openingTime, $closingTime, $leaveDay, $ownerName, $contactNumber, $pricing, $email, $street, $city, $pincode);

				//$stnt->bind_param("ss", $id, $shopName);

				if($stmt->execute()){
					return 1;
				}else{
					return 2;
				}
			}

		}

		private function isShopExist($shopName){

			$stmt = $this->con->prepare("SELECT id FROM Shops WHERE shopName = ?");
			$stmt->bind_param("s", $shopName);
			$stmt->execute();
			$stmt->store_result();

			return $stmt->num_rows > 0;

		}

		public function getShopForAdmin($id){

			$stmt = $this->con->prepare("SELECT * FROM ShopStatus WHERE id = ?");
			$stmt->bind_param("s", $id);

			if($stmt->execute()){

				return $stmt->get_result()->fetch_assoc();
			}else{
				return false;
			}


		}

		public function openShop($id){

			$stmt = $this->con->prepare("UPDATE `ShopStatus` SET `status`= 1 WHERE id = ?");
			$stmt->bind_param("s", $id);

			if ($stmt->execute()){

				return true;

			}else{

				return false;
			}

		}

		public function closeShop($id){

			$stmt = $this->con->prepare("UPDATE `ShopStatus` SET `status`= 0 WHERE id = ?");
			$stmt->bind_param("s", $id);

			if ($stmt->execute()){

				return true;

			}else{

				return false;
				
			}

		}

		public function getAllShopStatusForAdmin(){

				$stmt = $this->con->prepare("SELECT id, status, bookings, shopName FROM ShopStatus;");
	
				$stmt->execute();
				
				$stmt->bind_result($id, $status, $bookings, $shopName);
				
				$shops = array(); 
				
				while($stmt->fetch()){
					$temp = array();
					$temp['id'] = $id; 
					$temp['status'] = $status; 
					$temp['bookings'] = $bookings; 
					$temp['shopName'] = $shopName; 
					array_push($shops, $temp);
				}

				return $shops;
		}

		public function adminRegister($username, $pass, $email){

			if ($this->isAdminExist($username, $email)){
				return 0;
			}else{

				$password = md5($pass);

				$stmt = $this->con->prepare("INSERT INTO `adminUser` (`id`, `username`, `password`, `email`) VALUES (NULL, ?, ?, ?);");

				$stmt->bind_param("sss",$username,$password, $email);

				if ($stmt->execute()) {
					return 1;
				}
				else{
					return 2;
				}
			}
		}

		private function isAdminExist($username, $email){

			$stmt = $this->con->prepare("SELECT id FROM adminUser WHERE username = ? AND email = ?");
			$stmt->bind_param("ss", $username, $email);
			$stmt->execute();
			$stmt->store_result();

			return $stmt->num_rows > 0;

		}

		public function adminLogin($username, $pass){

			$password = md5($pass);
			$stmt = $this->con->prepare("SELECT id from adminUser WHERE username = ? AND password = ?");
			$stmt->bind_param("ss", $username, $password);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;
		}


	}