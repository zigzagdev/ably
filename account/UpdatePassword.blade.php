<?php
include ('./partials/LoginAccount.blade.php');

session_start();

define('SITEURL', 'localhost:8001');
define('LOCALHOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'overcome');

$connect = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($connect));
$db_select = mysqli_select_db($connect, DB_NAME) or die(mysqli_error($connect));
date_default_timezone_set('Asia/Tokyo');

  if(isset($_GET['account_id']))
  {
    $account_id = $_GET['account_id'];
    $sql = "SELECT * FROM tbl_account WHERE account_id=$account_id";
    $rec = mysqli_query($connect, $sql);

    if ($rec == true)
    {
      $count = mysqli_num_rows($rec);
      if ($count == 1)
      {
        $row = mysqli_fetch_assoc($rec);
        $account_id  = $row['account_id'];
        $user_name   = $row['user_name'];
        $email       = $row['email'];
        $content     = $row['content'];
        $image_name  = $row['image_name'];
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
<?php if( !empty($error_message) ): ?>
        <ul class="error_message">
<?php foreach( $error_message as $value ): ?>
          <p style="color: #d9534f; text-align: center"><?php echo $value; ?></p>
<?php endforeach; ?>
        </ul>
<?php endif; ?>
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
  $host = 'localhost';
  $username = 'root';
  $pass = 'root';
  $dbname = 'overcome';
  $error_message = [];

  if(isset($_POST['submit']))
  {
    $password  = md5($_POST['password']);
    $password2 = md5($_POST['password2']);
    if ($password !== $password)
    {
      $error_message = 'Passwords should the same one. !';
      die();
    }
    if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password)) {
      $error_message[] = "パスワードの形式が正しくありません。";
      die();
    }

    if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password2)) {
      $error_message[] = "確認用パスワードの形式が正しくありません。";
      die();
    }

    $user_name  = $_GET['user_name'];
    $image_name = $_GET['image_name'];
    $email      = $_GET['email'];
    $content    = $_GET['content'];
    $account_id = $_GET['account_id'];


    $sql = "UPDATE tbl_account SET
                   user_name='$user_name'
                   ,image_name='$image_name'
                   ,email='$email'
                   ,content='$content'
                   ,password='$password'
             WHERE
                   account_id=$account_id ";
    $rec = mysqli_query($connect, $sql);

    if($rec == true)
    {
      $_SESSION['change-pwd'] = "<div class='success text-center'>Your Password was Updated.</div>";
      $url = "http://localhost:8001/account/ManageAccount.php?account_id=$account_id";
      header('Location:' .$url,true , 302);
    } else
    {
      $_SESSION['change-pwd'] = "<div class='success text-center'>Your Password Update was Failed.</div>";
      $url = "http://localhost:8001/account/UpdatePassword.blade.php?account_id=$account_id";
      header('Location:' .$url,true , 401);
    }
  }
  include('../account/partials/Footer.tpl');
?>
