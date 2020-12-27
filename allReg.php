<?php require_once 'connection.php';
$sql="SELECT event_name,full_name,gender,email,phone_nb,age FROM events LEFT JOIN event_regestrations ON events.event_id = event_regestrations.event_id WHERE full_name!='' ORDER BY events.event_id DESC  ";
    $result = mysqli_query($con, $sql);

?>
<!DOCTYPE html>
<html>
 <head>
 <title> Event Registers </title>
 <link rel="stylesheet" href="table.css">
 <link rel="stylesheet" href="/css/all.css">
 </head>
<body>
    
    <h1>Event Registors  </h1>
    <?php
if (mysqli_num_rows($result) > 0) {
    ?>
    <i  onclick="exportTableToExcel('tblData')" class="far fa-file-excel"></i> Export
    <div class="table-users">
    
  <table id="tblData" cellpadding="0" >
  <thead>
    <tr id="th">
    <th>Event Name</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone Number </th>
    <th> Age </th>
    <th> Gender </th>
    </thead>
    </tr>

  <tbody>
<?php
$i = 0;
    while ($row = mysqli_fetch_array($result)) {
        ?>
<tr> <td><?php echo $row["event_name"]; ?></td>
    <td><?php echo $row["full_name"]; ?></td>
    <td> <a href="mailto:<?php echo $row['email']; ?>"> <?php echo $row['email']; ?> </a></td>
    <td> <a href="tel:<?php echo $row['phone_nb']; ?>"><?php echo $row['phone_nb']; ?> </a></td>
    <td><?php echo $row["age"]; ?></td>
    <td><?php echo $row["gender"]; ?></td>
</tr>
<?php
$i++;
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

