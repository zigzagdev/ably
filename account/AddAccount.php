<?php
include('partials/Header.blade.php');
  if(isset($_SESSION['add_fail']))
  {
    echo  $_SESSION['add_fail'];
    unset($_SESSION['add_fail']);
  }
?>

<html>
  <head>
    <title>AddAccount</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 200px">
      <div class="mainaccount">
        <h1 style="text-align: center; margin: 55px 0 50px 0; padding-top: 20px">Add your Account</h1>
<?php if( !empty($error_message) ): ?>
          <ul class="error_message">
<?php foreach( $error_message as $value ): ?>
            <p style="color: #d9534f; text-align: center"><?php echo $value; ?></p>
<?php endforeach; ?>
          </ul>
<?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data" style="">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              UserName
            </b>
            <input id="name" type="text" name="user_name" placeholder="Steve Smith" size="40">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              Email
            </b>
            <input type="text" name="email" placeholder="abc@com" size="40">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              Password
            </b>
            <input type="password" name="password"  size="40">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              PasswordConfirm
            </b>
            <input type="password" name="password2"  size="40">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              Content
            </b>
            <textarea type="text" name="content" cols="60" rows="4"></textarea>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px ;margin-right:150px; float: left;">
              Image
            </b>
            <input type="file" name="image">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <input type="submit" name="submit" value="Add an account" class="btn-secondary">
          </li>
        </form>
      </div>
    </div>
  </body>
</html>

<?php

  if(isset($_POST['submit']))
  {
    $user_name = $_POST['user_name'];
    $password  = md5($_POST['password']);
    $password2 = md5($_POST['password2']);
    $email     = $_POST['email'];
    $content   = $_POST['content'];

    if(isset($_FILES['image']['name']))
    {
      $image_name = $_FILES['image']['name'];
      if($image_name != " ")
      {
        $src = $_FILES['image']['tmp_name'];
        $dst ="../images/profile/".$image_name;
        $upload = move_uploaded_file($src, $dst);
        if ($upload == false)
        {
          $_SESSION['add_fail'] = "<div class='success'>Failed to Upload Image.</div>";
          header('location:/account/AddAccount.php');
          die();
        }
      }
    } else
    {
      $image_name= "";
    }
    if (empty($user_name) || empty($email))
    {
      $error_message = 'Please fill all required fields!';
      die();
    }
    if ($password !== $password)
    {
      $error_message = 'Passwords should the same one. !';
      die();
    }

    $sql = "SELECT 
                   tbl_account.email , tbl_client.email 
              FROM 
                   tbl_account 
            LEFT OUTER JOIN 
                   tbl_client 
              ON 
                   tbl_account.email= tbl_client.email
           ";
    $rec = mysqli_query($connect,$sql);
    $rec2 = mysqli_num_rows($rec);
    if ($rec2 >= 1) {
      $_SESSION['add_fail'] =  "<div class='success'>User already exists</div>";
      die();
    }


    if (!preg_match("/^[a-zA-Z-' ]*$/", $user_name)) {
      $error_message[] = "Only English is valid.";
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

    $sql = "INSERT INTO tbl_account
            SET 
              user_name   = '$user_name'
              ,password   = '$password'
              ,image_name = '$image_name'
              ,email      = '$email'
              ,content    = '$content' 
          ";
    $rec = mysqli_query($connect,$sql) or die(mysqli_error($connect));
    if($rec == TRUE)
    {
      $_SESSION['add'] = "<div class='success'>Your account Added Successfully.</div>";
      $account_id = mysqli_insert_id($connect);
      header("location: http://localhost:8001/account/ManageAccount.php?account_id=$account_id");
    } else
    {
      $_SESSION['add_fail'] = "<div style='text-align: center; color: #ff6666; font-size: 20px''>Failed to add your account.</div>";
      header("location: http://localhost:8001/account/AddAccount.php");
    }
  }
  include('partials/Footer.tpl');
?>