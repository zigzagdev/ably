<?php
include ('./partials/LoginAccount.blade.php');

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
            <input type="submit" name="submit" value="Update your Account" class="btn-secondary" style="border: 1.2px solid">
<?php
            $hostname = $_SERVER['HTTP_HOST'];
            if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false))
            {
              echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="btn-secondary" style="margin:1px 0 0 10px; border: 1.2px solid">Return</a>';
            }
?>
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

  if(isset($_POST['submit']))
  {
    $email = $_POST['email'];
    $contents_mail='/¥A\w\-\.]+¥@[\w\-\.]+.([a-z]+)\z/';
    if(preg_match($contents_mail,$email))
    {
      print 'write down your email correctly ! ';
    }

    $accountsearch = ("SELECT email FROM tbl_account where email='$email'");
    $accountconnect = mysqli_query($mysqli,$accountsearch);
    $accountconnect2 = mysqli_num_rows($accountconnect);

    if ($accountconnect2 >= 1 )
    {
      $error_message[] = ' Your Input Address was already .';
    }

    $lesson_id = $_POST['lesson_id'];
    $form_id = $_POST['form_id'];

    $sql = "UPDATE tbl_account SET
                   user_name='$user_name'
                   ,image_name='$image_name'
                   ,email='$email'
                   ,content='$content'
             WHERE
                   account_id=$account_id ";
    $rec = mysqli_query($connect, $sql);

  if($rec3 == true)
  {
    $_SESSION['order'] = "<div class='success text-center'>Form order Updated.</div>";
    $url = "http://localhost:8001/form/ManageForm.php?form_id=$form_id";
    header('Location:' .$url,true , 302);
  }
  else
  {
    $_SESSION['order'] = "<div class='success text-center'>Form Update Failed.</div>";
    $url = "http://localhost:8001/form/UpdateEmailForm.blade.php?form_id=$form_id";
    header('Location:' .$url,true , 401);
  }
}
include('../account/partials/Footer.tpl');
?>
