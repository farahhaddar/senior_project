<?php include 'editLogic.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="editor.css">
    <link rel="stylesheet" href="/css/all.css">
    
    <script src="e.js"></script>
</head>
<body>
<h1>  Blog Edit </h1>
<div class="con">
  <div class="succ">
<?php
        if(isset($_SESSION['blog']))
        {
        echo $_SESSION['blog'];
        unset($_SESSION['blog']);
        }

        ?>
</div>
<?php 
if(isset($_GET['editB'])){
session_start();
$_SESSION['id']=$_GET['editB'];
}
?>
    <form method="post" action="editLogic.php"  enctype="multipart/form-data"  >

    <input type="hidden" name="blogid" value="<?php echo $row['blog_id'] ; ?>">
    <label> Blog Name:</label>
            <span class="err" ><input type="text"   name="name" value="<?php echo $row['blog_name'] ; ?>" ><?php if (isset($_SESSION['nameEr'])) {echo $_SESSION['nameEr'];unset($_SESSION['nameEr']);}?></span><br>

                <label>Google Maps link :</label>
                <span class="err" > <input type="text" name="link" value="<?php echo $row['map_links'] ; ?>" ><?php if (isset($_SESSION['linkEr'])) {echo $_SESSION['linkEr'];unset($_SESSION['linkEr']);}?></span><br>

                  <label>cover Image :</label><br>
                  <div id="imgg">
                  <?php if($row['image_path']!=NULL){?>
                  <img src="<?php echo $row['image_path'] ; ?>" width="300px"   height="200px;"  /><br>
                   
                  <a  class="btno" href="editLogic.php?cover=<?php echo $row['blog_id'];?>">x</a> <br>
                  <?php  } ?>
                  </div>
                   
                  <input type="file"  name="file" id="file"  >
                  <span class="err" ><?php if (isset($_SESSION['fnEr'])) {echo $_SESSION['fnEr'];unset($_SESSION['fnEr']);}?></span>
                  <span class="err" ><?php if (isset($_SESSION['cdir'])) {echo $_SESSION['cdir'];unset($_SESSION['cdir']);}?></span>
                  <span class="err" ><?php if (isset($_SESSION['ctype'])) {echo $_SESSION['ctype'];unset($_SESSION['ctype']);}?></span><br>
                     <br>
                  
    
                <label>Rating:</label> 
                 <span class="err" > <input type="text" value="<?php echo $row['rating'] ; ?>"  name="rate"><?php if (isset($_SESSION['rateEr'])) {echo $_SESSION['rateEr'];unset($_SESSION['rateEr']);}?></span><br>

                <label> BlOG Body: </label> <br>
                <span class="err" ><?php if (isset($_SESSION['contentEr'] )) {echo $_SESSION['contentEr'] ;unset($_SESSION['contentEr']);}?> </span><br>
                <div id="toolbar">
                  <div id="edit">
                <image src="img/bold.svg" onclick="bold()" width="22px" style="padding:15px;" >
                <image src="img/italic.svg" onclick="italic()" width="22px" style="padding:15px;">
                <image src="img/underline.svg" onclick="underline()" width="22px" style="padding:15px;">
                <image src="img/font.svg" onclick="fontSize()" width="22px" style="padding:15px;">
                <image src="img/palette.svg" onclick="fontColor()" width="22px" style="padding:15px;">
                <image src="img/highlighter.svg" onclick="highlight()" width="22px" style="padding:15px;">
                <image src="img/highlighter.svg" onclick=" unhighlight()" width="18px" style="padding:15px;" >
                <image src="img/insertlink.svg" onclick="llink()" width="22px"  style="padding:15px;">
                <image src="img/unlink.svg" onclick="ulink()" width="22px" style="padding:15px;" >
                <image src="img/justifyleft.svg" onclick="jl()" width="22px" style="padding:15px;" >
                <image src="img/justifycenter.svg" onclick="jc()" width="22px" style="padding:15px;" >
                <image src="img/justifyright.svg" onclick="jr()" width="22px"  style="padding:15px;">
                <image src="img/justifyblock.svg" onclick="jf()" width="22px" style="padding:15px;">
                <image src="img/undo.svg" onclick="undo()" width="22px"style="padding:15px;" >
                  </div>
                  </div>
                 <textarea name="tx" id="tx" style="display:none;"></textarea> 
               
                <div  contenteditable name="editor" class="editor" id ="editor" style="overflow-y: scroll; "  >
               <p>
                  <?php
                   
                   echo base64_decode($row['content']) ;?>
                  </p>
                  </div> 

                <br><br>
                <br><br>
                
                <center> <label> Activities:</label> <br> <br>
                    <?php
                    if ($activities->num_rows > 0) {
                    ?>
               <table >
                   <thead>
                       <tr>
                       <th> Activity </th>
                       <th>level </th>
                     </tr>
                   </thead>
                   <tbody>
                       <?php
                             while ($row = $activities->fetch_assoc()) {
                                ?>
                                <tr>
                                <td><input  class="t"value="<?php echo $row["activity"]; ?> " type="text" name="activity[]"/></td>
                                <td><input  class="t" value="<?php echo $row["activity_level"];?>"    type="text" name="level[]"/> </td>
                                <td ><input  name="acid[]"type="hidden" value="<?php echo $row["activity_id"];?>"> </td>
                               </tr>
                                
                               <?php } ?>
                                    
                                    </tbody>
                                    </table>
                                    <?php } ?>
                                    

                             </center>
                  <br> <br> <br>
                  <label>Select Images Files to Upload:</label><br><br>
                <input type="file" name="files[]" multiple >
                <span class="err" ><?php if (isset($_SESSION['imgsdir'])) {echo $_SESSION['imgsdir'];unset($_SESSION['imgsdir']);}?></span>
                <span class="err" ><?php if (isset($_SESSION['imgstype'])) {echo $_SESSION['imgstype'];unset($_SESSION['imgstype']);}?></span><br>
                <br><br>

                  <div class="colmn"width="900px" height="400px" style="overflow-y=schroll">
                <?php
                    if ($images->num_rows > 0) {
                    
                                while ($row = $images->fetch_assoc()) {
                                  $i = $row["image_path"];
                                  $id=$row['id'];
                                  ?>
                                
                                <div id="imgg">
                                <img  width="200px"   height="200px" src="<?php echo $i ; ?>"  /></td><br>
                                <a  href="editLogic.php?img=<?php echo $id  ; ?>">x </i></a> <br>
                                </div>
                                

                               <?php } ?>
                                    
                                    </tbody>
                                    </table>
                                    <?php }else{
                                      echo "No Images Found";
                                    } ?>

                    </div>
















                    <div class="btncenter">
                <input type="submit" name="update"  onclick="val()"  id="update" ><br>
              </div>
                 
  </form><br>
  <div class="linkh">
         <i class="fas fa-arrow-left"></i><a href="adminPanel.php">Go Back To Home Page </a>
         </div>
  </div>
</body>
  

</html>
