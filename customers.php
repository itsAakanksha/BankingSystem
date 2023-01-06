<?php
 include "index.php" ;
    
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

    <table class="tb" >
        <tr>
            <th>Account no.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Balance</th>
            <th>transaction</th>
        </tr>
   
        <?php
        include "connection.php";
         $sql = "SELECT * FROM customer";
         $result = $mysqli->query($sql);



            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

        ?>

<tr>
  
  <td><?php echo $row['Account_number']; ?></td>
  <td><?php echo $row['Name']; ?></td>
  <td><?php echo $row['Email']; ?></td>
  <td><?php echo "Rs ".$row['Balance']; ?></td>
  
  <td> <a href="userdetail.php?id=<?php echo $row['id'];?>">
    <button  type = "button" class = "btn">Transfer</button> </a></td>

   
</tr>

<?php       }

}

?>        
        
    </table>
</div>

</body>
</html>