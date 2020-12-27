<?php require_once 'connection.php';
$result = mysqli_query($con, "SELECT * FROM contacts ORDER BY contact_id DESC  ");
?>
<!DOCTYPE html>
<html>
 <head>
 <title> Contacts </title>
 <link rel="stylesheet" href="table.css">
 <link rel="stylesheet" href="/css/all.css">
 </head>
<body>

<h1>Contacts</h1>
<?php
if (mysqli_num_rows($result) > 0) {
    ?>
    <i  onclick="exportTableToExcel('tblData')" class="far fa-file-excel"></i> Export
   <div class="table-users">
  <table  id="tblData">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Phone Number </th>
    <th> Comments </th>
  </tr>
  </thead>
  
  

  <tbody>
<?php
$i = 0;
    while ($row = mysqli_fetch_array($result)) {
        ?>
<tr>
    <td><?php echo $row["name"]; ?></td>
    <td> <a href="mailto:<?php echo $row['email']?>"><?php echo $row['email']?>   </a></td>
    <td> <a href="tel:<?php echo $row['phone_number']; ?>"> <?php echo $row['phone_number']; ?> </a></td>
    <td><?php echo $row["comment"]; ?></td>
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
