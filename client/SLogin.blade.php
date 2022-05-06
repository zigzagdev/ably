<?php
include('../config/Constants.blade.php');
include ('../account/partials/ClientHeader.tpl');

  if(isset($_SESSION['pwd_error_client']))
  {
    echo $_SESSION['pwd_error_client'];
    unset($_SESSION['pwd_error_client']);
  }
?>

<html>
  <head>
    <title>LogIn Page(Student)</title>
    <link rel="stylesheet" href="../css/Account.css">
  </head>
  <body>
    <div style="text-align: right; margin:30px 160px 0 0">
      <strong>Haven't create an account ?<a href="" style="margin-left: 10px; text-decoration: none; color: darkcyan">Create</a></strong>
    </div>
    <div style="margin: 50px 400px 25px 400px">
      <div class="mainaccount">
        <h2 style="text-align: center; padding-top: 18px">Sign In(Student)</h2>
        <form method="post" action="">
          <li style="list-style: none;  margin:22px 0 22px 30px">
            <b style="font-size: 20px;width:100px;margin:0 30px 0 100px; float: left;">
              E-mail
            </b>
            <input type="email" required name="email" size="40px" style="height: 35px">
          </li>
          <li style="list-style: none;  margin:22px 0 22px 30px">
            <b style="font-size: 20px;width:100px;margin:0 30px 0 100px;float: left;">
              Password
            </b>
            <input type="password" required name="password" size="40px" style="height: 35px">
          </li>
          <li style="list-style: none;  margin:22px 0 22px 30px">
            <a href="./PassForget.blade.php" class="passwordforgot">
              Forgot your password?
            </a>
          </li>
          <li style="list-style: none;  margin:42px 0 22px 30px">
            <b style="font-size: 20px;width:100px;margin:0 30px 0 100px;">
              <input type="submit" name="submit" value="Login" class="btn-third">
            </b>
          </li>
        </form>
      </div>
    </div>
  </body>
</html>

<?php

if(isset($_POST['submit']))
{
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $sql   = "SELECT email, password FROM tbl_client WHERE email='$email' AND password='$password'";
  $rec   = mysqli_query($connect, $sql);
  $count = mysqli_num_rows($rec);

  if($count==1)
  {
    $row = mysqli_fetch_assoc($rec);
    $client_id  = $row['client_id'];
    $name       = $row['name']

    $_SESSION['s_login'] = "<div class='success'>Login Successful.</div>";
    $_SESSION['email'] = $email;
    header("Location:http://localhost:8001/client/ClientPage.php?client_id=$client_id");
    exit();
  } else
  {
    $_SESSION['pwd_error_client'] = "<div class='success' style='text-align: center; font-size: 20px'>Username or Password did not match.</div>";
    header('Location:SLogin.blade.php');
  }
}
include ('../account/partials/ClientFooter.tpl');
?>