<?php require_once "connection.php" ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
    <link rel="styleSheet" href="w3.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="styleSheet" href="front.css">
</head>
<style>
             /* event description page */
     

        /* The grid: Four equal columns that floats next to each other */

    .row{
      display: grid;
      grid-template-columns: repeat(50, 1fr);
      /* grid-template-columns: auto auto auto auto;
      justify-content: space-evenly;
      grid-gap: 6px; */
    }   
.column {
  width: 40%;
  height: 45%;
  padding: 10px;
}

/* Style the images inside the grid */
.column img {

  cursor: pointer;
}

.column img:hover {
  opacity: 1;
}

#expandedImg{
 width:500px;
 height :500px;
 margin-top:20px;

}
/* The expanding image container (positioning is needed to position the close button and the text) */


.container {
  position: relative;
  display: none;
}

/* Expanding image text */
#imgtext {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: white;
  font-size: 20px;
}

/* Closable button inside the image */
.closebtn {
  position: absolute;
  top: 5px;
  right: 300px;
  color: rgb(161, 34, 34);
  font-size: 35px;
  cursor: pointer;
}
.suc{
  color:green;
  font-size: 20px;
}
.fail{
  color:red;
  font-size: 20px;
}
#nav{
  
  position: absolute;
  width: 100%;
}
 
    </style>
<body>
<!---------------------------nav bar ---------------------------------------- -->
<header >
    <div  id="nav" class="w3-bar-item   w3-red">
        <span   class="w3-bar-item   w3-left " id = "logo"> Young Adventurers &#9829; </span>
        <button  class="w3-bar-item   w3-button w3-hover-none w3-text-white w3-hover-text-gray " onclick="openCity('home')">Home</button>
        <button  class="w3-bar-item   w3-button  w3-hover-none w3-text-white w3-hover-text-gray "onclick="openCity('blogs')">Blogs</button>
        <button  class="w3-bar-item  w3-button  w3-hover-none w3-text-white w3-hover-text-gray " onclick="openCity('events')">Events</button>
        <button  id="contacts" class="w3-bar-item   w3-button w3-hover-none w3-text-white w3-hover-text-gray " onclick="openCity('contact')">Contact us</button>
    </div>
</header>
<!---------------------------nav bar ---------------------------------------- -->
<div class="body">
<?php 
 if(isset($_GET['card'])) {
    $id = $_GET['card'];
    $_SESSION["id"]= $id;
    
    $sql = "SELECT * FROM events  WHERE  event_id=$id";
    $events=mysqli_query($con,$sql);
    if ($events->num_rows > 0) {
        $event =mysqli_fetch_assoc($events);}
       
        
       
        $images=$con->query("SELECT * FROM event_images WHERE event_id=$id ");
        
        
    
}
 
 ?>

 <!----------------------------- events table -------------------------->
 
 <img  style="width:100%;height:500px" src="<?php echo $event['image_path'];?>" > <br>
 <div class="nc"> 
<span class="name"><?php echo $event['event_name'];?></span>
</div>
 
<div class="rate">
<h2 class="stars3"> <span style="color:black;">   Event Happening ON   </span> <br>

  <?php echo $event['date'];?> <br>  </h2>
  </span>

</div>

<div class="content">
<h4>
 
 <?php echo base64_decode($event['post']);?> <br>
</h4>
</div>

  <!----------------------------- events table -------------------------->

  <!----------------------------- images table -------------------------->
  <h2 style="text-align:center"> Awsome shots in the place:</h2>
  
  
  <div class="scroll"> 
  <div class="row">
   <?php
   if ($images->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($images)){
        $imageURL = $row['image_name'];
        
        ?>
      
    <div  class="column">
    <img src="<?php echo $imageURL ?>"  width="200px" height="200px" onclick="myFunction(this);">
   </div>
   
    <?php  }} ?>
    </div>
    </div>
    <div class="container">
  
  <span onclick="this.parentElement.style.display='none'" class="closebtn" >&times;</span>

  <img id="expandedImg" >
  <div id="imgtext"></div>
  
 </div>




    
  <!----------------------------- images  table -------------------------->

  <!----------------------------- Regestration form -------------------------->
    
  <div  style=" margin-top: 50px; ;" class="nc"> 

<span  style="font-size:35px;"class="name"> Join Us On this Adventure! Registor here </span>
</div>
  <div  id="contform1">
   <form method="post"    action="regform.php" >
   <span class="suc"><?php if(isset($_SESSION['r'])){ echo $_SESSION['r']; unset($_SESSION['r']) ;}?></span><br>
    
    <label   > Full Name : </label><span class="fail"><?php if(isset($_SESSION['n'])){ echo $_SESSION['n']; unset($_SESSION['n']) ;}?></span><br>
    <input type="text" name="fname" required  placeholder="ex. John Doe"><br>

    <label > Gender  :</label><span class="fail"><?php if(isset($_SESSION['g'])){ echo $_SESSION['g']; unset($_SESSION['g']) ;}?></span><br>
    <input type="text" name="gender" required  placeholder="ex. Male/Female"><br>

    <label > Age :</label><span class="fail"><?php if(isset($_SESSION['a'])){ echo $_SESSION['a']; unset($_SESSION['a']) ;}?></span><br>
    <input type="text" name="age" required  placeholder="ex. 22"><br>

    <label > Email :</label><span class="fail"><?php if(isset($_SESSION['e'])){ echo $_SESSION['e']; unset($_SESSION['e']) ;}?></span><br>
    <input type="text" name="email" required  placeholder="ex. John.Doe@example.com" ><br>

    <label > Phone Number  </label><span class="fail"><?php if(isset($_SESSION['t'])){ echo $_SESSION['t']; unset($_SESSION['t']) ;}?></span><br>
    <input type="text" name="tel" required   placeholder="ex. 03123456"><br>
    
    <input  type="hidden" name="event_id"  value="<?php  echo $_SESSION["id"];?> "><br>
 <br>

     
       


    <input type="submit" name="submit" ><br>
   </form>
    </div>




  <!----------------------------- Regestration form -------------------------->
  <div class="linkh">
         <center><i class="fas fa-arrow-left"></i> <a href="index.php">Go Back To Home Page </a></center>
         </div>

         </div>
<!--------------------------------- footer----------------------------- -->
<footer style="margin-top:30px;" class=" w3-red   w3-padding-16">


  <div class="social">
    <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a>
   <a href="https://www.instagram.com/"> <i class="fab fa-instagram"></i></a>
    <a href="https://twitter.com/?lang=en">  <i class="fab fa-twitter"></i> </a>
  </div>

  <div class="end">  <span class="copy"> &copy; </span>  YOUNG ADVENTURERS 2020 </div>
</footer>

<!--------------------------------- footer----------------------------- -->


  <script>
 
 function myFunction(imgs) {
  // Get the expanded image
  var expandImg = document.getElementById("expandedImg");
  // Get the image text
  var imgText = document.getElementById("imgtext");
  // Use the same src in the expanded image as the image being clicked on from the grid
  expandImg.src = imgs.src;
  // Use the value of the alt attribute of the clickable image as text inside the expanded image
  imgText.innerHTML = imgs.alt;
  // Show the container element (hidden with CSS)
  expandImg.parentElement.style.display = "block";
}
 
 </script>
   
 </body>
 </html>