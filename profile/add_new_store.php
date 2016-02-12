<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  
 

	<title></title>
	<style type="text/css">
	.bodysub{
  width:1000px;
  position:relative;
  margin-left:auto;
  margin-right:auto;
}

	table {
	text-align:center;
	position:absolute;
	left:0px;
	top:350px;
    width:100%;
}
a{
	text-decoration: none;
	color: #111;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table tr:nth-child(even) {
    background-color: #eee;
}
table tr:nth-child(odd) {
   background-color:#fff;
}
table th	{
    background-color: black;
    color: white;
}

</style>
</head>
<body>
<div id="bodysub" class="bodysub">
<?php
//include('top_header.php');
if(isset($_SESSION['username'])){
	if($_SESSION['user_type'] == 2){
		if(isset($_POST['submit'])){
			include('../conn.php');
			$name = $_POST['name'];
			$number = $_POST['number'];
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$pincode = $_POST['pincode'];
			$opening_time = $_POST['opening_time'];
			$closing_time = $_POST['closing_time'];
			$off = $_POST['offday'];

			$query="insert into store values(0,'$name','$number','$address1','$address2','$city','$state','$pincode',0,0,'$opening_time','$closing_time','$off',0,0,0,0,0,0,0)";
			$result = mysqli_query($connection,$query) OR  die("aseasg");
			$tq="select id from store where name = '$name' and shop_number = '$number' and address_1 = '$address1' and address_2 = '$address2' and city = '$city' and state = '$state' and pin_code = '$pincode' and opening_time = '$opening_time' and closing_time = '$closing_time' and off_day = '$off'";
			$q = mysqli_query($connection,$tq) OR  die('sad');
			$store_id="";
			while($row= mysqli_fetch_array($q)){
				$store_id = $row['id'];
			}
			$owner_id = $_SESSION['user_id'];
			$addq = mysqli_query($connection,"insert into owns values('$store_id','$owner_id')") OR  die(mysqli_error($connection));
			echo " your Store is added";
			echo "Please wait...";
			header('refresh: 2; url=manage_stores.php');
				exit();

		}

?>
		<table><form name="myform" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<tr><td>Name of the Shop:</td><td><input name="name" required/></td></tr>
			<tr><td>Shop Number:</td><td><input name="number" required/></td></tr>
			<tr><td>Address Line 1:</td><td><textarea name="address1" required></textarea></td></tr>
			<tr><td>Address Line 2:</td><td><textarea name="address2" required></textarea></td></tr>
			<tr><td>City:</td><td><input name="city" required/></td></tr>
			<tr><td>State:</td><td><input name="state" required/></td></tr>
			<tr><td>Pin Code:</td><td><input name="pincode" required/></td></tr>
			<tr><td>Opening Time:</td><td><input name="opening_time" required/></td></tr>
			<tr><td>Closing Time:</td><td><input name="closing_time"required/></td></tr>
			<tr><td>Off Day:</td><td><input name="offday" required/></td></tr>
			<tr><td><input type="submit" name="submit" value="Add Store"/></td></tr>
			</form>
		</table>

<?php

	}
}

?>

</div>
</body>
</html>