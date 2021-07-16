<?php
include 'config.php';

if (isset($_POST['submit'])) {
  $from = $_GET['id'];
  $to = $_POST['to'];
  $amount = $_POST['amount'];

  $sql = "SELECT * from cust_det where sno=$from";
  $query = mysqli_query($conn, $sql);
  $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

  $sql = "SELECT * from cust_det where sno=$to";
  $query = mysqli_query($conn, $sql);
  $sql2 = mysqli_fetch_array($query);



  // constraint to check input of negative value by user
  if (($amount) < 0) {
    echo '<script type="text/javascript">';
    echo ' alert("Sorry! Negative values cannot be transferred")';  // showing an alert box.
    echo '</script>';
  }



  // constraint to check insufficient Balance.
  else if ($amount > $sql1['Balance']) {

    echo '<script type="text/javascript">';
    echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
    echo '</script>';
  }



  // constraint to check zero values
  else if ($amount == 0) {

    echo "<script type='text/javascript'>";
    echo "alert('Sorry! Zero value cannot be transferred')";
    echo "</script>";
  } else {

    // deducting amount from sender's account
    $newBalance = $sql1['Balance'] - $amount;
    $sql = "UPDATE cust_det set Balance=$newBalance where sno=$from";
    mysqli_query($conn, $sql);


    // adding amount to reciever's account
    $newBalance = $sql2['Balance'] + $amount;
    $sql = "UPDATE cust_det set Balance=$newBalance where sno=$to";
    mysqli_query($conn, $sql);

    $sender = $sql1['name'];
    $receiver = $sql2['name'];
    $sql = "INSERT INTO trans_his(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
      echo "<script> alert('Transaction Successful');
                                     window.location='transferdetails.php';
                           </script>";
    }

    $newBalance = 0;
    $amount = 0;
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <title>Transfer</title>
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="css/webpage.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&family=Roboto:wght@300&display=swap');
  </style>
</head>

<body class="bod">
<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" id="nav-bar">
            <a class="navbar-brand" href="index.html"><img src="images/logo.png" width="140px" height="50px"
                    alt="SBI Bank"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewusers.php">Customer Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transferdetails.php">Transaction History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://thesparksfoundationsingapore.org/" target="_blank">Contact
                            US</a>
                    </li>
                </ul>
                <a class="nav-link d-flex" href="transfer.php">
                    <button class="btn btn-outline-warning" id="btn" type="submit">Money Transfer</button>
                </a>
            </div>
        </div>
    </nav>
  <!-- End Navbar -->

  <!-- Table -->
  <div class="container">
    <h2 class="text-center pt-4" style=color:black;>Transaction</h2>
    <label style=color:black;><b>Transfer from:</b></label>
    <?php
    include 'config.php';
    $sid = $_GET['id'];
    $sql = "SELECT * FROM  cust_det where sno=$sid";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      echo "Error : " . $sql . "<br>" . mysqli_error($conn);
    }
    $rows = mysqli_fetch_assoc($result);
    ?>
    <form method="post" name="tcredit" class="tabletext"><br>
      <div>
        <table class="table table-striped table-hover">


          <tr style="color : white;" class="table-dark">
            <th scope="col" class="text-center py-2">Sno</th>
            <th scope="col" class="text-center py-2">Name</th>
            <th scope="col" class="text-center py-2">E-Mail</th>
            <th scope="col" class="text-center py-2">Phone NO</th>
            <th scope="col" class="text-center py-2">Balance</th>
          </tr>

          <tr style="color : black;">
            <td class="py-2"><?php echo $rows['sno'] ?></td>
            <td class="py-2"><?php echo $rows['name'] ?></td>
            <td class="py-2"><?php echo $rows['Email'] ?></td>
            <td class="py-2"><?php echo $rows['Phone No'] ?></td>
            <td class="py-2"><?php echo $rows['Balance'] ?></td>
          </tr>
        </table>
      </div>
      <label style=color:black;><b>Transfer to:</b></label>
      <select name="to" class="form-control" required>
        <option value="" disabled selected>CHOOSE the receiver</option>
        <?php
        include 'config.php';
        $sid = $_GET['id'];
        $sql = "SELECT * FROM cust_det where sno!=$sid";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
          echo "Error " . $sql . "<br>" . mysqli_error($conn);
        }
        while ($rows = mysqli_fetch_assoc($result)) {
        ?>
          <option class="table" value="<?php echo $rows['sno']; ?>">

            <?php echo $rows['name']; ?> (Balance:
            <?php echo $rows['Balance']; ?> )

          </option>
        <?php
        }
        ?>
        <div>
      </select>
      <label style=color:black;><b>Amount:</b></label>
      <input type="number" class="form-control" name="amount" required>
      <br>
      <div style="color: #ffffff;text-align: center; class=" text-center">
        <button class="btn btn-outline-dark" name="submit" type="submit" id="myBtn">Transfer</button>
      </div>
    </form>
  </div>
  <!-- End Table  -->
  <hr><marquee style="color:black;" direction="left">Quick & Secure Transaction !</marquee><hr>
  <!-- Footer -->
<br>
<div style="padding-top: 20px; background-color: rgb(0, 113, 179); margin-top: 10px; border: 2px solid black;">
        <div class="bankimg">
            <img src="images/bankimg.png" height="100" width="120">
        </div>
        <center>
            <footer>
                <div id="contact">
                    <div class="follow">
                        <h3 style="color: rgba(0, 0, 0, 0.788); font-family: 'Baloo Bhai 2', cursive; font-size: 17px;">
                            Follow Us</h3>
                        <div class="social">
                            <a href="https://www.facebook.com" target="_blank" class="facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="https://www.twitter.com" target="_blank" class="twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/jayanandajena/" target="_blank" class="linkedin">
                                <i class="fa fa-linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/jjayananda97/" target="_blank" class="instagram">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <p class="text-copy" font-size: 17px ; style="color: #0c0c0cdc;">
                    Copyright &copy; 2021 All rights reserved
                </p>
            </footer>
        </center>
    </div>
  <!-- End Footer -->
</body>
</html>
