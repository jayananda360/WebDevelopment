<!DOCTYPE html>
<html>
<head>
<style>
        table {
            text-align: center;
            border: 4px solid black;
            border-collapse: collapse;
            width: 100%;
            height: 100px;
        }

        th {
            border-collapse: collapse;
            border: 4px solid black;
            font-family: 'Roboto', sans-serif;
            font-weight: 35px;
            font-size: 30px;
            height: 45px;
            width: 60px;

        }

        td {
            border-collapse: collapse;
            border: 4px solid black;
            width: 60px;
            height: 45px;
            font-size: 20px;
            font-weight: 67px;
            font-family: oblique;
            color: #000000;

        }
    </style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="css/StyleSeet.css">
	<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
	<title>Customer Details</title>
</head>

<body>
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
	<div class="headd">
		<u style=color:black;><h3 style="color:black; text-align:center;">WELCOME TO CUSTOMER DETAILS PAGE</h3></u>
	</div>
    <hr>
	<div class="Mar">
		<marquee style="color:black;" direction="left">Our Customer credentials are 100% Confidential!</marquee>
	</div>
    <hr>
	<?php
	include 'config.php';
	$sql = "SELECT * FROM cust_det";
	$result = mysqli_query($conn, $sql);
	?>

	<div class="container">
		<h2 style="color:black; text-align:center;">Transfer Money</h2>
		<br>
		<div class="row">
			<div class="col">
				<div class="table-responsive-sm">
        <table class="table table-danger table-striped">

						<tr>
							<th scope="col" class="text-center py-2">ID</th>
							<th scope="col" class="text-center py-2">Name</th>
							<th scope="col" class="text-center py-2">E-Mail</th>
							<th scope="col" class="text-center py-2">Phone NO</th>
							<th scope="col" class="text-center py-2">Balance</th>
							<th scope="col" class="text-center py-2">Operation</th>
						</tr>
						</thead>
						<tbody>
							<?php
							while ($rows = mysqli_fetch_assoc($result)) {
							?>
              <div class="table"> 
								<tr style=color:black;>
									<td class="py-2"><?php echo $rows['sno'] ?></td>
									<td class="py-2"><?php echo $rows['name'] ?></td>
									<td class="py-2"><?php echo $rows['Email'] ?></td>
									<td class="py-2"><?php echo $rows['Phone No'] ?></td>
									<td class="py-2"><?php echo $rows['Balance'] ?></td>
									<td><a href="transfer.php?id= <?php echo $rows['sno']; ?>"> <button type="button" class="btn btn-outline-dark">View And Transact</button></a></td>
								</tr>
              </div>
							<?php
							}
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

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
</body>
</html>
