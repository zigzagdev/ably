<?php
include  "./partials/HeaderEd.tpl";
  if(isset($_SESSION['cli_add']))
  {
    echo  $_SESSION['cli_add'];
    unset($_SESSION['cli_add']);
  }

  if(isset($_SESSION['s_login']))
  {
    echo  $_SESSION['s_login'];
    unset($_SESSION['s_login']);
  }

  $client_id = $_GET['client_id'];
  $sql = "SELECT * FROM tbl_account where client_id=$client_id";
  $rec = mysqli_query($connect, $sql);

  if($rec==TRUE)
  {
    $count = mysqli_num_rows($rec);
    if($count>0)
    {
      while ($rows = mysqli_fetch_assoc($rec))
      {
        $name        = $rows['name'];
        $image       = $rows['image'];
        $email       = $rows['email'];
        $sex         = $rows['sex'];
        $content     = $rows['content'];
        if ($image == "")
        {
          echo "<div class='error'>Image not Added.</div>";
        }
      }
    }
  }
?>
<html>
  <head>
    <title>ManageAccount</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 190px">
      <div class="mainaccount">
        <li style="list-style: none;  margin:27px 0 7px 70px; padding-top: 20px">
          <a href="./UpdateImage.blade.php?client_id=<?=$client_id=$_GET['client_id']?>"
            <img src="../images/profile/<?php echo $image; ?>" width="90px" height="90px" style="border-radius: 50%; margin-right: 160px; vertical-align: center">
            <b style="font-size: 20px;width:70px;margin-right:10px; vertical-align: 70%">Manage your Account</b>
          </a>
        </li>
        <li style="list-style: none;  margin:47px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            UserName
          </b>
          <b style="font-size: 20px"><?php echo $name ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Email
          </b>
          <b style="font-size: 20px"><?php echo $email ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Content
          </b>
          <b style="font-size: 20px"><?php echo mb_strimwidth( strip_tags( $content ), 0, 20, '…', 'UTF-8' ); ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      </div>
    </div>
    <div style="margin:60px 0; text-align: center">
      <div style="margin: 0 10px 20px 10px">
<!--        <a class="btn-primary" style="margin: 0 7px 0 7px" href="UpdateAccount.php?account_id=--><?//= $account_id=$_GET['account_id']?><!--">-->
<!--          Update your Account-->
<!--        </a>-->
        <a class="btn-secondary" style="margin: 0 7px 0 7px" href="./form/ManageForm.php?client_id=<?= $client_id=$_GET['client_id']?>">
          Check your register forms.
        </a>
        <a class="btn-delete" style="margin: 0 7px 0 7px;" href="DeleteClient.php?client_id=<?=$client_id=$_GET['client_id']?>">
          Delete your Account
        </a>
      </div>
    </div>
  </body>
</html>



<?php include "./partials/FooterEd.tpl" ?>
