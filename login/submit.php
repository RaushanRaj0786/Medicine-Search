<?php session_start();?>
<?php 


if(isset($_POST['submit']))
{          
        include('conn.php');
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
            echo '<a href="../index.php">Get Back</a>';
        }
    
}
 
?>