<?php 
require_once 'connection.php';



//event delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $con->query("DELETE FROM event_images  WHERE event_id=$id") or die($con->error);
    if ($con->query("DELETE FROM event_images  WHERE event_id=$id") ) {
        $con->query("DELETE FROM event_regestrations  WHERE event_id=$id") or die($con->error);
        if ($con->query("DELETE FROM event_regestrations  WHERE event_id=$id") ) {
            $con->query("DELETE FROM events  WHERE event_id=$id") or die($con->error);
            if ($con->query("DELETE FROM events  WHERE event_id=$id") ) {
                $_SESSION['dele'] = " Event has been deleted ";
            }

        }
    }

    header("Location:adminPanel.php?event=true");
}

//event delete
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $con->query("DELETE FROM    blog_images  WHERE blog_id=$id") or die($con->error);
    if ($con->query("DELETE FROM blog_images  WHERE blog_id=$id") ) {
        $con->query("DELETE FROM activities  WHERE blog_id=$id") or die($con->error);
        if ($con->query("DELETE FROM activities  WHERE blog_id=$id")) {
            $con->query("DELETE FROM blogs  WHERE blog_id=$id") or die($con->error);
            if ($con->query("DELETE FROM blogs  WHERE blog_id=$id")==true ) {
                
               $b="Blog has been deleted";
            }

        }
    }
    $_SESSION['b'] = $b;
    header("Location:adminPanel.php?blog=true");
}



?>