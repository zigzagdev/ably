<?php
include ('./partials/LoginAccount.blade.php');

  if(isset($_SESSION['add_fail_up']))
  {
    echo  $_SESSION['add_fail_up'];
    unset($_SESSION['add_fail_up']);
  }

  if(isset($_GET['account_id']))
  {
    $account_id = $_GET['account_id'];
    $sql = "SELECT password FROM tbl_account WHERE account_id=$account_id";
    $rec = mysqli_query($connect, $sql);

    if ($rec == true)
    {
      $count = mysqli_num_rows($rec);
      if ($count == 1)
      {
        $row = mysqli_fetch_assoc($rec);
      } else
      {
        header('Location: '. $_SERVER['HTTP_REFERER']);
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
            <input type="password" name="password" size="40">
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
            <input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
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
    $password   = md5($_POST['password']);
    $password2  = md5($_POST['password2']);
    $account_id = $_GET['account_id'];

    if ($password != $password2)
    {
      $_SESSION['add_fail_up'] = "<div class='error'>Passwords should the same one !</div>";
      header("http://localhost:8001/account/UpdatePassword.blade.php?account_id=$account_id");
      die();
    }
    if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password)) {
      $_SESSION['add_fail_up'] = "<div class='error'>Password form isn't right form !</div>";
      header("http://localhost:8001/account/UpdatePassword.blade.php?account_id=$account_id");
      die();
    }

    if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password2)) {
      $_SESSION['add_fail_up'] = "<div class='error'>Confirm Password form isn't right form !</div>";
      header("http://localhost:8001/account/UpdatePassword.blade.php?account_id=$account_id");
      die();
    }

    $sql ="SELECT
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
      $_SESSION['add_fail_up'] =  "<div class='success'>Password already exists</div>";
      header("Location:http:/localhost:8001/accountAddAccount.php");
      die();
    }

    $upsql = "UPDATE
                  tbl_account
                SET
                  password='$password'
              WHERE
                  account_id=$account_id
               ";
    $uprec = mysqli_query($connect, $upsql);

    if($uprec == true)
    {
      $_SESSION['change-pwd'] = "<div class='success text-center'>Your Password was Updated.</div>";
      header("Location:http:/localhost:8001/account/ManageAccount.php?account_id=$account_id", 302);
      die();
    } else
    {
      $_SESSION['add_fail_up'] = "<div class='success text-center'>Your Password Update was Failed.</div>";
      header("Location:http:/localhost:8001/account/UpdatePassword.blade.php?account_id=$account_id", 401);
      die();
    }
  }
  include('../account/partials/Footer.tpl');
?>
