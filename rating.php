<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
include('conn.php');

	if(isset($_SESSION['user_type'])){
		if($_SESSION['user_type'] ==1){
			$user_id = $_SESSION['user_id'];
			if(isset($_POST['submit'])){
				$shop_id = $_POST['shop_id'];

				$rate = $_POST['range'];
				echo $rate;
				$re = mysqli_query($con,"select ratings from ratings where store_id='$shop_id' and customer_id='$user_id'") or die(mysqli_error($con));

				if(mysqli_num_rows($re) == 0){
						
					$r1 = mysqli_query($con,"insert into ratings values ('$shop_id','$user_id','$rate')") or die(mysqli_error($con));
					
					$r2 = mysqli_query($con,"select * from store where id='$shop_id'") or die(mysqli_error($con));


					while($rowa = mysqli_fetch_array($r2)){
						$avg = $rowa['average_rating'];
						$num_raters = $rowa['num_raters'];

					}
					$final = ($avg*$num_raters + $rate)/($num_raters+1);
					$nu = $num_raters+1;
					

					$r3 = mysqli_query($con,"update store set num_raters='$nu' where id='$shop_id'") or die(mysqli_error($con));
					$r4 = mysqli_query($con,"update store set average_rating='$final' where id='$shop_id'") or die(mysqli_error($con));
				}else{
					
					$current = "";
					while($temp = mysqli_fetch_array($re)){
						$current = $temp['ratings'];
					}
					$r1 = mysqli_query($con,"update ratings set ratings='$rate' where store_id='$shop_id' and customer_id='$user_id'") or die(mysqli_error($con));
					$r2 = mysqli_query($con,"select * from store where id='$shop_id'") or die(mysqli_error($con));
					while($rowa = mysqli_fetch_array($r2)){
						$avg = $rowa['average_rating'];
						$num_raters = $rowa['num_raters'];
					}
					$final = ($avg*$num_raters + $rate - $current)/$num_raters;
					$r3 = mysqli_query($con,"update store set average_rating='$final' where id='$shop_id'") or die(mysqli_error($con));


				}
				echo "Your ratings have been recorded..<br>";
				echo "please Wait...";
				header('refresh: 2; url=store.php?store_id='.$shop_id.'');

			}


			}

		
	}

	?>
</body>
</html>