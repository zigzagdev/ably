<?php include('partials/Header.blade.php'); ?>

<html>
  <head>
    <title>TopPage</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div class="main">
      <div style="text-align: center; margin: 0 230px">
      <h1>Manage Your Account</h1>
<?php
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
                $username = $rows['username'];
                $password = $rows['password'];
                $image_name = $rows['image_name'];
                $email = $rows['email'];
                $content = $rows['content'];
?>
                <div class="mainaccount">
                  <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
                  <b style="margin-left: 20px; font-size: 20px"><?php echo $username ?></b>

                </div>
<?php
                if ($image_name == "")
                {
                  echo "<div class='error'>Image not Added.</div>";
                }
              }
            }
          }
        ?>
      </div>
        <div style="margin-top: 60px; text-align: center">
          <div style="margin: 0 10px 20px 10px">
            <a class="btn-primary" style="margin: 0 7px 0 7px" href="UpdateAccount.php?account_id<?= $account_id=$_GET['account_id']?>">
              Update your Account
            </a>
            <a class="btn-secondary" style="margin: 0 7px 0 7px" href="DeleteAccount.php?account_id=<?= $account_id=$_GET['account_id']?>">
              Delete your Account
            </a>
            <a href="" class="btn-primary" style="margin: 0 7px 0 7px">Update your Password</a>
            <a class="btn-secondary" style="margin: 0 7px 0 7px" href="../lesson/ManageLesson.php?account_id=<?= $account_id=$_GET['account_id']?>">
              Check your register Lessons.
            </a>
          </div>
        </div>
    </div>
  </body>
</html>

<?php include('partials/Footer.tpl') ?>