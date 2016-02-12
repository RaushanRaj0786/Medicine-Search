<?php session_start();?>
<!DOCTYPE html>
<html>
<head>

 <script>
function validateForm() 
{
    var x = document.forms["myform"]["Brand Name"].value;
    if (x == null || x == "") 
    {
        alert("Name must be filled out");
        return false;
    }
}

function validateForm()
 {
    var y = document.forms["myform"]["Name of the Medicine"].value;
    if (y == null || y == "")
    {
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
	if($_SESSION['user_type'] == 3){
    include('../conn.php');
    $test_array = array();
    $aa=0;
      if(isset($_POST['submit_medi'])){
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $brand= mysqli_real_escape_string($connection,$_POST['brand']);
        $des = mysqli_real_escape_string($connection,$_POST['des']);
        $cost = mysqli_real_escape_string($connection,$_POST['cost']);
        $test = "select id from medicine where name='$name' and brand='$brand' and description='$des' and cost='$cost'";
        $re1 = mysqli_query($connection,$test) OR die(mysqli_error($connection));
        if(mysqli_num_rows($re1) >0){
          echo "This Specific Medicine is already present ...";
          echo "We are redirecting you to your profile";
          header('refresh: 2; url=../index.php');

        } 
        $query ="insert into medicine values(0,'$name','$brand','$cost','$des',0)";
        $result = mysqli_query($connection,$query) OR die(mysqli_error($connection));
        echo "Medicine Added";
        $q_n = "select name,brand,cost from medicine";
        $re = mysqli_query($connection,$q_n) OR die(mysqli_error($connection));
        while($row = mysqli_fetch_array($re)){
          $test_array[$aa] = $row['name']." :: ".$row['brand']." :: ".$row['cost'];

          $aa = $aa+1;
        }
        $fp = fopen('file.csv', 'w');
        fputcsv($fp, $test_array);
        fclose($fp);

        echo "please wait....";
        header('refresh: 2; url=../index.php');
      }

    ?>



    <table>

     <!-- <form name="myform" action="submit.php" onsubmit="return validateForm()" method="post"> -->

      <form name="myform" action="<?php echo $_SERVER['PHP_SELF']?>"  onsubmit="return validateForm()" method="post">
      <tr>*<td>Name of the Medicine:</td><td><input name="name" required/></td></tr>
      <tr>*<td>Brand Name:</td><td><input name="brand" required/></td></tr>
      <tr>*<td>Description:</td><td><textarea name="des"></textarea></td></tr>
      <tr>*<td>Cost:</td><td><input name="cost" required/></td></tr>
      <tr><td><input type="submit" name="submit_medi" value="Add Meidicine"/></td></tr>
      </form>
    </table>


<?php
  }
}
?>

</div>
</body>
</html>