<?php
include "index.php";
include "connection.php";

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
<div class="tabls">
     <Table class ="tb">
        <tr>
            <th>S.no</th>
            <th>Sender</th>
            <th>Reciever</th>
            <th>Amount</th>

        </tr>
   <?php
   $sql = "SELECT * FROM t ";
   $result =  mysqli_query($mysqli, $sql);
   
  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

   ?>
        <tr>
            <td><?php echo $row['S.no']?></td>
            <td><?php echo $row['sender']?></td>
            <td><?php echo $row['reciever']?></td>
            <td><?php echo $row['Amount']?></td>
        </tr>

        
<?php 
      }

}
?>
     </Table>
     </div>
</body>
</html>