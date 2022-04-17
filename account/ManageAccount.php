<?php include('partials/Header.blade.php');

  if(isset($_SESSION['add']))
  {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
  }
  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }
  if(isset($_SESSION['update']))
  {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
  }
  if(isset($_SESSION['user-not-found']))
  {
    echo $_SESSION['user-not-found'];
    unset($_SESSION['user-not-found']);
  }
  if(isset($_SESSION['pwd-not-match']))
  {
    echo $_SESSION['pwd-not-match'];
    unset($_SESSION['pwd-not-match']);
  }
  if(isset($_SESSION['change-pwd']))
  {
    echo $_SESSION['change-pwd'];
    unset($_SESSION['change-pwd']);
  }
  $account_id = $_GET['account_id'];
  $sql = "SELECT * FROM tbl_account where account_id=$account_id";
  $rec = mysqli_query($connect, $sql);

  if($rec==TRUE)
  {
    $count = mysqli_num_rows($rec);
    if($count>0)
    {
      while ($rows = mysqli_fetch_assoc($rec))
      {
        $account_id = $rows['account_id'];
        $user_name = $rows['user_name'];
        $password = $rows['password'];
        $image_name = $rows['image_name'];
        $email = $rows['email'];
        $content = $rows['content'];
        if ($image_name == "")
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
          <img src="../images/profile/<?php echo $image_name; ?>" width="90px" height="90px" style="border-radius: 50%; margin-right: 160px; vertical-align: center">
          <b style="font-size: 20px;width:70px;margin-right:10px; vertical-align: 70%">Manage your Account</b>
        </li>
        <li style="list-style: none;  margin:47px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            UserName
          </b>
          <b style="font-size: 20px"><?php echo $user_name ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Email
          </b>
          <?php echo $email ?>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Content
          </b>
          <b style="font-size: 20px"><?php echo $content ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      </div>
    </div>
    <div style="margin:60px 0; text-align: center">
      <div style="margin: 0 10px 20px 10px">
        <a class="btn-primary" style="margin: 0 7px 0 7px" href="UpdateAccount.php?account_id=<?= $account_id=$_GET['account_id']?>">
          Update your Account
        </a>
        <a class="btn-secondary" style="margin: 0 7px 0 7px" href="DeleteAccount.blade.php?account_id=<?=$account_id=$_GET['account_id']?>">
          Delete your Account
        </a>
        <a href="" class="btn-primary" style="margin: 0 7px 0 7px">Update your Password</a>
        <a class="btn-secondary" style="margin: 0 7px 0 7px" href="../lesson/ManageLesson.php?account_id=<?= $account_id=$_GET['account_id']?>">
          Check your register Lessons.
        </a>
      </div>
    </div>
  </body>
</html>

<?php include('partials/Footer.tpl') ?>
