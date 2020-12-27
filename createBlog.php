<?php require_once 'connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="editor.css">
    <link rel="stylesheet" href="/css/all.css">
    <script src="editor.js"></script>
    <title>   Create Blog </title>
</head>
<body onload="iframe()">
<h1>  New Blog !</h1>
<div class="con">
<div class="succ">
<?php
if (isset($_SESSION['blogs'])) {
    echo $_SESSION['blogs'];
    unset($_SESSION['blogs']);
}

?>
<br>
</div>


<form method="post" id="f1" action="createLogic.php" enctype="multipart/form-data"   >

            <label> Blog Name:</label>
            <span class="err" ><input type="text" name="name" ><?php if (isset($_SESSION['nameEr'])) {echo $_SESSION['nameEr'];unset($_SESSION['nameEr']);}?></span><br>

                <label>Google Maps link :</label>
                <span class="err" > <input type="text" name="link"><?php if (isset($_SESSION['linkEr'])) {echo $_SESSION['linkEr'];unset($_SESSION['linkEr']);}?></span><br>
                 <br>
                  <label>cover Image :</label> <br> 
                 
                <input type="file"    name="file" id="file"  >
            
                 
                  <span class="err" ><?php if (isset($_SESSION['fnEr'])) {echo $_SESSION['fnEr'];unset($_SESSION['fnEr']);}?></span>
                  <span class="err" ><?php if (isset($_SESSION['cdir'])) {echo $_SESSION['cdir'];unset($_SESSION['cdir']);}?></span>
                  <span class="err" ><?php if (isset($_SESSION['ctype'])) {echo $_SESSION['ctype'];unset($_SESSION['ctype']);}?></span><br>
                 <br>


                 <label>Rating:</label>
                 <span class="err" > <input type="text" name="rate"><?php if (isset($_SESSION['rateEr'])) {echo $_SESSION['rateEr'];unset($_SESSION['rateEr']);}?></span><br>
                 <br>
                <label> Blog Body: </label><span class="err" ><?php if (isset($_SESSION['contentEr'])) {echo $_SESSION['contentEr'];unset($_SESSION['contentEr']);}?></span>
                <br> <br>
                
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
                <iframe name="editor" id="editor"  ></iframe>
                <br><br>
                <br><br>
              <center> <label> Activities:</label> <br> <br>
               <table style=>
                   <thead>
                       <tr>
                       <th> Activity </th>
                       <th>level </th>
                     </tr>
                   </thead>
                   <tbody>
                       <tr>
                           <td><input class="t" type="text" name="activity[]"/></td>
                           <td><input class="t"type="text" name="level[]"/> </td>
                       </tr>
                       <tr>
                           <td><input class="t" type="text" name="activity[]"/></td>
                           <td><input class="t"type="text" name="level[]"/> </td>
                       </tr>
                       <tr>
                           <td><input class="t"type="text" name="activity[]"/></td>
                           <td><input class="t" type="text" name="level[]"/> </td>
                       </tr>
                       <tr>
                           <td><input  class="t"type="text" name="activity[]"/></td>
                           <td><input  class="t"type="text" name="level[]"/> </td>
                       </tr>


                   </tbody>
               </table>
               </center> 
               <br> <br>
                <label>Select Images Files to Upload:</label>
                <br><br>
               
               
                <input type="file"  name="files[]" multiple class="hide_file">
                
                

                <span class="err" ><?php if (isset($_SESSION['imgsdir'])) {echo $_SESSION['imgsdir'];unset($_SESSION['imgsdir']);}?></span>
                <span class="err" ><?php if (isset($_SESSION['imgstype'])) {echo $_SESSION['imgstype'];unset($_SESSION['imgstype']);}?></span><br>
                <br><br>
               <div class="btncenter">
               
               <input  type="submit" name="submit" id="submit" onclick="formsubmit()"  value="Create" ><br><br><br>
               </div>
        


         </from>

         <div class="linkh">
         <i class="fas fa-arrow-left"></i><a href="adminPanel.php">Go Back To Home Page </a>
         </div>

















</div>

</body>
</html>