<?php session_start();?>
<!DOCTYPE html>
<html>
<head>

	<title></title>
<link href="cs/ui.css" rel="stylesheet">
<style type="text/css">
	form{
		position: absolute;
		top: 45%;
		left: 50%;
		margin-left: -300px;
		width: 600px;

	}
	#city{
		position: absolute;
		left: 50%;
		width: 300px;
		margin-left: -150px;
		top: 80px;
	}
	#autocomplete{position: absolute;
		left: 0px;
		top: 0px;
		width: 100%;
		border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width:600px;
  min-height: 28px;
  padding: 4px 20px 4px 8px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
	}



	.myButton {
	-moz-box-shadow:inset 0px -1px 3px 0px #91b8b3;
	-webkit-box-shadow:inset 0px -1px 3px 0px #91b8b3;
	box-shadow:inset 0px -1px 3px 0px #91b8b3;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #768d87), color-stop(1, #6c7c7c));
	background:-moz-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
	background:-webkit-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
	background:-o-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
	background:-ms-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
	background:linear-gradient(to bottom, #768d87 5%, #6c7c7c 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#768d87', endColorstr='#6c7c7c',GradientType=0);
	background-color:#768d87;
	-moz-border-radius:9px;
	-webkit-border-radius:9px;
	border-radius:9px;
	border:1px solid #566963;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:16px;
	font-weight:bold;
	padding:8px 19px;
	text-decoration:none;
	text-shadow:0px -1px 0px #2b665e;
			position: absolute;
		left: 50%;
		top: 120px;
		width: 100px;
		margin-left: -50px;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #6c7c7c), color-stop(1, #768d87));
	background:-moz-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
	background:-webkit-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
	background:-o-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
	background:-ms-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
	background:linear-gradient(to bottom, #6c7c7c 5%, #768d87 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#6c7c7c', endColorstr='#768d87',GradientType=0);
	background-color:#6c7c7c;
}


.login{
	position: absolute;
	top: 20px;
	width: 100px;
	height: 50px;
	right: 100px;

}
.signup{
		position: absolute;
	top: 20px;
	width: 100px;
	height: 50px;
	right: 0px;

}
</style>
</head>
<body>
<?php
if(isset($_SESSION['username'])){
	echo '<div class="login"><a href="profile/index.php">'.$_SESSION['username'].'</a></div>';
	echo '<div class="signup"><a href="unset.php">Logout</a></div>';
}else{
?>
<div class="login"><a href="login/index.php">Login</a></div>
<div class="signup"><a href="signup/index.php">Sign Up</a></div>
<?php
}
?>





<?php
include('conn.php');
$city_q = "select distinct(city) from store";
$city_result = mysqli_query($dbc,$city_q) OR die('error extracting city');

?>
<img style="position:absolute; left:50%; margin-left:-232px; top:100px;" src="logo.jpg"/>
<form action="result.php" method="post">
	<input name="medi_name" id="autocomplete" type="text" placeholder="Enter Medicine name" required />
	<select name="city" id="city" required>
	<option selected="selected" disabled value="">Select City</option>
	<?php
	while($row = mysqli_fetch_array($city_result)){
		?>
		<option><?php echo $row['city']?></option>
		<?php
	}
	?>
	</select>
	<input type="submit" name="search" value="Search" class="myButton"/>
</form>




<script src="jquery/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.4/mootools-yui-compressed.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script>

    <?php
	$php_array = array();
    $file = fopen('profile/file.csv', 'r');
	while (($line = fgetcsv($file)) !== FALSE) {
  	//$line is an array of the csv elements
  		$php_array = $line;
	}
	
	fclose($file);

  
    ?>
    var availableTags = [<?php echo '"'.implode('","', $php_array).'"' ?>];
    








$( "#autocomplete" ).autocomplete({
	source: availableTags
});




</script>


</body>
</html>












