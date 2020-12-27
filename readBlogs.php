<?php require_once 'connection.php'; ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin card</title>
    <link rel="stylesheet" href="card.css">
</head>
<body>

<?php
    if (isset($_POST['bss']))
    {
    $name = htmlspecialchars($_POST['search']);
    $query = "SELECT * FROM blogs WHERE blog_name LIKE " . "'%" . $name . "%' ";
    $result = mysqli_query($con,$query);
    }else 
        {
        $query = 'SELECT * FROM blogs ORDER by blog_name ASC ';
        $result = mysqli_query($con,$query);

        }
?>
  <!-- flexdisplay -->
  <div class="can">
  <?php
if($result): // if not die conn 
    if(mysqli_num_rows($result)>0)://has data in it 
        while($blog=mysqli_fetch_assoc($result)): //saving data  each row as obj in array product
            ?> 
            <div class="card">
                <img src="<?php echo $blog['image_path'];?>"  style="width:100%;height:14vw;
                 object-fit: cover;"> 
                <div class="container">
                    <h2><?php echo $blog['blog_name']?></h2>
                    <div class="b">
                    <!-- the href alloww us to get id from url and send it to connection file where api of edit and delete are  -->
                    <a href="blogEdit.php?editB=<?php echo $blog['blog_id'];?>">  <button  name="edit" id="b"  value="Edit" class=" button3"><i class="fas fa-edit"></i></button></a>
                    <a href="delete.php?del=<?php echo $blog['blog_id'];?>">  <button name="del" id="b" value="Del" class=" button4"><i class="fas fa-trash-alt"></i></button></a>
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

