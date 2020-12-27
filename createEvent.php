<?php require_once 'connection.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="editor.css">
    <link rel="stylesheet" href="/css/all.css">
    <script src="editor.js"></script>
    <title>   Create Event </title>
</head>
<body onload="iframe()">
  <h1>  New Event !</h1>
<div class="con">
  <div class="succ">
<?php
        if(isset($_SESSION['events']))
        {
        echo $_SESSION['events'];
        unset($_SESSION['events']);
        }

        ?>
        <br>
</div>

<form method="post" id="f1" action="createLogic.php" enctype="multipart/form-data"   >
                 
                  <label> Event Name:</label>
                    <input type="text" name="name" ><span class="err" ><?php if(isset($_SESSION['nameEr'])){echo $_SESSION['nameEr'];unset($_SESSION['nameEr']);}?></span><br>
                   
                    
                  <label>cover Image :</label> <br>
                   <br> 
                  <input type="file"  name="file" id="file"  >
                  <span class="err" ><?php if(isset($_SESSION['fnEr'])){echo $_SESSION['fnEr'];unset($_SESSION['fnEr']);}?></span>
                  <span class="err" ><?php if(isset($_SESSION['cdir'])){echo $_SESSION['cdir'];unset($_SESSION['cdir']);}?></span>
                  <span class="err" ><?php if(isset($_SESSION['ctype'])){echo $_SESSION['ctype'];unset($_SESSION['ctype']);}?></span><br>
                 
                 <br>
                  
                  <label> Event day:</label>
                    <input type="text" name="date" placeholder="yyyy-mm-dd" ><span class="err" ><?php if(isset($_SESSION['dateEr'])){echo $_SESSION['dateEr'];unset($_SESSION['dateEr']);}?></span><br>
                  <br>
                 
                <label> Post Body: </label> <br>
                <span class="err" ><?php if(isset($_SESSION['contentEr'])){echo $_SESSION['contentEr'];unset($_SESSION['contentEr']);}?></span><br>
                <div id="toolbar">
                <i   onclick="bold()"       class="fas fa-bold"></i>    
                <i   onclick="italic()"     class="fas fa-italic"></i>
                <i   onclick="underline()"  class="fas fa-underline"></i>
                <i   onclick="fontSize()"   class="fas fa-font"></i>
                <i   onclick="fontColor()"  class="fas fa-palette"></i>
                <i   onclick="highlight()"  class="fas  fa-highlighter"></i>
                <i   onclick="unhighlight()"  class="fas fa-xs fa-highlighter"></i>
                <i   onclick="jl()"         class="fas fa-align-left"></i>
                <i   onclick="jc()"         class="fas fa-align-center"></i>
                <i   onclick="jr()"         class="fas fa-align-right"></i>
                <i   onclick="jf()"         class="fas fa-align-justify"></i>
                <i   onclick="llink()"      class="fas fa-link"></i>
                <i   onclick="ulink()"      class="fas fa-unlink"></i>
                <i   onclick="undo()"       class="fas fa-undo"></i>
                </div>
                
                <textarea name="tx" id="tx" style="display:none;"></textarea>
                <iframe name="editor" id="editor" width=500px height=300px ></iframe>
                <br><br>
                <br><br>

               <label>Select Images Files to Upload: </label> <br><br>
                <input type="file" name="files[]" multiple >
                <span class="err" ><?php if(isset($_SESSION['imgsdir'])){echo $_SESSION['imgsdir'];unset($_SESSION['imgsdir']);}?></span>
                <span class="err" ><?php if(isset($_SESSION['imgstype'])){echo $_SESSION['imgstype'];unset($_SESSION['imgstype']);}?></span><br>
                <br><br>

                <div class="btncenter">

                <input type="submit" onclick="formsubmit()"   name="submit2" id="submit"  value="Create" ><br><br><br>
                 </div>


         </from>


         <div class="linkh">
         <i class="fas fa-arrow-left"></i><a href="adminPanel.php">Go Back To Home Page </a>
         </div>



</div>
    
</body>
</html>