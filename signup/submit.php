<?php 

if(isset($_POST['submit'])){
        include('../conn.php');
    
        $user_type  = mysqli_real_escape_string($connection,$_POST['user_type']);
        $name       = mysqli_real_escape_string($connection,$_POST['name']);
        $username   = mysqli_real_escape_string($connection,$_POST['username']);
        $email      = mysqli_real_escape_string($connection,$_POST['email']);
        $password   = mysqli_real_escape_string($connection,$_POST['password']);
        
        if($user_type == 1){
            $table = "customer";
        }elseif ($user_type ==2) {
            $table = "owner_info";
            # code...
        }else{
            $table = "pharma_company";
        }
        $query = "SELECT email FROM ".$table." where email='".$email."'";
        $result = mysqli_query($connection,$query) or die(mysqli_error($connection));
        $numResults = mysqli_num_rows($result);
        $qu = mysqli_query($connection,"SELECT username FROM ".$table." where username='".$username."'")  or die(mysqli_error($connection));
        if(mysqli_num_rows($qu) >0){
            echo "username already present...";
            header('refresh: 2; url=../index.php');
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
        {
            $message =  "Invalid email address please type a valid email!!";
            echo $message;
        }
        elseif($numResults>0)
        {
            $message = $email." Email already exist!!";
            echo $message;
        }
        else
        {
            $qu="insert into ".$table."(name,username,email,password) values('$name','$username','$email',md5('$password'))";
            $re = mysqli_query($connection,$qu) OR die(mysqli_error($connection));
            $message = "Signup Sucessfully!!";
            echo $message;
        }
         echo "please wait....";
              header('refresh: 2; url=../index.php');
    
}
 
?>