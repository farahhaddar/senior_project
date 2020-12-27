<?php
require_once 'connection.php';


if(isset($_POST['login']))
{
    
$sql = "SELECT * FROM admins";
$res = mysqli_query($con,$sql);
if($res)
{
if(mysqli_num_rows($res)>0)
{
    
    $admin = mysqli_fetch_assoc($res);

   

}
}
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
    $user=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);
   
    }else{
        header("Location:login.php");
    }

    if($user === $admin['email'])
    {
        
        if($password ===  $admin['password'])
        {
           
            $_SESSION['auth']="yes";
            
            header("Location:adminPanel.php");

        }else{
            $_SESSION['name1']="wrong password";
            header("Location:login.php");

        }

    }else{
        $_SESSION['name'] = "wrong email";
        header("Location:login.php");
    }
  



}





?>