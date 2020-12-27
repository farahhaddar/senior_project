<?php include "connection.php";?>
<!DOCTYPE html>
<html>
  <head>
<title>Young Adventurers </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="/css/all.css">
<link rel="stylesheet" href="front.css">
<style>
        .suc{
          color:green;
          font-size:20px;

        }
        .fail{
          color:red;
          font-size:15px;
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


<!------------------------------------home  -------------------------------------------------------->
<!-- start page 1 -->


<div id="home" class="w3-container city ">
    
    <div class="body">




<!-- slider -->

<div class="slideshow-container">
<?php
$sql = ("SELECT * FROM blog_images ORDER BY RAND ( )  ");
$images = mysqli_query($con, $sql);

if ($images->num_rows > 0) {

    while ($row = $images->fetch_assoc()) {
        $imageURL = $row["image_path"];
        $id = $row["blog_id"];
        $sql2 = ("SELECT * FROM blogs WHERE blog_id=$id  ");
        $im = mysqli_query($con, $sql2);

        if ($im->num_rows > 0) {
            $row2 = $im->fetch_assoc();

        }

        ?>
 <div class="mySlides fade">
   <img src="<?php echo $imageURL; ?>"  width="985px" height="550">
   <div style=" margin-bottom:100px;"class="text">
     <h2> <?php echo $row2["blog_name"]; ?> </h2> 
     </div>
 </div>

 <?php }}?>
</div>


<!-- slider -->

<!-- About Section -->

<div  class="w3-container w3-padding-32 w3-center" id="about">

    <h2 class="w3-border-bottom w3-border-light-grey w3-padding-40">About Us </h3>
    <p style="font-size:23px;margin-top:60px;margin-bottom:50px;  text-align: justify;
  text-justify: inter-word;">

        We are a group of young, free, and wild souls who are eager to see the beauty of this world. 
        To start seeing the world's beauty a one should start by seeing and discovering his own country. 
        So we decided to do a hiking group to help you see the beauty of Lebanon. 
        On this website, you can see blogs about the places we went to, their location,
        and what activities can be done there.
        Also, you can see our newest hikes and events
        where you can register for any of them and join us on our adventures.
    </p>

    <pre style="font-size:16px;margin-top:80px; padding-left:0px;">
    &#8223; Always remember you are never too old for an adventure And you are never too young for an adventure.
      It's always the right time for adventures &#8223;
    </pre>
      <center style=" margin-bottom:100px;">- YOUNG ADVENTURERS </center>

    </div>



<div style="font-size:20px;"  class="w3-container  w3-center w3-padding-32" id="projects">
    <h2  class="w3-border-bottom w3-border-light-grey w3-padding-16">Recent Events</h3>
  </div>

<?php
$query = "SELECT * FROM events ORDER BY   str_to_date(`date`, '%d/%m/%Y') DESC LIMIT 6  ";
$result = mysqli_query($con, $query);
?>
            <!-- flexdisplay -->
            <div class="can">
            <?php
            if ($result): // if not die conn
             if (mysqli_num_rows($result) > 0): //has data in it
              while ($blog = mysqli_fetch_assoc($result)): //saving data  each row as obj in array product
            ?>  

						           <div class="card">
						           <img src="<?php echo $blog['image_path']; ?>">
						                       <div class="info">
						                            <h2><?php echo $blog['event_name'] ?></h2>
						                           <h3> <?php echo "Date:" . "" . $blog['date'] ?>  </h3><br>
						                           <a href="desE.php?card=<?php echo $blog['event_id']; ?>" >  <button> Check Event </button></a>
						                       </div>

						                   </div>
						        <?php
        endwhile;
    endif;
endif;
?>

</div>
<!-- end flex -->



<!-- recent Blogs -->
<div style="font-size:20px;"  class="w3-container  w3-center w3-padding-32" id="projects">
    <h2  class="w3-border-bottom w3-border-light-grey w3-padding-16">Top Rated  Blogs</h3>
  </div>

    <?php
$sql = "SELECT * FROM blogs ORDER by rating DESC LIMIT 6 ";
$r = mysqli_query($con, $sql);
?>
  <!-- flexdisplay -->
  <div class="can">
  <?php
if ($r): // if not die conn
    if (mysqli_num_rows($r) > 0): //has data in it
        while ($blog = mysqli_fetch_assoc($r)): //saving data  each row as obj in array product
            ?>

						           <div class="card">
						           <img src="<?php echo $blog['image_path']; ?>">
						                       <div class="info">
						                            <h1><?php echo $blog['blog_name'] ?></h1>
						                           <!-- <h2> <?php #echo $blog['rating']?>  </h2> -->
						                           <h2 class="stars"><?php

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
						                           <a href="desB.php?card=<?php echo $blog['blog_id']; ?>" >  <button> Check City </button></a>
						                       </div>

						                   </div>
						        <?php
        endwhile;
    endif;
endif;
?>
</div>

</div>
<footer style="margin-top:30px;" class=" w3-red   w3-padding-16">


  <div class="social">
    <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a>
   <a href="https://www.instagram.com/"> <i class="fab fa-instagram"></i></a>
    <a href="https://twitter.com/?lang=en">  <i class="fab fa-twitter"></i> </a>
  </div>

  <div class="end">  <span class="copy"> &copy; </span>  YOUNG ADVENTURERS 2020 </div>
</footer>



</div>



<!------------------------------------home  -------------------------------------------------------->







<!------------------------------------events -------------------------------------------------------->
<div id="events" class="w3-container city" style="display:none; padding:0;">
  

<div class="body">

 <div style="font-size:20px;"  class="w3-container  w3-center w3-padding-32" id="projects">
    <h2  class="w3-border-bottom w3-border-light-grey w3-padding-16">All Events</h3>
  </div>
  


  
  
  <?php
$query = " SELECT * FROM events ORDER BY date ASC  ";
$result = mysqli_query($con, $query);
?>
 <!-- flexdisplay -->
 <div class="areascroll">
 <div class="can">
<?php
if ($result): // if not die conn
    if (mysqli_num_rows($result) > 0): //has data in it
        while ($blog = mysqli_fetch_assoc($result)): //saving data  each row as obj in array product
?>
<div class="card">
	<img src="<?php echo $blog['image_path']; ?>">
		<div class="info">
      <h2><?php echo $blog['event_name'] ?></h2>
      <h3> <?php echo "Date:" . "" . $blog['date'] ?>  </h3><br>
      <a href="desE.php?card=<?php echo $blog['event_id']; ?>" >  <button> Check Event </button></a>
		</div>
</div>

<?php
endwhile;
 endif;
endif;
?>
</div>


</div>
<!-- end flex -->





</div>

<footer style="margin-top:30px;" class=" w3-red   w3-padding-16">
<div class="social">
  <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a>
 <a href="https://www.instagram.com/"> <i class="fab fa-instagram"></i></a>
  <a href="https://twitter.com/?lang=en">  <i class="fab fa-twitter"></i> </a>
</div>
<div class="end">  <span class="copy"> &copy; </span>  YOUNG ADVENTURERS 2020 </div>
</footer>

</div>
<!------------------------------------events -------------------------------------------------------->

<!------------------------------------blogs  -------------------------------------------------------->



<div id="blogs" class="w3-container city" style="display:none; padding:0;">

<div class="body">
<div style="font-size:20px;"  class="w3-container  w3-center w3-padding-32" id="projects">
    <h2  class="w3-border-bottom w3-border-light-grey w3-padding-16">All  Blogs</h2>
  </div>

    <?php
$sql = "SELECT * FROM blogs  ORDER BY  blog_id ASC ";
$r = mysqli_query($con, $sql);
?>
  <!-- flexdisplay -->
  <div class="areascroll">
  <div class="can">
  <?php
if ($r): // if not die conn
    if (mysqli_num_rows($r) > 0): //has data in it
        while ($blog = mysqli_fetch_assoc($r)): //saving data  each row as obj in array product
            ?>

						           <div class="card">
						           <img src="<?php echo $blog['image_path']; ?>">
						                       <div class="info">
						                            <h1><?php echo $blog['blog_name'] ?></h1>
						                           <!-- <h2> <?php #echo $blog['rating']?>  </h2> -->
						                           <h2 class="stars"><?php

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
						                           <a href="desB.php?card=<?php echo $blog['blog_id']; ?>" >  <button> Check City </button></a>
						                       </div>

						                   </div>
						        <?php
        endwhile;
    endif;
endif;
?>
</div>
</div>






</div>

<footer style="margin-top:30px;" class=" w3-red  w3-padding-16">


  <div class="social">
    <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a>
   <a href="https://www.instagram.com/"> <i class="fab fa-instagram"></i></a>
    <a href="https://twitter.com/?lang=en">  <i class="fab fa-twitter"></i> </a>
  </div>

  <div class="end">  <span class="copy"> &copy; </span>  YOUNG ADVENTURERS 2020 </div>
</footer>
</div>
<!------------------------------------blogs -------------------------------------------------------->



<!------------------------------------  contact us -------------------------------------------------------->

<div id="contact" class="w3-container  city" style="display:none; padding:0;">

<div class="body">

<div id="contus"   class="w3-container   " >
    <h2 class="w3-border-bottom w3-border-light-grey   w3-center  w3-padding-16">Contact Us </h3>
</div>

<div class="c">

<span style="margin:60px;margin-bottom:0;">
<h3  class="w3-center "> Send Us Your Feedback ! </h3>
</span>

<div   id="contform">
<form  method="post"  action="contactsform.php" >

   <span class="suc"><?php if (isset($_SESSION['c'])) {echo $_SESSION['c'];unset($_SESSION['c']);}?></span><br>

    <label > Full Name : </label><span class="fail"><?php if (isset($_SESSION['n'])) {echo $_SESSION['n'];unset($_SESSION['n']);}?></span><br>
    <input type="text" name="fname" required  placeholder="ex. John Doe"><br>


    <label > Email :</label><span class="fail"><?php if (isset($_SESSION['e'])) {echo $_SESSION['e'];unset($_SESSION['e']);}?></span><br>
    <input type="text" name="email" required  placeholder="ex. John.Doe@example.com" ><br>

    <label > Phone Number  </label><span class="fail"><?php if (isset($_SESSION['t'])) {echo $_SESSION['t'];unset($_SESSION['t']);}?></span><br>
    <input type="text" name="tel" required   placeholder="ex. 03123456"><br>

    <label > comments  :</label><span class="fail"><?php if (isset($_SESSION['txt'])) {echo $_SESSION['txt'];unset($_SESSION['txt']);}?></span><br>
   <textarea name="comment" rows="12" cols="45"></textarea>


 <br>
   <div class="sub">
    <input type="submit"   name="submit" ><br></div>
   </form>
   </div>
   
   <div id="personl" class="w3-center" >
<i class="fas fa-map-marker-alt"></i> Beirut , Sodeco <br>
<i class="fas fa-phone"></i> 01/112211<br>
<i class="far fa-envelope"></i> youngAdventurers@gmail.com<br>
</div>

   </div>


   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22288.961442494896!2d35.520916553225405!3d33.88799290540781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f171cffad37cf%3A0x516785628d179cc!2sSodeco%20Square!5e0!3m2!1sen!2slb!4v1607967566159!5m2!1sen!2slb&output=embaded" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

   
 <footer style="margin-top:0px;" class=" w3-red   w3-padding-16">

  <div class="social">
    <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a>
   <a href="https://www.instagram.com/"> <i class="fab fa-instagram"></i></a>
    <a href="https://twitter.com/?lang=en">  <i class="fab fa-twitter"></i> </a>
  </div>

  <div class="end">  <span class="copy"> &copy; </span>  YOUNG ADVENTURERS 2020 </div>
</footer>

</div>
<!------------------------------------contact us  -------------------------------------------------------->



<!-- js script for nav bar pages  -->
<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }

  document.getElementById(cityName).style.display = "block";
}
</script>
<!-- js script for nav bar pages  -->


<script>
// // AUTOMATIC SLIDE SHOW
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

<?php
if (isset($_GET['contact'])) {?>
<script>
document.getElementById("contacts").click();
</script>
<?php }?>



</body>
</html>
