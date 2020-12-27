<?php include 'eventEditLogic.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="editor.css">
    <link rel="stylesheet" href="/css/all.css">
    <script src="e.js"></script>
    <title>   Edit Event </title>
</head>
<body >
  <h1>   Event Edit </h1>
<div class="con">
  <div class="succ">
<?php
        if(isset($_SESSION['events']))
        {
        echo $_SESSION['events'];
        unset($_SESSION['events']);
        }

        ?>
</div>

<form method="post" id="f1" action="eventEditLogic.php" enctype="multipart/form-data"   >
<?php 
if(isset($_GET['editE'])){
session_start();
$_SESSION['id']=$_GET['editE'];
}
?>
<input type="hidden" name="eventid" value="<?php echo $row['event_id'] ; ?>">
                 
                  <label> Event Name:</label>
                    <input type="text" name="name" value="<?php echo $row['event_name'] ; ?>" ><span class="err" ><?php if(isset($_SESSION['nameEr'])){echo $_SESSION['nameEr'];unset($_SESSION['nameEr']);}?></span><br>
                  
                    <label>cover Image :</label><br>
                  
                  <div id="imgg">
                  <?php if($row['image_path']!=NULL){?>
                    <img src="<?php echo $row['image_path'] ; ?>" width="300px"   height="200px;"  /><br>
                    <a class="btno"  href="eventEditLogic.php?cover=<?php echo $row['event_id'];?>">x </a> <br>
                  <?php  } ?>
                  </div>
                  
                   <br>
                  <input type="file"  name="file" id="file"  >
                  <span class="err" ><?php if (isset($_SESSION['fnEr'])) {echo $_SESSION['fnEr'];unset($_SESSION['fnEr']);}?></span>
                  <span class="err" ><?php if (isset($_SESSION['cdir'])) {echo $_SESSION['cdir'];unset($_SESSION['cdir']);}?></span>
                  <span class="err" ><?php if (isset($_SESSION['ctype'])) {echo $_SESSION['ctype'];unset($_SESSION['ctype']);}?></span><br>
              
                  <br>

                  
                  <label> Event day:</label><br>
                    <input type="text" name="date"  value="<?php echo $row['date'] ; ?>"  placeholder="yyyy-mm-dd" ><span class="err" ><?php if(isset($_SESSION['dateEr'])){echo $_SESSION['dateEr'];unset($_SESSION['dateEr']);}?></span><br>
                 
                 
                


                <br>
                <label> Event Post: </label><br>
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
               
                <div  contenteditable name="editor" class="editor" id ="editor" style="overflow-y: scroll;"  >
               <p>
                  <?php
                   
                   echo base64_decode($row['post']) ;?>
                  </p>
                  </div> 

                <br><br>
                <br><br>

                <label>Select Images Files to Upload:</label><br> <br>
                <input type="file" name="files[]" multiple > <br>
                <span class="err" ><?php if (isset($_SESSION['imgsdir'])) {echo $_SESSION['imgsdir'];unset($_SESSION['imgsdir']);}?></span>
                <span class="err" ><?php if (isset($_SESSION['imgstype'])) {echo $_SESSION['imgstype'];unset($_SESSION['imgstype']);}?></span><br>
                <br><br>

                  <div   class="colmn"width="900px" height="400px" style="overflow-y=schroll">
                <?php
                    if ($images->num_rows > 0) {
                    
                                while ($row = $images->fetch_assoc()) {
                                  $i = $row["image_name"];
                                  $id=$row['image_id'];
                                  ?>
                                
                                <div id="imgg">
                                <img  width="200px"   height="200px" src="<?php echo $i ; ?>"  /></td> <br>
                                <a  class="btno" href="eventEditLogic.php?img=<?php echo $id  ; ?>">x </a> <br>
                                </div>
                                

                               <?php } ?>
                                    
                                    </tbody>
                                    </table>
                                    <?php }else{
                                      echo "No Images Found";
                                    } ?>

                    </div>


                     <br>
                    <div class="btncenter">
                <input type="submit" name="update"  onclick="val()"  id="update" ><br>
                                  </div>
    
  </form>
  <br>
  <div class="linkh">
         <i class="fas fa-arrow-left"></i><a href="adminPanel.php">Go Back To Home Page </a>
         </div>
  </div>
</body>
  

</html>
               















               


    