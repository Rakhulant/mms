<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


if (empty($_SESSION['username'])) {
  header('location:index.php');
}
mysqli_select_db($con, 'mms');
?>

<style>
  table, th, td {
  border: 2px solid;
  padding: 20px;
}
</style>

<?php
$username = $_SESSION['username'];
$q1 = "select * from owner where username='$username'";
$res1 = mysqli_query($con, $q1);
$row1 = mysqli_fetch_assoc($res1);
$q2 = "select * from shop where owner_id = (select owner_id from owner where username='$username')";
$res2 = mysqli_query($con, $q2);
$q3 = "select * from shop where owner_id = (select owner_id from owner where username='$username')";
$res3 = mysqli_query($con, $q3);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>owner</title>
</head>

<body>
  <div class="card">
    <div class="card-header">
      MMS
      <div style="display:flex;float:right">
        <form method="POST" action="index.php">
          <input type="hidden" value="logout" name="type">
          <button type="submit" class="btn btn-primary"> LOG OUT </button>
        </form>
      </div>
    </div>
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Owner's page</h5>
    </div>
  </div>

  <div style="display:flex;justify-content: space-around;">
    <div class="row">
      <div class="card-body" style="margin: 150px;border: 2px solid ;border-radius: 10px;width: 40vw">
        <h3 style="text-align:center;">details</h3>
        <div class="column">
          <span class="d-block p-2 text-bg-primary">Name : <?php echo $row1['name']; ?></span>
          <span class="d-block p-2 text-bg-dark">ID : <?php
                                                      echo $row1['owner_id'] ?> </span>
          <span class="d-block p-2 text-bg-dark">Address : <?php
                                                            echo $row1['address'] ?> </span>
          <span class="d-block p-2 text-bg-dark">Phone : <?php
                                                          echo $row1['phone'] ?> </span>
          <span class="d-block p-2 text-bg-dark">Email : <?php
                                                          echo $username ?> </span>
          <span class="d-block p-2 text-bg-primary">List of shops : </span>
          <?php

          while ($row2 = mysqli_fetch_array($res2)) {

          ?>
            <li class="list-group-item"><?php printf($row2['name']) ?></li>
          <?php
          }
          ?>
          <span class="d-block p-2 text-bg-primary" style="padding: top 30px;">This weeks stats of shop: </span>
          <span class="d-block p-2 text-bg-dark">

            <table style="margin:20px auto ;width:max-content;">
              <tr>
                <th>Name</th>
                <th>Top Line</th>
                <th>Bottom Line</th>
              </tr>
              <?php
              while ($row3 = mysqli_fetch_array($res3)) {
              ?>
                <tr>
                  <td><?php echo $row3['name'] ?></td>
                  <td>
                  <?php 
                  $q4 = "select * from transaction where shop_id='$row3[shop_id]'";
                  $res4 = mysqli_query($con, $q4);
                  $sum=0;
                  $profit = 0;
                while ($row4 = mysqli_fetch_array($res4)){
                    $q5 = "select * from product where product_id='$row4[product_id]'";
                    $res5 = mysqli_query($con, $q5);
                    $row5 = mysqli_fetch_array($res5);
                    $sum += $row4['quantity']*$row5['s_price'];
                    $profit += ( ($row4['quantity']*$row5['s_price'])-($row4['quantity']*$row5['price']) );
                 }
                  echo $sum; 
                  ?> 
                  </td>
                  <td><?php echo $profit; ?></td>
                </tr>
              <?php } ?>
            </table>

          </span>
        </div>

      </div>



    </div>


  </div>

  </div>
</body>

</html>