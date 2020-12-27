<?php
require_once 'connection.php';
session_set_cookie_params(0);
if(!isset($_SESSION['auth']))      
{
    header("Location: login.php");
    exit();
}else{
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <link rel = "stylesheet" href="admin.css">
    <link rel="stylesheet" href="/css/all.css">
    <link href = 'https://fonts.googleapis.com/css?family=Architects Daughter' rel='stylesheet'>
    <link href = 'https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>
</head>



<body>






 <!--------------------------------------- header ------------------------------------->

<header>
  <div class = "header">
  <!-- logo -->
  
  <h1 id = "logo">Young Adventurers &#9829; </h1>
   <!-----------------------------------buttons---------------------------------->
   <button class="tablink" name="blog" onclick="openPage('blogs', this, 'white');" id="defaultOpen" >ALL BLOGS</button>
  <button class="tablink" name="event" onclick="openPage('events', this, 'white');" id="secondTab">ALL EVENTS</button>

 <!----------------------------------buttons------------------- --------->

  <!-- search button-->
  <div class = "search">

      <div id="bs">
      <form method="POST"  action="<?=$_SERVER['PHP_SELF']?>">
        <input type = "text" id="search" placeholder="Search By Name.." name="search">
        <button  name="bss" id="bss" type = "submit"><i class="fas fa-search"></i></button>
      </form>
      </div>
  </div>

  </div>
</header>
<!--------------------------------------- header ------------------------------------->


<!--------------------------------------- screen split------------------------------------->

<div class="split">

 <!-------------------------split screen dashboard aside----------------------------------->
    <div class = "split left">

      <div class="sidenav">
        <a href=" createBlog.php">  <i class="fas fa-sm fa-file-signature"></i>   Create Blog</a>
        <a href="createEvent.php"><i class="fas fa-sm fa-file-signature"> </i>  Create Event</a>
         <a href="allReg.php"><i class="fas fa-sm fa-users"></i>    All Register</a>
        <a href="contacts.php"> <i class="fas  fa-sm fa-address-book"></i>   Contacts </a>
        <a  href=" logout.php" ><i class="fas fa-sm fa-sign-out-alt"></i>   Logout </a>
      </div>

    </div>


  <!----------------- split right for blogs and events------------------------------->

 <div class = "split right">



 <!-- -----------blog content------------>
  
  <div id="blogs" class="tabcontent">

<!-- blog has been deleted -->
<br>

<div class="sucs"> 
<?php
 if (isset($_SESSION['b'])) 
 {
   echo $_SESSION['b'] ; 
   unset($_SESSION['b'] );
 }
?>
</div>
<!-- this file contain the read function  -->

 <?php include "readBlogs.php";?>

 </div>



 <!-------------event content----------->
  <div id="events" class="tabcontent">
 <br>
  <div class="sucs">
 <?php
if (isset($_SESSION['dele'])) {
    echo $_SESSION['dele'];
    unset($_SESSION['dele']);
}
?>
 </div>
  <?php include 'readEvents.php'?>

 </div>


</div>
<!--------------------------------------- screen split------------------------------------->




<!-- js functions for th event and blog buttons  -->
<script>

document.getElementById("defaultOpen").click();
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
 
}
 

// Get t<?php
 if(isset($_SESSION['out'])){
  unset($_SESSION['user']);
  session_destroy();
 
  
 }
 ?>


if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<!-- when delete redirect to same tab  -->
 <?php
if (isset($_GET['event'])) {?>
<script>
document.getElementById("secondTab").click();
</script>
<?php }?>

<?php
if (isset($_GET['blog'])) {?>
<script>
document.getElementById("defaultOpen").click();
</script>
<?php }?>

<?php 
 }?>
 


</body>
</html>

