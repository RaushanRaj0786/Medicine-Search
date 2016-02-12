<!DOCTYPE>
<html>
<head>
<title>Untitled Document</title>
<style>
body{
  text-align:center;
  background-image:url(../back.png);
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
a{
	text-decoration: none;
	color: black;

}


</style>

</head>

<body>

<div id="topheader" class="topheader">
<h1>MEDI 24x7</h1>



<?php
if(isset($_SESSION['username'])){
	echo '<div class="login"><a href="index.php">'.$_SESSION['username'].'</a></div>';
	echo '<div class="signup"><a href="../unset.php">Logout</a></div>';
}else{
?>
<div class="login"><a href="../login/index.php">Login</a></div>
<div class="signup"><a href="../signup/index.php">Sign Up</a></div>
<?php
}
?>
</div>


</body>
</html>
