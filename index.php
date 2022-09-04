<html>


<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


mysqli_select_db($con, 'mms');
?>

<head>
  <meta charset="utf-8">
  <title>MMS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

  <script type="text/javascript">
    console.log("hello");

    function jsFunction(error) {
      alert(error);
    }
  </script>

  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
            </div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans30s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a href="http://blog.stackfindover.com/" rel="dofollow">Mall Management System(MMS)</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="col" style="padding: 20px;">
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group mt-4">
                  <input type="hidden" name="type" value="login">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit"  class="btn btn-primary" style="margin: 20px auto;width: max-content;">Login</button>
              </form>
              <?php
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // collect value of input field


                $type = $_POST['type'];
                if ($type == 'register') {
                  if (empty($name)) {
                    echo '<br>Email is empty';
                  }
                  if (empty($pass)) {
                    echo '<br>Password is empty';
                  }
                  $name = $_POST['Email'];
                  $pass = $_POST['pass'];

                  $q = " select * from users where username = '$name'";
                  $res = mysqli_query($con, $q);

                  if (mysqli_num_rows($res) == 1) {
                    echo '<br>User already exists';
                  } else {
                    $i = " insert into users values('$name', '','admin', '$pass')";
                    mysqli_query($con, $i);
                    echo '<script>jsFunction(\'User registration successfull\');</script>';
                  }
                } else if ($type == 'login') {

                  if (empty($name)) {
                    echo '<br>Email is empty';
                  }
                  if (empty($pass)) {
                    echo '<br>Password is empty';
                  }
                  $name = $_POST['Email'];
                  $pass = $_POST['pass'];

                  $q = " select * from users where username = '$name' and password = '$pass'";
                  $res = mysqli_query($con, $q);

                  $store =  mysqli_fetch_array($res)['user_type'];


                  if (mysqli_num_rows($res) == 0) {
                    echo '<br>User credentials incorrect';
                  } else {
                    $_SESSION['username'] = $name;
                    if ($store == 'admin') {
                      header('location:admin.php');
                    } else if ($store == 'shop_manager') {
                      header('location:shopmanager.php');
                    } else if ($store == 'owner') {
                      header('location:owner.php');
                    } else if ($store == 'floor_manager') {
                      header('location:floor.php');
                    }
                  }
                } else if ($_POST['type'] == 'logout') {
                  $_SESSION['username'] = null;
                }
              }
              ?>
            </div>
          </div>
          <div class="footer-link padding-top--24">
            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
              <span><a href="#">© MMS</a></span>
              <span><a href="#">Contact</a></span>
              <span><a href="#">Privacy & terms</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>