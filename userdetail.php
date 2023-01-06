<?php
include "index.php";

?>




<?php
include "connection.php";
if (isset($_POST['submit'])) {
  // AMOUNT ENTERED BY USER
  $amount = $_POST['amount'];



  //  SELECT AND TAKE EVERYTHING FROM SENDER
  $from = $_GET['id'];
  $sql1 = "SELECT * FROM customer WHERE id = $from";
  $Results = mysqli_query($mysqli, $sql1);
  $sqlRes = mysqli_fetch_array($Results);

  if ($amount == 0) {
    echo "<script> alert ('Error - zero value cannot be transferred');  </script>";
  } else if ($amount > $sqlRes['Balance']) {
    echo "<script> alert ('Insufficient value');  </script>";
  } else if ($amount < 0) {
    echo "<script> alert ('Error - negative value');  </script>";
  } else {


    // UPDATE THE BALANCE IN SENDER
    $newbalance = $sqlRes['Balance'] - $amount;
    $sql = "UPDATE customer set Balance = $newbalance WHERE id = $from";
    mysqli_query($mysqli, $sql);

    //  SELECT AND TAKE EVERYTHING FROM RECIEVER 
    $to = $_POST['to'];
    $sql = "SELECT * FROM customer WHERE id =$to ";
    $result = mysqli_query($mysqli, $sql);
    $final = mysqli_fetch_array($result); //converted into the string

    // UPDATE THE BALANCE OF RECIEVER
    $newbalance = $final['Balance'] + $amount;
    $sql = "UPDATE customer SET Balance = $newbalance WHERE id = $to";
    mysqli_query($mysqli, $sql);






    $sname = $sqlRes['Name'];
    $rname = $final['Name'];
    $Amount = $amount;


    $sql = "INSERT INTO t(`sender`,`reciever`,`Amount`) VALUES  ('$sname','$rname','$Amount')";
    $query = mysqli_query($mysqli, $sql);

    if ($query) {
      echo "<script> alert ('successful');
          </script>";
    }

    $newbalance = 0;
    $amount = 0;

  }

}

?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
    if(window.history.replaceState)
    {
      window.history.replaceState(null,null,window.location.href);
    }
  </script>
  <title>Document</title>
</head>

<body>

<!-- DETAIL OF SENDERS -->


  <?php
  include "connection.php";
    $id = $_GET['id'];
      $sql = "SELECT * FROM customer WHERE id = $id ";
   $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

      ?>
      <section>

        <div class="name">

          <h2>Hii,<span>
              <h2><?php echo $row['Name']; ?></h2>
            </span></h2>


        </div>
        <h5>Account details</h5>
        <div class="container">
          <div class="detail">

            <h4>Account number</h4>
            <p>
              <?php echo $row['Account_number']; ?>
            </p>
          </div>
          <div class="detail">

            <h4>Email</h4>
            <p><?php echo $row['Email']; ?></p>
          </div>
          <div class="detail">

            <h4>Balance</h4>
            <p>
              <?php echo $row['Balance']; ?>
            </p>
          </div>

        </div>
      </section>
    <?php }

  }
  $mysqli->close();
  ?>


<!-- TRANSFER MOENEY  -->

  <div class="section2">
    <div class="head">

      <div class="header">
        <h1>Transfer money</h1>
      </div>
    </div>

    <div class="box">
      <div class="form">

<!-- FORM START  -->
  
        <form method="post" >

          <div>
 
            <select name="to" required>
              <option value="" disabled selected>Name of the reciever</option>

              <?php
              include "connection.php";
              $senid = $_GET['id'];
              $sql1 = "SELECT * FROM customer WHERE id !=$senid";
              $Result1 = $mysqli->query("$sql1");

              if ($Result1->num_rows > 0) {
                while ($row = $Result1->fetch_assoc()) {
                  ?>

                  <option value="<?php echo $row['id']; ?> ">
                    <?php
                    echo $row['Name'];

                    ?>
                  </option>

                  <?php
                }
              }
              $mysqli->close();
              ?>
            </select>
          </div>

          <div>
            <input type="Number" placeholder="Amount to be transfer" name="amount">
          </div>
          <div class="butto"><input type="submit"  name = "submit" style="width: 150px; padding-left:0px;"> </div>
        </form>


      </div>

    </div>

  </div>


 
</body>

</html>