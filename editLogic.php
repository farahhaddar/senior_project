<?php
require_once 'connection.php';

if (isset($_GET['editB'])) {

    $id = $_GET['editB'];

    $sql = "SELECT * FROM blogs  WHERE blogs.blog_id=$id";
    $blogs = mysqli_query($con, $sql);
    if ($blogs->num_rows > 0) {
        $row = mysqli_fetch_assoc($blogs);

    }

    $sql3 = "SELECT * FROM activities  WHERE blog_id=$id";
    $activities = mysqli_query($con, $sql3);

    $sql2 = ("SELECT * FROM blog_images WHERE blog_id=$id ");
    $images = mysqli_query($con, $sql2);

}
if (isset($_GET['cover'])) {
    $id = $_GET['cover'];
    mysqli_query($con, "UPDATE  blogs SET image_path=NULL  WHERE blog_id=$id");
    header("Location:blogEdit.php?editB=$id");

}

if (isset($_GET['img'])) {
    $id = $_GET['img'];
    $p = $_SESSION['id'];
    mysqli_query($con, "DELETE FROM    blog_images  WHERE  id='$id'");
    header("Location:blogEdit.php?editB=$p");

}

if (isset($_POST['update'])) {

    $id = $_POST['blogid'];

    $name = $link = $rate = $content = $fileName = "";
    $nameEr = $linkEr = $rateEr = $contentEr = $fnEr = "";
    $cdir = $ctype = $imgsdir = $imgstype = "";

    if (empty($_POST['name'])) {
        $nameEr = "true";
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['rate'])) {
        $rateEr = "true";
    } else {
        $rate = $_POST['rate'];
    }
    if (empty($_POST['link'])) {
        $linkEr = "true";
    } else {
        $link = $_POST['link'];
    }

    $content = trim($_POST['tx']);

    if (strcmp($content, "") == 0) {
        $contentEr = "true";
    } else {
        $text = base64_encode($content);
    }

    $sql = "SELECT * FROM blogs  WHERE   blog_id=$id";
    $blogs = mysqli_query($con, $sql);

    if ($blogs->num_rows > 0) {
        $row = mysqli_fetch_assoc($blogs);
        $_SESSION['image_path'] = $row['image_path'];
    }

    if (empty($_FILES["file"]["name"]) && ($_SESSION['image_path'] == null)) {
        $fnEr = "true";
    } else if ($_SESSION['image_path'] != null) {
        $fileName = $_SESSION['image_path'];
    } else {
        $fileName = basename($_FILES["file"]["name"]);
    }

    if (empty($nameEr) && empty($rateEr) && empty($linkEr) && empty($contentEr) && empty($fnEr)) {

        if ($fileName == $_SESSION['image_path']) {
            $sql = ("UPDATE  blogs  set blog_name='$name',rating='$rate',map_links='$link',content='$text' WHERE blog_id=$id") or die($mysqli->error);
            mysqli_query($con, $sql);
            if (mysqli_query($con, $sql)) {
                $_SESSION['blog'] = "Blog has been updated";}

        } else {
            $targetDir = "img/";
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    $insert = 'img/' . $fileName;
                } else {
                    $cdir = "couldnt move to dir";
                }
            } else {
                $ctype = " file type not allowed";
            }

            if ($insert) {
                $sql = ("UPDATE  blogs  set blog_name='$name',image_path='$insert',rating='$rate',map_links='$link',content='$text' WHERE blog_id=$id") or die($mysqli->error);
                mysqli_query($con, $sql);
                if (mysqli_query($con, $sql)) {
                    $_SESSION['blog'] = "Blog has been updated";
                }
            }

        }

        // activity level:
        $ids = $_POST['acid'];
        $activity = $_POST['activity'];
        $level = $_POST['level'];
        for ($i = 0; $i < sizeof($activity); $i++) {
            $sql = "UPDATE activities  SET activity=\"$activity[$i]\", activity_level=\"$level[$i]\"  WHERE  activity_id=\"$ids[$i]\"";
            mysqli_query($con, $sql);
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
                        if ($con->query("INSERT INTO blog_images (blog_id,image_path) VALUES ('$id','$insertValuesSQL')")) {

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
        if ($rateEr) {$_SESSION['rateEr'] = "* Required feild ";}
        if ($contentEr) {$_SESSION['contentEr'] = "* Required feild ";}
        if ($fnEr) {$_SESSION['fnEr'] = "* Required feild ";}
        if ($linkEr) {$_SESSION['linkEr'] = "* Required feild ";}
    }

    header("Location:blogEdit.php?editB=$id");
}
