<?php
include "./partials/HeaderEd.blade.php";

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
  $sql = "SELECT * FROM tbl_client where client_id=$client_id";
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
        $phone       = $rows['telephone'];
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
    <div style="margin: 0 140px">
      <div class="mainaccount" style="background-color: lightgray">
        <li style="list-style: none;  margin:47px 10px 7px 30px; padding-top: 20px">
          <a href="./UpdateImage.blade.php?client_id=<?=$client_id=$_GET['client_id']?>" style="text-decoration: none;">
            <img src="../images/profile/<?php echo $image; ?>" width="90px" height="90px" class="c_img">
            <b style="font-size: 20px;width:70px;margin-right:10px; vertical-align: 70%" class="client_update">
              Account
            </b>
            <p style="margin-left: 30px; line-height: 1px">Edit</p>
          </a>
        </li>
        <li style="list-style: none;  margin:37px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            UserName
          </b>
          <b style="font-size: 20px"><?php echo $name ?></b>
          <a href="./UpdateName.php?client_id=<?=$client_id=$_GET['client_id']?>" style="text-decoration: none">
            <b style="float: right; margin-right: 40px">
              <img src="../images/pencil.png" style="width: 40px; height: 30px">
            </b>
          </a>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Email
          </b>
          <b style="font-size: 20px"><?php echo $email ?></b>
          <a href="./UpdateEmail.blade.php?client_id=<?=$client_id=$_GET['client_id']?>" style="text-decoration: none">
            <b style="float: right; margin-right: 40px;">
              <img src="../images/pencil.png" class="pencil">
            </b>
          </a>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            PhoneNumber
          </b>
          <b style="font-size: 20px"><?php echo $phone ?></b>
          <a href="./UpdatePhoneNumber.blade.php?client_id=<?=$client_id=$_GET['client_id']?>" style="text-decoration: none">
            <b style="float: right; margin-right: 40px;">
              <img src="../images/pencil.png" class="pencil">
            </b>
          </a>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      </div>
    </div>
    <div style="margin:60px 0; text-align: center">
      <div style="margin: 0 10px 20px 10px">
<!--        <a class="btn-primary" style="margin: 0 7px 0 7px" href="UpdateAccount.php?account_id=--><!--">-->
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
