<?php require_once 'auth.php'?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
 
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

body{
  /* The image used */
  background-image: url("img/logincover.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  max-height:10px;
}

h1{
    text-align:center;
    color:white;
    font-weight:bolder;
    font-size:60px;
    margin:70px 0px;
}
/* Add styles to the form container */
/* Add styles to the form container */
.container {
  margin: auto;
  width: 400px;
  height:300px;
  padding: 16px;
  margin-top:160px;
  /* background-color: rgb(255,255,200,0.2); */
   
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: lightgray;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
label{
  font-size:large;
}
/* Set a style for the submit button */
.btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.err{
    color:red;
    font-style: italic;
    font-size: 16px;
}

.btn:hover {
  opacity: 1;
}
</style>
</head>
<body>
<h1> WELCOME !</h1> 
<div class="container ">
<form id="login" method="post" action="auth.php">
  
            <label for="username">Username:</label> <span class='err'><?php if (isset($_SESSION['name'])) {echo $_SESSION['name'] ; unset($_SESSION['name'] );}?><br></span>
            <input id="username" name="username" type="text" required><br>
            <label for="password">Password:</label><span class='err'><?php if (isset($_SESSION['name1'])) {echo $_SESSION['name1'] ; unset($_SESSION['name1'] );}?><br></span>
            <input id="password" name="password" type="password" required>                    
            <br />
            <input type="submit"  class="btn" name="login" value="Login">
        </form>

    
        </div>



</body>
</html>
