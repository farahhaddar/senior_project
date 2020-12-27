
   <?php 
   require_once "connection.php";
   session_start();
               $name_error = $email_error = $tel_error=$gender_error=$age_error= "";
               $fullname  =$age= $email = $gender= $tel= "";
               
               if (isset($_POST['submit'])) 
               {
            
                 if (empty($_POST["fname"])) 
                 {
                   $name_error = "* Name is required";
                   
                 } else 
                 {
                   $fullname = test_input($_POST["fname"]);
                   // check if name only contains letters and whitespace
                   if (!preg_match("/^[a-zA-Z-' ]*$/",$fullname))
                    {
                     $name_error = "* Only letters and white space allowed";
                    
                   }
                 }
                 
                 if (empty($_POST["email"])) 
                 {
                   $email_error = "* Email is required";
                 
                 } else 
                 {
                   $email = test_input($_POST["email"]);
                   // check if e-mail address is well-formed
                   if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                     $email_error = "* Invalid email format";
                  
                   }
                 }
                   
               
                 if (empty($_POST["comment"]))
                 {
                   $comment_error = "* Your Comment is required";
                   
                 } else 
                 {
                   $comment = test_input($_POST["comment"]);
                  
                 }
                    if(empty($_POST['tel']))
                    {
                     $tel_error=" * telephone number is required";
                     
                    }else
                    {
                     $tel=test_input($_POST['tel']);
                      if (!preg_match('/^[0-9]*$/',$_POST['tel']))
                      {
                       $tel_error="*  tel must be number ";
                       
                     }
                    }
                     
                 
                
                }if( empty($tel_error) && empty($name_error) && empty($email_error)&& empty($comment_error)){
                
                 $sql="INSERT INTO contacts( `name`,  email, phone_number, comment) VALUES ( '$fullname' ,'$email','$tel','$comment')";
                 $c=mysqli_query($con,$sql);
                 
                 if($c){
                    $_SESSION['c']="Successfully sent! WE Will Get Back To You Soon!"; 
                 }
                }else{
                    $_SESSION['t']=$tel_error;
                    $_SESSION['txt']=$comment_error;
                    $_SESSION['e']=$email_error;
                    $_SESSION['n']=$name_error;
                
                }
               function test_input($data) {
                 $data = trim($data);
                 $data = stripslashes($data);
                 $data = htmlspecialchars($data);
                 return $data;
               }
               
               
               header("Location:index.php?contact=true");
               ?>