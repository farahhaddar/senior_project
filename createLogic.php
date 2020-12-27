<?php
require_once 'connection.php';

//create event

if (isset($_POST['submit2'])) {
    $name = $date = $content = $fileName = "";
    $nameEr = $dateEr = $contentEr = $fnEr = "";

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

    if (empty($_POST['tx'])) {
        $contentEr = "true";
    } else {
        $content = base64_encode($_POST['tx']);
    }
    if (empty($_FILES["file"]["name"])) {
        $fnEr = "true";
    } else {
        $fileName = basename($_FILES["file"]["name"]);
    }
    $targetDir = "img/";
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (empty($nameEr) && empty($dateEr) && empty($contentEr) && empty($fnEr)) {

        if (!empty($_FILES["file"]["name"])) {
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
        }
        if (!empty($insert)) {

            $sql = ("INSERT INTO events (event_name,post,image_path,date) VALUES ('$name','$content','$insert','$date')") or die($mysqli->error);
        }
        if (mysqli_query($con, $sql)) {
            // Obtain last inserted id
            $id = $con->insert_id;
            $_SESSION['id2'] = $id;
        }

        ///multiple images

        $targetDir = "img/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        $fileNames = array_filter($_FILES['files']['name']);
        if (!empty($fileNames)) {
            foreach ($_FILES['files']['name'] as $key => $val) {
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                        $insertValuesSQL = $targetDir . $fileName;
                        $id = $_SESSION['id2'];
                        $insert = $con->query("INSERT INTO event_images (event_id,image_name) VALUES ('$id','$insertValuesSQL')");
                        // die("INSERT INTO blog_images (blog_id,image_name) VALUES ('$id',$insertValuesSQL)");

                    } else {
                        $imgsdir = "couldnt upload iamges to dir";
                    }
                } else {
                    $imgstype = " file type not allowed";
                }
            }

        }

        if ($cdir || $ctype || $imgsdir || $imgstype) {
            $_SESSION['cdir'] = $cdir;
            $_SESSION['ctype'] = $ctype;
            $_SESSION['imgsdir'] = $imgsdir;
            $_SESSION['imgstype'] = $imgstype;

        } else {
            $_SESSION['events'] = "Event added successfully";
        }
    } else {
        if ($nameEr) {$_SESSION['nameEr'] = "* Required feild ";}
        if ($dateEr) {$_SESSION['dateEr'] = "* Required feild ";}
        if ($contentEr) {$_SESSION['contentEr'] = "* Required feild ";}
        if ($fnEr) {$_SESSION['fnEr'] = "* Required feild ";}
    }

    header("location:createEvent.php");
}

//create event end

// create blog

if (isset($_POST['submit'])) {
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

    if (empty($_POST['tx'])) {
        $contentEr = "true";
    } else {
        $content = base64_encode($_POST['tx']);
    }
    if (empty($_FILES["file"]["name"])) {
        $fnEr = "true";
    } else {
        $fileName = basename($_FILES["file"]["name"]);
    }
    $targetDir = "img/";
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (empty($nameEr) && empty($rateEr) && empty($linkEr) && empty($contentEr) && empty($fnEr)) {

        if (!empty($_FILES["file"]["name"])) {
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
        }
        if (!empty($insert)) {

            $sql = ("INSERT INTO blogs (blog_name,image_path,rating,map_links,content) VALUES ('$name','$insert','$rate','$link','$content')") or die($mysqli->error);
        }
        if (mysqli_query($con, $sql)) {
            // Obtain last inserted id
            $id = $con->insert_id;
            $_SESSION['id'] = $id;
        }

        ///multiple images
        
        $fileNames = array_filter($_FILES['files']['name']);
        if (!empty($fileNames)) {
            foreach ($_FILES['files']['name'] as $key => $val) {
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                        $insertValuesSQL = $targetDir . $fileName;
                        $id = $_SESSION['id'];
                        $insert = $con->query("INSERT INTO blog_images (blog_id,image_path) VALUES ('$id','$insertValuesSQL')");
                        // die("INSERT INTO blog_images (blog_id,image_name) VALUES ('$id',$insertValuesSQL)");

                    } else {
                        $imgsdir = "couldnt upload iamges to dir";
                    }
                } else {
                    $imgstype = " file type not allowed";
                }
            }

        }

        // activity level:

        foreach ($_POST['activity'] as $row => $value) {
            if (isset($_POST['activity'])) {
                $id = $_SESSION['id'];
                $activity = $_POST['activity'][$row];
                $level = $_POST['level'][$row];
                $sql = "INSERT INTO activities (blog_id	,activity,activity_level) VALUES ('$id','$activity','$level')";
                mysqli_query($con, $sql);
            } else {
                break;
            }
        }

        if ($cdir || $ctype || $imgsdir || $imgstype || $aclevelEr) {
            $_SESSION['cdir'] = $cdir;
            $_SESSION['ctype'] = $ctype;
            $_SESSION['imgsdir'] = $imgsdir;
            $_SESSION['imgstype'] = $imgstype;
        } else {
            $_SESSION['blogs'] = "Blog added successfully";
        }
    } else {
        if ($nameEr) {$_SESSION['nameEr'] = "* Required feild ";}
        if ($rateEr) {$_SESSION['rateEr'] = "* Required feild ";}
        if ($contentEr) {$_SESSION['contentEr'] = "* Required feild ";}
        if ($fnEr) {$_SESSION['fnEr'] = "* Required feild ";}
        if ($linkEr) {$_SESSION['linkEr'] = "* Required feild ";}
    }

    header("location:createBlog.php");
}
