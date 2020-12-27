<?php require_once "connection.php" ;?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
    <link rel="styleSheet" href="w3.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="styleSheet" href="front.css">
   
    
 <style>
   #nav{
  
  position: absolute;
  width: 100%;
}
 
 </style>
  
</head>

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
    $sql = "SELECT * FROM blogs  WHERE blogs.blog_id=$id";
    $blogs=mysqli_query($con,$sql);
    if ($blogs->num_rows > 0) {
        $blog =mysqli_fetch_assoc($blogs);}
    
    $sql2=("SELECT * FROM blog_images WHERE blog_id=$id ");
    $images=mysqli_query($con,$sql2);

    $sql3 = "SELECT * FROM activities  WHERE blog_id=$id";
    $activities=mysqli_query($con,$sql3);

}
 
 ?>
 <!---------------- ------------------------title------------------------------------>

 <div class="nc"> 

 <span class="name"> <?php echo $blog['blog_name'];?></span>
 </div>

<!---------------- ------------------------title------------------------------------>


<!---------------- ------------------------slide show------------------------------------->

 <div class="w3-content w3-display-container">
 <?php
if ($images->num_rows > 0) {
    while ($row = $images->fetch_assoc() ) {
        $imageURL = $row["image_path"];
        ?>
 
  <img class="mySlides" src="<?php echo $imageURL; ?> " style="width:980px;height:550px;">
  
  <?php }}?>
  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<!---------------------------------------slide show--------------------------------------->

<!---------------- ------------------------rating ------------------------------------>


<div class="rate">
<h2 class="stars2"> <span style="color:black;"> Rate   </span> <br><?php

switch ($blog['rating']) {
    case 1:echo "&#9733;";
        break;
    case 2:echo "&#9733; &#9733;";
        break;
    case 3:echo "&#9733; &#9733; &#9733;";
        break;
    case 4:echo "&#9733; &#9733; &#9733; &#9733;";
        break;
    case 5:echo "&#9733; &#9733; &#9733; &#9733; &#9733;";
        break;
    default:echo "0";

}

?></h2>

</div>
<!---------------- ------------------------rating ------------------------------------>



    

<!--------------------------------- content----------------------------- -->

 <div class="content">
<h4>
 <?php echo base64_decode($blog['content']);?> <br>
 </h4>
 </div>

<!--------------------------------- content----------------------------- -->
<center> <h2 style="margin-bottom:10px;"> What  Can Be Done There & Who Can do It ?  </h2></center>

<div class="act">
 
<?php
if ($activities->num_rows > 0) {
    ?>
    <div class="table-users">

  <table cellpadding="0" >
  <thead>
    <tr id="th">
    <th>Activities</th>
    <th>Level</th>
    </thead>
    </tr>

  <tbody>
<?php

    while ($row = $activities->fetch_assoc()) {
        ?>
<tr>
    <td><?php echo $row["activity"]; ?></td>
    <td><?php echo $row["activity_level"]; ?></td>
</tr>
<?php

    }
    ?>
 </tbody>
</table>
</div>
 <?php
} else {
    echo "No result found";
}
?>
</div> 
<!-------------------------------------------activities-----------------------------------?>

<!--------------------------------- map----------------------------- -->
<!-- iframee map -->
<center> <h2 style="margin-bottom:10px;"> How Do I Get There?  </h2></center>

<iframe
 src="<?php echo $blog['map_links'] ?>"
  width="100%"
   height="450" 
   frameborder="0"
    style="border:0;margin-bottom:20px; "
     allowfullscreen="" 
     aria-hidden="false"
      tabindex="0" 
      
      ></iframe>
<!--------------------------------- map----------------------------- -->


        <div class="linkh">
         <center><i class="fas fa-arrow-left"></i> <a href="index.php">Go Back To Home Page </a></center>
         </div>

</div>
<!--------------------------------- footer----------------------------- -->
<footer style="margin-top:30px;" class=" w3-red  w3-padding-16">


  <div class="social">
    <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a>
   <a href="https://www.instagram.com/"> <i class="fab fa-instagram"></i></a>
    <a href="https://twitter.com/?lang=en">  <i class="fab fa-twitter"></i> </a>
  </div>

  <div class="end">  <span class="copy"> &copy; </span>  YOUNG ADVENTURERS 2020 </div>
</footer>

<!--------------------------------- footer----------------------------- -->






<script>

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}

</script>



    

</body>
</html>