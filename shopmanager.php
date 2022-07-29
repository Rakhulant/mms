<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


mysqli_select_db($con, 'mms');
?>

<?php
  $hesaru = "Dominos";
  $q1 = "select * from transaction t where t.shop_id IN(select shop_id from shop where name='$hesaru') order by t.transaction_id desc";
  $res1 = mysqli_query($con, $q1);
  $q2 = "select sum(quantity) as plus from goods where shop_id =(select shop_id from shop where name='$hesaru')";
  $q3 = "select sum(quantity) as minus from transaction where shop_id = (select shop_id from shop where name = '$hesaru')";
  $res2 = mysqli_query($con, $q2);
  $res3 = mysqli_query($con, $q3);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>shopmanager</title>
</head>

<body>
  <div class="card">
    <div class="card-header">
      MMS
    </div>
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Shop managers page</h5>
    </div>
  </div>

  <div style="display:flex;justify-content: space-around;" class="row">
    <div class="row">
      <div class="card-body" style="margin: 150px;border: 2px solid ;border-radius: 10px;">
        <h3 style="text-align:center;">inventory</h3>
        <div class="column">
          <span class="d-block p-2 text-bg-primary">Products left : <?php 
          $row2 = mysqli_fetch_assoc($res2);
          $row3 = mysqli_fetch_assoc($res3);
          echo $row2['plus']-$row3['minus'];
          ?> </span>
          <span class="d-block p-2 text-bg-dark">List of products left : ----- </span>
          <button type="button" class="btn btn-primary">Edit</button>
        </div>
      </div>

      <div class="row">
        <div class="card-body" style="margin: 150px;border: 2px solid ;border-radius: 10px;">
          <h3 style="text-align:center;">sales</h3>
          <div class="column">
            <span class="d-block p-2 text-bg-primary">Todays recent sales:</span>
            <span class="d-block p-2 text-bg-dark">
              <ul class="list-group">
                <?php 

                for($i=0;$i<1;$i++){
                  $row1 = mysqli_fetch_array($res1);
                  ?>
                  <li class="list-group-item"><?php printf($row1['transaction_id']);echo "<br>"; printf($row1['datee']);?></li>
                  <?php
                }
                ?>
              </ul>
            </span>
          </div>
        </div>
      </div>

    
    
    

    </div>
   

  </div>
  <div class="col" style="display: flex; justify-content: center;">
  <a href="/MMS/bill.php"><button type="submit" class="btn btn-primary"> Generate bill </button></a>
    <div>
</body>

</html>

