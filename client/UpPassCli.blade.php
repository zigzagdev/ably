<?php
include ('./partials/HeaderEd.blade.php');

if(isset($_SESSION['add_fail_up_c']))
{
  echo  $_SESSION['add_fail_up_c'];
  unset($_SESSION['add_fail_up_c']);
}

if(isset($_GET['client_id']))
{
  $client_id = $_GET['client_id'];
  $sql = "SELECT password FROM tbl_client WHERE client_id=$client_id";
  $rec = mysqli_query($connect, $sql);

  if ($rec == true)
  {
    $count = mysqli_num_rows($rec);
    if ($count == 1)
    {
      $row = mysqli_fetch_assoc($rec);
      $nowpassword = $row['password'];
    } else
    {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
?>
<html>
  <head>
    <title>UpdatePassword</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 230px">
      <div class="mainaccount">
        <h1 style="text-align: center; margin: 55px 0 50px 0; padding-top: 20px">Update your Password</h1>
        <form action="" method="post" enctype="multipart/form-data" style="">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
              CurrentPassword
            </b>
            <input type="password" name="current" size="40">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
              NewPassword
            </b>
            <input type="password" name="password" size="40">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
              NewPasswordAgain
            </b>
            <input type="password" name="password2" size="40">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <div style="text-align: center; margin-top: 30px">
            <input type="submit" name="submit" value="Update your Account" class="btn-secondary">
            <button type="button" onclick=history.back() class="btn-secondary">Return</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>

<?php

if(isset($_POST['submit']))
{
  $current   = md5($_POST['current']);
  $password  = md5($_POST['password']);
  $password2 = md5($_POST['password2']);
  $client_id = $_GET['client_id'];

  $sql = "SELECT
              tbl_account.password
            FROM
              tbl_account
          LEFT JOIN
              tbl_client
            ON
              tbl_account.password= tbl_client.password
            WHERE
              tbl_account.password='$password'
          UNION
          SELECT
              tbl_client.password
            FROM
              tbl_account
          RIGHT JOIN
              tbl_client
            ON
              tbl_account.password= tbl_client.password
          WHERE
              tbl_client.password='$password'
           ";
  $rec  = mysqli_query($connect,$sql);
  $rec2 = mysqli_num_rows($rec);

  if ($rec2 > 0) {
    $_SESSION['add_fail_up_c'] =  "<div class='success'>Password already exists</div>";
    header("location:http://localhost:8001/client/UpPassCli.blade.php?client_id=$client_id");
    die();
  }
  if ($current != $nowpassword)
  {
    $_SESSION['add_fail_up_c'] = "<div class='error'>Your now Password didn't match !</div>";
    header("location:http://localhost:8001/client/UpPassCli.blade.php?client_id=$client_id");
    die();
  }
  if ($password != $password2)
  {
    $_SESSION['add_fail_up_c'] = "<div class='error'>Passwords should the same one !</div>";
    header("location:http://localhost:8001/client/UpPassCli.blade.php?client_id=$client_id");
    die();
  }
  if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password)) {
    $_SESSION['add_fail_up_c'] = "<div class='error'>Password form isn't right form !</div>";
    header("location:http://localhost:8001/client/UpPassCli.blade.php?client_id=$client_id", 302);
    die();
  }
  if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password2)) {
    $_SESSION['add_fail_up_c'] = "<div class='error'>Confirm Password form isn't right form !</div>";
    header("location:http://localhost:8001/client/UpPassCli.blade.php?client_id=$client_id", 302);
    die();
  }

  $upsql = "UPDATE tbl_client SET password='$password' WHERE client_id=$client_id ";
  $uprec = mysqli_query($connect, $upsql);

  if($uprec == true)
  {
    $_SESSION['change_pwd_c'] = "<div class='success text-center'>Your Password was Updated.</div>";
    header("Location:http:/localhost:8001/client/ClientPage.php?client_id=$client_id", 201);
  } else
  {
    $_SESSION['add_fail_up_c'] = "<div class='success text-center'>Your Password Update was Failed.</div>";
    header("Location:http:/localhost:8001/client/UpPassCli.blade.php?client_id=$client_id", 302);
  }
}
include('./partials/FooterEd.tpl');
?>
