<?php
include ('./partials/LoginAccount.blade.php');

if(isset($_SESSION['admin_failed']))
{
  echo $_SESSION['admin_failed'];
  unset($_SESSION['admin_failed']);
}

$account_id = $_GET['account_id'];
$sql= "SELECT * FROM tbl_account WHERE account_id = $account_id";
$rec = mysqli_query($connect, $sql);
if ($rec == TRUE)
{
  $count = mysqli_num_rows($rec);
  if ($count > 0)
  {
    while ($rows = mysqli_fetch_array($rec))
    {
      $name       = $rows['user_name'];
      $content    = $rows['content'];
      $image      = $rows['image_name'];
      $email      = $rows['email'];
    }
  }
}
$url = "http://localhost:8001/account/DeleteAccountDeed.blade.php?account_id=$account_id" ;
?>
<html>
  <head>
    <title>DeleteAccount</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 130px">
      <div class="mainaccount">
        <li style="list-style: none;  margin:27px 0 7px 70px; padding-top: 20px">
          <img src="../images/profile/<?php echo $image; ?>" width="90px" height="90px" style="border-radius: 50%; margin-right: 160px; vertical-align: center">
          <b style="font-size: 20px;width:70px;margin-right:10px; vertical-align: 70%">Delete your Account</b>
        </li>
        <li style="list-style: none;  margin:47px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
            Name
          </b>
          <b style="font-size: 20px; margin-right: 170px"><?php echo $name ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
            Email
          </b>
          <b style="font-size: 20px; margin-right: 170px"><?php echo $email ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
            Content
          </b>
          <b style="font-size: 20px; margin-right: 170px"><br>
            <?php echo mb_strimwidth( strip_tags( $content ), 0, 20, '…', 'UTF-8' ); ?>
          </b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      </div>
      <div style="margin-bottom:40px ; text-align: center">
        <div style=" text-align: center">
          <button type="button" onclick=history.back() class="btn-primary" style="height: 53px; width: 103px;margin:0  0 30px 20px">
            Return
          </button>
          <button type="button" onclick="location.href='<?php echo $url;?>'" class="btn-primary" style="height: 53px; width: 103px;">
            Delete
          </button>
        </div>
      </div>
    </div>
  </body>
</html>