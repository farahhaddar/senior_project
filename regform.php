
   <?php 
   require_once "connection.php";
   session_start();
   
  
               $name_error = $email_error = $tel_error=$gender_error=$age_error= "";
               $fullname  =$age= $email = $gender= $tel= "";
               
               if (isset($_POST['submit'])) 
               {
                $id=$_POST['event_id'];
                $_SESSION['id']=$id;
                
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
                   
                 
                 if (empty($_POST["age"])) 
                 {
                   $age_error = "* Age name is required";
                  
                 } else 
                 {
                   $age = test_input($_POST["age"]);
                 }
               
                 if (empty($_POST["gender"]))
                 {
                   $gender_error = "* Gender is required";
                   
                 } else 
                 {
                   $gender = test_input($_POST["gender"]);
                  
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
                     
                 
                
                }if( empty($tel_error) && empty($name_error) && empty($email_error)&& empty($gender_error)&& empty($age_error)){
                
                 
                 $sql="INSERT INTO event_regestrations( full_name, gender, email, phone_nb, age, event_id) VALUES ( '$fullname' ,'$gender','$email','$tel','$age','$id')";
                 $r=mysqli_query($con,$sql);
                 
                 if($r){
                    $_SESSION['r']="Successfully Registered! Cann't Wait To Meet You!"; 
                 }
                }else{
                    $_SESSION['t']=$tel_error;
                    $_SESSION['g']=$gender_error;
                    $_SESSION['a']=$age_error;
                    $_SESSION['e']=$email_error;
                    $_SESSION['n']=$name_error;
                
                }
               function test_input($data) {
                 $data = trim($data);
                 $data = stripslashes($data);
                 $data = htmlspecialchars($data);
                 return $data;
               }
               $id=$_SESSION["id"];
              
               header("location:desE.php?card=$id");
               ?>
















