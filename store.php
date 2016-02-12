<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	
	.layout{
		position:absolute;
		width: 1000px;
		top: 100px;
		left: 50%;
		margin-left: -500px;
		border: 1px solid black;
		background: #eee;
	}



	table {
    margin-top: 30px;
    margin-bottom: 30px;
}

td{
	text-align: center;
	background: #ccc;
	padding: 3px;
}

th {
    background-color: rgb(242,142,142);
    color: black;
    text-align: left;
    padding: 4px;
}

form{
	margin-bottom: 30px;
}
		
	</style>
</head>
<?php

include('conn.php');
$shop_id = $_GET['store_id'];
$query = mysqli_query($con,"select * from store where id='$shop_id'") OR die(mysqli_error($connection));
while($row = mysqli_fetch_array($query)){
$name = $row['name'];
$shop_num = $row['shop_number'];
$add_1 = $row['address_1'];
$add_2 = $row['address_2'];
$city = $row['city'];
$state = $row['state'];
$pin = $row['pin_code'];
$avg = $row['average_rating'];
$num_raters = $row['num_raters'];
$open = $row['opening_time'];
$close = $row['closing_time'];
$off = $row['off_day'];

}
?>

<body>
<div class="layout">
	<?php 
	include('top_header.php');
	$current ="";

	if(isset($_SESSION['user_type'])){
		if($_SESSION['user_type'] ==1){
			$user_id = $_SESSION['username'];
			$re = mysqli_query($con,"select ratings from ratings where store_id='$shop_id' and customer_id='$user_id'") OR die(mysqli_error($connection));
			if(mysqli_num_rows($re) == 0){
				$current =0;
			}else{
				while($row1 = mysqli_fetch_array($re)){
					$current = $row1['ratings'];
					

				}
			}
			?>

<center>
<h3>Store Details : </h3>
<table border="2">
	<tr><th>Name : </th><td><?php echo $name; ?></td></tr>
	<tr><th>Shop Number :</th><td><?php echo $shop_num; ?></td></tr>
	<tr><th>Address 1 : </th><td><?php echo $add_1; ?></td></tr>
	<tr><th>Address 2 :</th><td><?php echo $add_2; ?></td></tr>
	<tr><th>City : </th><td><?php echo $city; ?></td></tr>
	<tr><th>State : </th><td><?php echo $state; ?></td></tr>
	<tr><th>Pin : </th><td><?php echo $pin; ?></td></tr>
	<tr><th>Average Rating : </th><td><?php echo $avg; ?></td></tr>
	<tr><th>Number of Ratings : </th><td><?php echo $num_raters; ?></td></tr>
	<tr><th>Opening Time : </th><td><?php echo $open; ?></td></tr>
	<tr><th>Closing Time : </th><td><?php echo $close; ?></td></tr>
	<tr><th>Off day : </th><td><?php echo $off; ?></td></tr>
</table>
</center>




<p>Save your Rating for this Store ...</p>

			<form action="rating.php" method="post" >
				<input name="range" type="range" min="1" max="5" value="<?php echo $current?>" step="1" onchange="showValue(this.value)" required/>
<span id="range"><?php echo $current ?></span>
<input type="hidden" name="shop_id" value="<?php echo $shop_id?>">
<input type="submit" value="Save" name="submit">
			</form>

			<script type="text/javascript">
function showValue(newValue)
{
	document.getElementById("range").innerHTML=newValue;
}
</script>
			<?php
		}
		else
			echo "Please Login as Customer ...<br>";
	}
	else
		echo "Please Login to Rate ...<br>";

	?>
</div>

</body>
</html>