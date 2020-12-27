<?php require_once 'connection.php'; ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin card</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php
// if(isset($_POSt['submit1']))
// {
    if (isset($_POST['bss']))
    {
    $name = htmlspecialchars($_POST['search']);
    $query = "SELECT * FROM events WHERE event_name LIKE " . "'%" . $name . "%' ";
    $result = mysqli_query($con,$query);
    }else 
    {
    $query = 'SELECT * FROM events ORDER by event_name ASC ';
    $result = mysqli_query($con,$query);
    }
?>
<!-- flexdisplay -->
<div class="can">
  <?php
if($result):// if not die conn 
    if(mysqli_num_rows($result)>0)://has data in it 
        while($blog=mysqli_fetch_assoc($result)): //saving data  each row as obj in array product
            ?> 
            <div class="card">
            <img src="<?php echo $blog['image_path'];?>"  style="width:100%;height:14vw;
                 object-fit: cover;"> 
                <div class="container">
                <h2><?php echo $blog['event_name']?></h2>
                    <div class="b">
                    <a href="eventEdit.php?editE=<?php echo $blog['event_id'];?>">  <button  name="editE" id="b"  value="edit" class=" button3"><i class="fas fa-edit"></i></button></a>
                    <a href="delete.php?delete=<?php echo $blog['event_id'];?>">  <button name="delete" id="b" value="Del" class=" button4"><i class="fas fa-trash-alt"></i></button></a>
                    <a href="reg.php?reg=<?php echo $blog['event_id'];?>">  <button name="reg" id="b" value="reg" class=" button5"><i class="fas fa-sm fa-users"></i> </button></a>
                    </div>
                </div>
            </div>
         
        <?php
        endwhile;
    endif;
endif;
?>
</div> 
<!-- end flex -->



    </body>
    </html>
    