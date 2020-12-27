<?php require_once 'connection.php';
if (isset($_GET['reg']))
 {
    $id = $_GET['reg'];
    $result = mysqli_query($con, "SELECT * FROM event_regestrations WHERE event_id=$id ORDER BY id DESC");
}

?>
<!DOCTYPE html>
<html>
 <head>
 <title> Event Registers </title>
 <link rel="stylesheet" href="table.css">
 <link rel="stylesheet" href="/css/all.css">

 </head>
<body>
    
    <h1>Event Registers  </h1>
    <?php
if (mysqli_num_rows($result) > 0) {
    ?>
     <i  onclick="exportTableToExcel('tblData')" class="far fa-file-excel"></i> Export
    <div class="table-users">
   
  <table  id="tblData" cellpadding="0" >
  <thead>
    <tr id="th">
    <th>Name</th>
    <th>Email</th>
    <th>Phone Number </th>
    <th> Age </th>
    <th> Gender </th>
    </thead>
    </tr>

  <tbody>
<?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
<tr>
    <td><?php echo $row["full_name"]; ?></td>
    <td><a href="mailto:<?php echo $row['email']; ?>"> <?php echo $row['email']; ?></a></td>
    <td><a href="tel:<?php echo $row['phone_nb']; ?>"><?php echo $row['phone_nb']; ?> </a></td>
    <td><?php echo $row["age"]; ?></td>
    <td><?php echo $row["gender"]; ?></td>
</tr>
<?php
    }
    ?>
 </tbody>
</table>
</div>
 <?php
} else {
    echo "No result found";
}
?>



<!-- js export button  -->
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>


 </body>
</html>

