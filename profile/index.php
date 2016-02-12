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
	$query ="select * from ".$table." where id='$id'";
	$result = mysqli_query($connection,$query) OR die(mysqli_error($connection));
	if($_SESSION['user_type'] == 1){
		while($row = mysqli_fetch_array($result)){
		?>
		<table>
			<tr><td>Name:</td><td><?php echo $row['name']?></td></tr>
			<tr><td>Username:</td><td><?php echo $row['username']?></td></tr>
			<tr><td>Email"</td><td><?php echo $row['email']?></td></tr>
		</table>

		<?php
		}
	}elseif($_SESSION['user_type'] == 2){
		while($row = mysqli_fetch_array($result)){
		?>
		<table>
		<tr><td><div><a href="manage_stores.php">Manage Stores</a></div></td><td><div><a href="edit_profile.php">Edit Profile</a></div></td></tr>
			<tr><td>Name:</td><td><?php echo $row['name']?></td></tr>
			<tr><td>Username:</td><td><?php echo $row['username']?></td></tr>
			<tr><td>Email"</td><td><?php echo $row['email']?></td></tr>
			<tr><td>Address Line 1:</td><td><?php echo $row['address_1']?></td></tr>
			<tr><td>Address Line 2:</td><td><?php echo $row['address_2']?></td></tr>
			<tr><td>Address Line 3:</td><td><?php echo $row['address_3']?></td></tr>
			<tr><td>City</td><td><?php echo $row['city']?></td></tr>
			<tr><td>State</td><td><?php echo $row['state']?></td></tr>
			<tr><td>Pincode</td><td><?php echo $row['pincode']?></td></tr>
		</table>

		<?php
		}
	}else{
		while($row = mysqli_fetch_array($result)){
		?>
		<table>
			<tr><td>Pharma Company Name:</td><td><?php echo $row['name']?></td></tr>
			<tr><td>Representative Username:</td><td><?php echo $row['username']?></td></tr>
			<tr><td>Email</td><td><?php echo $row['email']?></td></tr>
			<tr><td><a href="add_new_medi.php">Add New Medicine</a></td></tr>
		</table>

		<?php
		}
	}

}
?>

</body>
</html>