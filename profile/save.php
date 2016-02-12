<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
if(isset($_SESSION['username'])){
	if($_SESSION['user_type'] == 2){
		include('../conn.php');
		if(isset($_POST['modify'])){
			$id = $_POST['shop_id'];
			$shop_number = $_POST['shop_number'];
			$address_1 = $_POST['address_1'];
			$address_2 = $_POST['address_2'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$pincode = $_POST['pincode'];
			$opening_time = $_POST['opening_time'];
			$closing_time = $_POST['closing_time'];
			$off = $_POST['Off-day'];
			$query_making = "select * from store where id='$id'";
			$result_making = mysqli_query($connection,$query_making);
			$i=0;
			$temp="";
			while($row = mysqli_fetch_array($result_making)){
				if($row['shop_number'] !=$shop_number){
					$temp = $temp." shop_number='".$shop_number."' and ";
					$i = $i+1;
				}
				if($row['address_1'] !=$address_1){
					$temp = $temp." address_1='".$address_1."' and ";
										$i = $i+1;
				}
				if($row['address_2'] !=$address_2){
					$temp = $temp." address_2='".$address_2."' and ";
										$i = $i+1;
				}
				if($row['city'] != $city){
					$temp = $temp." city='".$city."' and";
										$i = $i+1;
				}
				if($row['state'] != $state){
					$temp = $temp." state='".$state."' and";
										$i = $i+1;
				}
				if($row['pin_code'] != $pincode){
					$temp = $temp." pin_code='".$pincode."' and ";
										$i = $i+1;
				}
				if($row['opening_time'] != $opening_time){
					$temp = $temp." opening_time='".$opening_time."' and ";
										$i = $i+1;
				}
				if($row['closing_time'] != $closing_time){
					$temp = $temp." closing_time='".$closing_time."' and ";
										$i = $i+1;
				}if($row['off_day'] != $off){
					$temp = $temp." off_day='".$off."' and ";
										$i = $i+1;
				}


			}
			if($i==0){
				echo "no change is done";
				echo "we are Redirecting you to your Manage Store Page";
				header('refresh: 2; url=manage_stores.php');
				exit;
			}
			   if(substr($temp,strlen($temp)-4,strlen($temp)) =='and '){
   					$temp = substr($temp,0,strlen($temp)-4);
   				}
   				
			$query = "update store set".$temp." where id=$id";
			$result = mysqli_query($connection,$query) OR die(mysqli_error($connection));
				echo "Store Information is modified..<br>";
              	echo "please wait....";
              	header('refresh: 2; url=index.php');
		}

	}
}


?>
</body>
</html>