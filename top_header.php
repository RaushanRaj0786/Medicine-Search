<!DOCTYPE>
<html>
<head>
<title>Untitled Document</title>
<link href="cs/ui.css" rel="stylesheet">
<style>
body{
  text-align:center;
}
.topheader  {
  width:100%;
  box-shadow:5px 2px 3px #111;
  position:fixed;
  z-index:50;
  background-color:white;
  left:0px;
  height:70px;
  top:0px;  
}



.login{
	position: absolute;
	top: 10px;
	width: 100px;
	height: 50px;
	right: 100px;
}
.signup{
		position: absolute;
	top: 10px;
	width: 100px;
	height: 50px;
	right: 0px;

}
a{
	text-decoration: none;
	color: black;

}
#search_form{
	position: absolute;
	left: 150px;
	top: 10px;
}
#autocomplete{position: absolute;
		left: 0px;
		top: 0px;
		border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width:600px;
  max-height: 28px;
  padding: 4px 20px 4px 8px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
	}

	#city{
		position: absolute;
		left: 630px;
		top: 0px;
		height: 28px;
		width: 130px;

	}
	#submit_form{
		position: absolute;
		left: 760px;
		top: 0px;
		height: 28px;
		width: 50px;
	}


</style>

</head>

<body>

<div id="topheader" class="topheader">
<?php
include('conn.php');
$city_q = "select distinct(city) from store";
$city_result = mysqli_query($dbc,$city_q) OR die('error extracting city');

$m="";$c="";

if(isset($_SESSION['search_name'])){
	$m = $_SESSION['search_name'];
}
if(isset($_SESSION['search_city'])){
	$c = $_SESSION['search_city'];
}
?>
<form action="result.php" method="post" id="search_form">
	<input name="medi_name" id="autocomplete" type="text" value="<?php echo $m ?>" required/>
	<select name="city" id="city" required>
	<option disabled value="">Select City</option>
	<?php
	while($row = mysqli_fetch_array($city_result)){
		if($row['city'] == $c){
			echo "<option selected> ".$row['city']."</option>";
		}else{
			echo "<option> ".$row['city']."</option>";
		}

	}
	?>
	</select>
	<input type="submit" name="search" id="submit_form" value="GO" class="myButton"/>
</form>


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
</div>
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
