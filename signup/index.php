<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
  <script>
function validateForm() 
{
    var x = document.forms["myform"]["name"].value;
    if (x == null || x == "") 
    {
        alert("Name must be filled out");
        return false;
    }
}

function validateForm()
 {
    var y = document.forms["myform"]["email"].value;
    if (y == null || y == "")
    {
        alert("email must be provided ");
        return false;
    }
}

function validateForm()
 {
    var y = document.forms["myform"]["password"].value;
    if (y == null || y == "")
    {
        alert("password must be provided for security");
        return false;
    }
}

</script>
  <title></title>


  <style type="text/css">
input[type=text],input[type=password],select
{
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width:200px;
  min-height: 28px;
  padding: 4px 20px 4px 8px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
}
input[type=text]:focus,input[type=password]:focus
{

  border-color: #51a7e8;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1),0 0 5px rgba(81,167,232,0.5);
  outline: none;
}
.test{
  position:relative;
  background-color: rgb(225,225,225);
  width: 300px;
  top: 10px;
  height: 300px;
  margin: auto; 
}
form{

  position:absolute;
  
  width: 220px;
  left: 40px;
  
  top: 50px;
 
  
}
p{
  
  margin-top: 1px;
  margin-bottom: 1px;

}

#submit {
    background-color: rgb(200,0,0);
    border-radius:6px;
    color: #fff;
    width: 220px;
    margin-top: 10px;
    font-family: 'Oswald';
    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
    border:none;
}
</style>
</head>
<body>
  <!-- Login and Signup forms -->      
<br><br>
    <center><img src="../logo.jpg" alt="Logo Image" height="50px" width="250px" "></center>
    
    <div align="center"><h1> Create your Medi 24x7 Account</h1></div>
    <div class="test">
    <center><img src="user.png" height="50px" width="50px"></center>
    <form name="myform" action="submit.php" onsubmit="return validateForm()" method="post">
    <p><select name="user_type" style="margin-top:10px"  id="user_type" required>
      <option selected="selected" value="" disabled="disabled">Select User type</option>
      <option value="1">Customer</option>
      <option value="2">Store Owner</option>
      <option value="3">Pharma Company</option>
    </select>
    <p><input id="name" name="name" type="text" placeholder="Name" required></p>
    <p><input id="username" name="username" type="text" placeholder="Username" required>
    <p><input id="email" name="email" type="text" placeholder="Email" required></p>
    <p><input id="password" name="password" type="password" placeholder="Password" required>
    <p><input id="submit" type="submit" name="submit" value="Signup" /></p>
  </form>
  </div>


</body>
</html>