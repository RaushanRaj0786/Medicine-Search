<?php session_start();?>
<!DOCTYPE html>
<html>
<head>

  <title>Medi 24x7 Login</title>


  <style type="text/css">
input,select
{
  position: absolute;
  left: 0px;
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width:100%;
  height: 40px;
  padding-left: 4px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
}
.submit{
  position: absolute;
  top: 300px;
  left:100px;
  width: 100px;
}
select{
  top: 100px;
}
input[type=text]{
  top: 160px;
}
input[type=password]{
  top: 220px;
}

input:focus
{

  border-color: #51a7e8;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1),0 0 5px rgba(81,167,232,0.5);
  outline: none;
}
input[type=text]{
}
form{

  position:absolute;
  width: 300px;
  left: 50px;
  top:0px;
  margin: auto;
  
  

}
.bodysub{
  position:relative;
  width: 400px;
  /*top: 100px;*/
  background-color: rgb(225,225,225);
  height: 400px;
  /*left: 50%;*/
  
  margin:auto;
  /*margin-left: -200px;
  */
}

#submit {
    
    border-radius:6px;
    background-color: rgb(200,0,0);
    color: #fff;
    border:1px solid #3079ed
    width: 220px;
    margin-top: 10px;
    font-family: 'Oswald';
    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
    border:none;
}
p{
  
  margin-top: 1px;
  margin-bottom: 1px;

}
</style>
</head>

<?php
if(isset($_POST['submit']))
{          
        include('../conn.php');
        $user_type  = mysqli_real_escape_string($connection,$_POST['user_type']);
        $username   = mysqli_real_escape_string($connection,$_POST['username']);
        $pass   = mysqli_real_escape_string($connection,$_POST['password']);
        $password = md5($pass);
        
        if($user_type == 1){
            $table = "customer";
        }elseif ($user_type ==2) {
            $table = "owner_info";
            # code...
        }else{
            $table = "pharma_company";
        }
        $query = "select id from ".$table." where username='$username' and password='$password'";
        $result = mysqli_query($connection,$query);
        $numResults = mysqli_num_rows($result);
        if($numResults == 0){
          echo "Username and password combination not found..";
          echo '<a href="index.php">Try Again</a>';
        }else{
            $id_user =0;
            while ($row_id = mysqli_fetch_array($result)) {
                $id_user = $row_id['id'];
            }
          echo "Login Successful";
            $_SESSION['username'] = $username; 
            $_SESSION['user_id'] = $id_user;
            if($user_type == 1){
                $_SESSION['user_type']=1;
            }elseif ($user_type ==2) {
                $_SESSION['user_type']=2;
            # code...
            }else{
                $_SESSION['user_type']=3;
        }
              echo "You have been logged in successfully<br>";
              echo "please wait....";
              header('refresh: 2; url=../index.php');
              exit;
        }
    
}
 
?>

<body>
  <!-- Login and Signup forms -->
  <br><br>
<center><img src="../logo.jpg" alt="Logo Image" height="50px" width="250px" "></center>
<div align="center"><h1> Sign in to continue to Medi 24x7</h1></div>

<div class="bodysub" align="center">
<center><img src="../signup/user.png" height="50px" width="50px"></center><br>
    <form name="myform" action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <p><select name="user_type" id="user_type" required >
      <option selected="selected" value="" disabled>Select User type</option>
      <option value="1">Customer</option>
      <option value="2">Store Owner</option>
      <option value="3">Pharma Company</option>
    </select>
    <p><input id="username" name="username" type="text" placeholder="Username" required>
    <p><input id="password" name="password" type="password" placeholder="Password" required>
    <p><input id="submit" type="submit" class="submit" name="submit" value="Login" /></p>
  </form>

  </div>

</body>
</html>