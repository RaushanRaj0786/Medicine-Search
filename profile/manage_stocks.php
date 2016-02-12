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
#manage_view{
	position: absolute;
	top: 60px;
	width: 500px;
	left: 50%;
	margin-left: -250px;
	height: 100px;
	background-color: #fff;
	border: 1px solid black;

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

</style>
</head>
<body>
<div id="bodysub" class="bodysub">


<?php
include('top_header.php');
if(isset($_SESSION['username'])){
	if($_SESSION['user_type'] == 2){
		if(isset($_POST['manage'])){
			include('../conn.php');
			?>
			<div id="manage_view"><!--MAnage division -->

			<?php
			if($_POST['manage_type'] ==1){
				?>
					<div style="position:absolute; bottom:10px; left:50px; height:40px;width:175px;background-color:#ccc;"><p>Manage current Stock</p></div>
					<form style="position:absolute;  bottom:10px; right:50px; height:40px;width:175px;" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
					<input type="hidden" name="manage_type" value="2"/>
					<input type="hidden" name="shop_id" value="<?php echo $_POST['shop_id']?>"/>
					<input type="submit" style="position:absolute; left:0px; top:0px;width:100%;height:100%;" name="manage" value="Add New Items">
					</form>

				<?php
			}else{
				?>
					<div style="position:absolute; bottom:10px; right:50px; height:40px;width:175px;background-color:#ccc;"><p>Add New Items</p></div>
					<form style="position:absolute;  bottom:10px; left:50px; height:40px;width:175px;" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
					<input type="hidden" name="manage_type" value="1"/>
					<input type="hidden" name="shop_id" value="<?php echo $_POST['shop_id']?>"/>
					<input type="submit" style="position:absolute; left:0px; top:0px;width:100%;height:100%;" name="manage" value="Manage Stocks">
					</form>
				<?php
			}
			?>
			</div><!--MAnage division ends...-->
			<?php
			if($_POST['manage_type'] ==1){
				$store_id= $_POST['shop_id'];
				$query = "select id,name,brand,cost,description from availability,medicine where store_id='$store_id' and medicine.id = availability.medicine_id order by name";
				$result_q = mysqli_query($connection,$query) OR die(mysqli_error($connection));

				?>
				<table>
				<tr><th>Medicine Name</th><th>Brand</th><th>Cost</th><th>Description</th><th>Stock Finished</tr>
				<form method="post" action="delete_test.php">
				<?php
				while($row = mysqli_fetch_array($result_q)){
					?>
					<tr>
					<td><?php echo $row['name'];?></td>
					<td><?php echo $row['brand'];?></td>
					<td><?php echo $row['cost']?></td>
					<td><?php echo $row['description']?></td>
					<td><input type="checkbox" name="delete_medi[]" value="<?php echo $row['id']?>"> Delete It</td>
					<input type="hidden" name="store_id" value="<?php echo $_POST['shop_id']?>"/>
					</tr>
					

					<?php
				}
				?>
				<tr><td><input type="submit" name="delete_them" value="Delete Them"></td></tr>
				</form>
				</table>
				<?php
			}else{
				$store_id= $_POST['shop_id'];
				$query = "select id,name,brand,cost,description from medicine where id not in(select medicine_id from availability where store_id='$store_id') order by name";
				$result_q = mysqli_query($connection,$query) OR die(mysqli_error($connection));

				?>
				<table>
				<tr><th>Medicine Name</th><th>Brand</th><th>Cost</th><th>Description</th><th>Stock Finished</tr>
				<form method="post" action="delete_test.php">
				<?php
				while($row = mysqli_fetch_array($result_q)){
					?>
					<tr>
					<td><?php echo $row['name'];?></td>
					<td><?php echo $row['brand'];?></td>
					<td><?php echo $row['cost']?></td>
					<td><?php echo $row['description']?></td>
					<td><input type="checkbox" name="add_medi[]" value="<?php echo $row['id']?>"> Add It</td>
					<input type="hidden" name="store_id" value="<?php echo $_POST['shop_id']?>"/>
					</tr>
					

					<?php
				}
				?>
				<tr><td><input type="submit" name="add_them" value="Add Them"></td></tr>
				</form>
				</table>
				<?php
			}






		}
	}
	
}


?>
</div>
</body>
</html>