<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


mysqli_select_db($con, 'mms');
?>

<?php 
  $q = "select * from transaction t where t.shop_id IN(select shop_id from shop where name='H and M') order by t.transaction_id desc";
  $res = mysqli_query($con, $q);
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
      Featured
    </div>
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Shop managers page</h5>
    </div>
  </div>

  <div style="display:flex;justify-content: space-around;">
    <div class="row">
      <div class="card-body" style="margin: 150px;border: 2px solid ;border-radius: 10px;">
        <h3 style="text-align:center;">inventory</h3>
        <div class="column">
          <span class="d-block p-2 text-bg-primary">Products left : ------ </span>
          <span class="d-block p-2 text-bg-dark">Price of inventory : ----- </span>
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

                for($i=0;$i<2;$i++){
                  $row = mysqli_fetch_array($res);
                  ?>
                  <li class="list-group-item"><?php printf($row['transaction_id']);echo "<br>"; printf($row['datee']);?></li>
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
</body>

</html>

