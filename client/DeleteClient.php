<?php
include('./partials/HeaderEd.tpl');
include "../config/Constants.blade.php";

if(isset($_SESSION['client_failed']))
{
  echo $_SESSION['client_failed'];
  unset($_SESSION['client_failed']);
}

$client_id = $_GET['client_id'];
$sql= "SELECT * FROM tbl_client WHERE client_id = $client_id";
$rec = mysqli_query($connect, $sql);
if ($rec == TRUE)
{
  $count = mysqli_num_rows($rec);
  if ($count > 0)
  {
    while ($rows = mysqli_fetch_array($rec))
    {
      $name      = $rows['name'];
      $email     = $rows['email'];
      $telephone = $rows['telephone'];
      $image     = $rows['image'];
    }
  }
}
$url = "http://localhost:8001/client/DeleteClientDeed.blade.php?client_id=$client_id"
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
            PhoneNumber
          </b>
          <b style="font-size: 20px; margin-right: 170px"><?php echo $telephone ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      </div>
      <div style="margin-bottom:40px ; text-align: center">
        <button type="button" onclick=history.back() class="btn-primary" style="height: 53px; width: 103px;margin:0  0 30px 20px">
          Return
        </button>
        <button type="button" onclick="location.href='<?php echo $url; ?>'" class="btn-primary" style="height: 53px; width: 103px;">
          Delete
        </button>
      </div>
    </div>
  </body>
</html>