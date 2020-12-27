<?php 
require_once 'connection.php';

if(isset($_GET['editE'])){
     
    $id=$_GET['editE'];
     
    $sql = "SELECT * FROM events  WHERE event_id=$id";
    $events=mysqli_query($con,$sql);
    if ($events->num_rows > 0) 
    {
        $row =mysqli_fetch_assoc($events);
    }

    $sql2=("SELECT * FROM event_images WHERE event_id=$id ");
    $images=mysqli_query($con,$sql2);

}

if(isset($_GET['cover'])){
    $id=$_GET['cover'];
    mysqli_query($con,"UPDATE  events SET image_path=NULL  WHERE event_id=$id");
    header("Location:eventEdit.php?editE=$id");

}

if(isset($_GET['img'])){
    $id=$_GET['img'];
    $p=$_SESSION['id'];
    mysqli_query($con,"DELETE FROM    event_images  WHERE  image_id='$id'") ;
    header("Location:eventEdit.php?editE=$p");

}

if(isset($_POST['update'])){
   
    $id=$_POST['eventid'];
    
  
          $name  = $date = $content = $fileName = "";
          $nameEr = $dateEr = $rateEr = $contentEr = $fnEr = "";
          $cdir = $ctype = $imgsdir = $imgstype = "";
  
  
          if (empty($_POST['name'])) {
              $nameEr = "true";
          } else {
              $name = $_POST['name'];
              
          }
          
          if (empty($_POST['date'])) {
              $dateEr = "true";
          } else {
              $date = $_POST['date'];
             
          }
          
          $content=trim($_POST['tx']);
          
          if (strcmp($content,"") == 0) {
              $contentEr = "true";
          } else {
              $text=base64_encode( $content);
              
          }
          
          
          
         
          $sql = "SELECT * FROM events  WHERE   event_id=$id";
          $events=mysqli_query($con,$sql);
         
          
         if ($events->num_rows > 0) 
          {
          $row =mysqli_fetch_assoc($events);
          $_SESSION['image_path']=$row['image_path'];
          
         }
         
          if (empty($_FILES["file"]["name"]) && ($_SESSION['image_path']==NULL)){
              $fnEr = "true";
          } else if($_SESSION['image_path']!=NULL){
              $fileName =$_SESSION['image_path'] ;
              }else {
              $fileName = basename($_FILES["file"]["name"]);
              
          }
            
  
           if (empty($nameEr)  && empty($dateEr) && empty($contentEr) && empty($fnEr)) 
           {
  
             if($fileName ===$_SESSION['image_path']) 
             {
               
               $sql = ("UPDATE  events  set event_name='$name',date='$date',post='$text' WHERE event_id=$id") or die($mysqli->error);
    
               mysqli_query($con, $sql);
               if(mysqli_query($con, $sql)){
                  $_SESSION['events']="Event has been updated";}
                  
               
              }else
              {
                  
                  $targetDir = "img/";
                  $targetFilePath = $targetDir . $fileName;
                  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                  $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                  if (in_array($fileType, $allowTypes)) 
                  {
                      if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) 
                      {
                          $insert = 'img/' . $fileName;
                          
                      } else
                      {
                          $cdir = "couldnt move to dir";
                      }
                  } else 
                  {
                      $ctype = " file type not allowed";
                  }
  
                          if($insert)
                          {
                             
                              $sql = ("UPDATE  events  set event_name='$name',date='$date',image_path='$insert',post='$text' WHERE event_id=$id") or die($mysqli->error);
                              
                              mysqli_query($con, $sql);
                              
                              if(mysqli_query($con, $sql))
                              {
                        
                                $_SESSION['events']="Event has been updated";
                              }
                          }
                 
              }
  
            
             
          $fileNames = array_filter($_FILES['files']['name']);
                      if (!empty($fileNames)) {
                          foreach ($_FILES['files']['name'] as $key => $val) {
  
                              $fileName = basename($_FILES['files']['name'][$key]);
                              $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                              $targetDir = "img/";
                              $targetFilePath = $targetDir . $fileName;
                              $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                              if (in_array($fileType, $allowTypes)) {
                                  if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                                      
                                      $insertValuesSQL = $targetDir . $fileName;
                                      if($con->query("INSERT INTO event_images (event_id,image_name) VALUES ('$id','$insertValuesSQL')")){
                                         
                                      }
              
                                  } else {
                                      $imgsdir = "couldnt upload iamges to dir";
                                  }
                              } else {
                                  $imgstype = " file type not allowed";
                              }
                          }
              
                      }
                      if ($cdir || $ctype || $imgsdir || $imgstype || $aclevelEr) {
                          $_SESSION['cdir'] = $cdir;
                          $_SESSION['ctype'] = $ctype;
                          $_SESSION['imgsdir'] = $imgsdir;
                          $_SESSION['imgstype'] = $imgstype;
                      }
  
          } else {
              if ($nameEr) {$_SESSION['nameEr'] = "* Required feild ";}
              if ($dateEr) {$_SESSION['dateEr'] = "* Required feild ";}
              if ( $contentEr) {$_SESSION['contentEr'] = "* Required feild ";}
              if ($fnEr) {$_SESSION['fnEr'] = "* Required feild ";}
              
          }
  
          header("Location:eventEdit.php?editE=$id");
  }















?>