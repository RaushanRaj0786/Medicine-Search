<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<script>
function validateForm() {
    var x = document.forms["myform"]["name"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
}

function validateForm() {
    var y = document.forms["myform"]["pincode"].value;
    if (y == null || y == "") {
        alert("password must be provided for security");
        return false;
    }

function validateForm() {
    var y = document.forms["myform"]["address1"].value;
    if (y == null || y == "") {
        alert("password must be provided for security");
        return false;
    }


function validateForm() {
    var y = document.forms["myform"]["number"].value;
    if (y == null || y == "") {
        alert("password must be provided for security");
        return false;
    }

}

</script>
	
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
th, td{
	max-width: 100px;
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
#add_new{
	position: absolute;
	left: 50%;
	top: 100px;
	width: 150px;
	margin-left: -75px;
	background:#5CCD00;
	background:-moz-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#5CCD00),color-stop(100%,#4AA400));
	background:-webkit-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	background:-o-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	background:-ms-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	background:linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#5CCD00', endColorstr='#4AA400',GradientType=0);
	padding:10px 0px;
	color:#fff;
	font-family:'Helvetica Neue',sans-serif;
	font-size:16px;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border:1px solid #459A00
}
</style>
</head>
<body>
<?php
include('top_header.php');
if(isset($_SESSION['username'])){
	if($_SESSION['user_type'] == 2){
		include('../conn.php');
		$modi_id = $_POST['shop_id'];
		?>
		<div id="add_new">
			<a href="#">Add new Store</a>
		</div>
		<?php

		$owner_id = $_SESSION['user_id'];
		$query = "select * from owns,store where owner_id ='$owner_id' and store.id= owns.store_id";
		$result = mysqli_query($connection,$query);
		if(mysqli_num_rows($result)==0){
			echo " no store is yet added";
			
		}else{
		?>
		<table>
			<tr><th>Shop Number</th><th>Address Line 1</th><th>Address Line 2</th><th>City</th><th>State</th><th>Pin Code</th>
			<th>Opening Time</th><th>Closing Time</th><th>Off Day</th><th>Modify Details</th></tr>
			<?php
			while($row = mysqli_fetch_array($result)){
				if($modi_id != $row['id']){
				?>
				<tr><td><?php echo $row['shop_number']?></td>
				<td><?php echo $row['address_1']?></td>
				<td><?php echo $row['address_2']?></td>
				<td><?php echo $row['city']?></td>
				<td><?php echo $row['state']?></td>
				<td><?php echo $row['pin_code']?></td>
				<td><?php echo $row['opening_time']?></td>
				<td><?php echo $row['closing_time']?></td>
				<td><?php echo $row['off_day']?></td>
				<form method="post" action="modify.php">
				<input type="hidden" name="shop_id" value="<?php echo $row['id']?>"/>
				<td><input type="submit" class="modify" name="modify" value="Modify"/></td>
    </form>
				</tr>

				<?php
				}else{
					?>

					
					<form method="post" action="save.php">
					<input type="hidden" name="shop_id" value="<?php echo $modi_id?>"/>
					<tr><td><input name="shop_number" value="<?php echo $row['shop_number']?>" /></td>
					<td><input name="address_1" value="<?php echo $row['address_1']?>" /></td>
					<td><input name="address_2" value="<?php echo $row['address_2']?>" /></td>
					<td><input name="city" value="<?php echo $row['city']?>" /></td>
					<td><input name="state" value="<?php echo $row['state']?>" /></td>
					<td><input name="pincode" value="<?php echo $row['pin_code']?>" /></td>
					<td><input name="opening_time" value="<?php echo $row['opening_time']?>" /></td>
					<td><input name="closing_time" value="<?php echo $row['closing_time']?>" /></td>
					<td><input name="Off-day" value="<?php echo $row['off_day']?>" /></td>

					<td><input type="submit" name="modify" value="Save"></td></tr>
					</form>


					<?php
				}
			}
			?>
		</table>




		<?php
	}
	}
}


?>
</body>
</html>