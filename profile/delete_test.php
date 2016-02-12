<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">


</style>
</head>
<body>
<div id="bodysub" class="bodysub">


<?php
if(isset($_SESSION['username'])){
	if($_SESSION['user_type'] == 2){
		include('../conn.php');
		if(isset($_POST['delete_them'])){
			$shop_id = $_POST['store_id'];
			if(!isset($_POST['delete_medi'])){
				echo " No Medicine is selected";
				header('refresh: 2; url=manage_stores.php');
				exit;
			}
			$temp = $_POST['delete_medi'];
			for($i=0;$i<sizeof($temp);$i=$i+1){
				$query ="delete from availability where store_id='$shop_id' and medicine_id ='$temp[$i]' ";
				$result = mysqli_query($connection,$query) OR die(mysqli_error($connection));
			}
			echo "successfully deleted";
		}
		if(isset($_POST['add_them'])){
			$shop_id = $_POST['store_id'];
			if(!isset($_POST['add_medi'])){
				echo " No Medicine is selected";
				header('refresh: 2; url=manage_stores.php');
				exit;
			}
			$temp = $_POST['add_medi'];
			for($i=0;$i<sizeof($temp);$i=$i+1){
				$query ="insert into availability values('$temp[$i]','$shop_id') ";
				$result = mysqli_query($connection,$query) OR die(mysqli_error($connection));
			}
			echo "successfully added";
		}
		echo '<a href="index.php">get back to profile page</a>';
	}
}
?>
</div>
</body>
</html>