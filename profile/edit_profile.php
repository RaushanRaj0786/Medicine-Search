<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

if(isset($_SESSION['user_id'])){
	include('../conn.php');
		$id = $_SESSION['user_id'];
	$table ="";
	if($_SESSION['user_type'] == 1){
		$table = "customer";
	}elseif($_SESSION['user_type'] == 2){
		$table = "owner_info";
	}else{
		$table = "pharma_company";
	}


	if(isset($_POST['submit_save'])){
		$query = "select * from $table where id='$id'";
		$result = mysqli_query($connection,$query) OR die(mysqli_error($connection));
		if($_SESSION['user_type'] ==1){
			$name = $_POST['name'];
			while($row = mysqli_fetch_array($result)){
				if($row['name'] == $name){
					echo "no change has been made";
				}else{
					$q = mysqli_query($connection,"update customer set name ='".$name."'") OR die(mysqli_error($connection));
				}
			}
		}elseif($_SESSION['user_type'] == 2){
			$name = $_POST['name'];
			$address_1 = $_POST['address_1'];
			$address_2 = $_POST['address_2'];
			$address_3 = $_POST['address_3'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$pincode = $_POST['pincode'];
			$i=0;
			$temp="";
			while($row = mysqli_fetch_array($result)){
				if($row['name'] != $name){
					$temp = $temp." name='".$name."' and ";
					$i = $i+1;
				}
				if($row['address_1'] != $address_1){
					$temp = $temp." address_1='".$address_1."' and ";
					$i=$i+1;
				}
				if($row['address_2'] != $address_2){
					$temp = $temp." address_2='".$address_2."' and ";
					$i=$i+1;
				}
				if($row['address_3'] != $address_3){
					$temp = $temp." address_3='".$address_3."' and ";
					$i=$i+1;
				}
				if($row['city'] != $city){
					$temp = $temp." city='".$city."' and ";
					$i=$i+1;
				}
				if($row['state'] != $state){
					$temp = $temp." state='".$state."' and ";
					$i=$i+1;
				}
				if($row['pincode'] != $pincode){
					$temp = $temp." pincode='".$pincode."' and ";
					$i=$i+1;
				}
				if($i ==0){
					echo "no change has been made....";
				}else{
					if(substr($temp,strlen($temp)-4,strlen($temp)) =='and '){
   						$temp = substr($temp,0,strlen($temp)-4);
   					}
   					$query = "update owner_info set".$temp." where id=$id";

					$res = mysqli_query($connection,$query) OR die(mysqli_error($connection));
					echo "done";
				}


			}
		}else{

		}



	}








	$id = $_SESSION['user_id'];
	$table ="";
	if($_SESSION['user_type'] == 1){
		$table = "customer";
	}elseif($_SESSION['user_type'] == 2){
		$table = "owner_info";
	}else{
		$table = "pharma_company";
	}
	$query ="select * from ".$table." where id='$id'";
	$result = mysqli_query($connection,$query) OR die(mysqli_error($connection));
	if($_SESSION['user_type'] == 1){
		while($row = mysqli_fetch_array($result)){
		?>
		<table>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<tr><td>Name:</td><td><input name="name" value="<?php echo $row['name']?>"/></td></tr>
			<tr><td>Username:</td><input name="username" value="<td><?php echo $row['username']?>"/></td></tr>
			<tr><td>Email"</td><input name="email" value="<td><?php echo $row['email']?>"/></td></tr>
			<tr><td><input type="submit" name="submit_save" value="Save"/></td></tr>
			</form>
		</table>

		<?php
		}
	}elseif($_SESSION['user_type'] == 2){
		while($row = mysqli_fetch_array($result)){
		?>
		<table>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<tr><td>Name:</td><td><input name="name" value="<?php echo $row['name']?>"/></td></tr>
			<tr><td>Username:</td><td><input name="username" value="<?php echo $row['username']?>" Readonly></td></tr>
			<tr><td>Email:</td><td><input name="email" value="<?php echo $row['email']?>" Readonly/></td></tr>
			<tr><td>Address Line 1:</td><td><input name="address_1" value="<?php echo $row['address_1']?>"/></td></tr>
			<tr><td>Address Line 2:</td><td><input name="address_2" value="<?php echo $row['address_2']?>"/></td></tr>
			<tr><td>Address Line 3:</td><td><input name="address_3" value="<?php echo $row['address_3']?>"/></td></tr>
			<tr><td>City</td><td><input name="city" value="<?php echo $row['city']?>"/></td></tr>
			<tr><td>State</td><td><input name="state" value="<?php echo $row['state']?>"/></td></tr>
			<tr><td>Pincode</td><td><input name="pincode" value="<?php echo $row['pincode']?>"/></td></tr>
			<tr><td><input type="submit" name="submit_save" value="Save"/></td></tr>
			</form>
		</table>

		<?php
		}
	}

}
?>

</body>
</html>