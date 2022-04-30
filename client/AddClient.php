<?php
include('../account/partials/ClientHeader.tpl');

  if(isset($_SESSION['cli_fal']))
  {
    echo  $_SESSION['cli_fal'];
    unset($_SESSION['cli_fal']);
  }
  if(isset($_SESSION['add_fail_c']))
  {
    echo  $_SESSION['add_fail_c'];
    unset($_SESSION['add_fail_c']);
  }
?>

<html>
  <head>
    <title>Start learning</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 200px">
      <div class="mainaccount">
        <h1 style="text-align: center; margin: 55px 0 50px 0; padding-top: 20px">Start learning at here !!</h1>
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
              PasswordAgain
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
          <hr color="#a9a9a9" width="94%" size="1" style="margin: 8px 5px 0 8px ;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              Sex
            </b>
            <select name="sex">
              <option value="">Please Select(Only select here)</option>
              <option value="man">man</option>
              <option value="woman">woman</option>
              <option value="others">other</option>
            </select>
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
  $sex       = $_POST['sex'];

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
        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
        header('location:/account/add-client.php');
        die();
      }
    }
  } else
  {
    $image_name= "";
  }
  if (empty($user_name) || empty($email) || empty($sex))
  {
    $_SESSION['add_fail_c'] =  "<div class='success'>Please fill all required fields!</div>";
    die();
  }
  if ($password !== $password2)
  {
    $_SESSION['add_fail_c'] =  "<div class='success'>Passwords should the same one.!</div>";
    die();
  }

  if (!preg_match("/^[a-zA-Z-' ]*$/", $user_name)) {
    $_SESSION['add_fail_c'] =  "<div class='success'>Only English is valid.!</div>";
    die();
  }

//  select the email whether duplicated it
  $sql = "SELECT 
                   tbl_account.email , tbl_client.email 
              FROM 
                   tbl_account 
            LEFT OUTER JOIN 
                   tbl_client 
              ON 
                   tbl_account.email= tbl_client.email
           ";
  $rec  = mysqli_query($connect,$sql);
  $rec2 = mysqli_num_rows($rec);
  if ($rec2 >= 1) {
    $_SESSION['add_fail_c'] =  "<div class='success'>User already exists</div>";
    die();
  }

  if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password)) {
    $_SESSION['add_fail_c'] =  "<div class='success'>Password format is not correctly !</div>";
    die();
  }

  if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password2)) {
    $_SESSION['add_fail_c'] =  "<div class='success'>Password format is not correctly !</div>";
    die();
  }

  $sql = "INSERT INTO 
            tbl_account 
          SET 
            user_name   = '$user_name'
            , password  = '$password'
            ,image_name = '$image_name'
            ,email      = '$email'
            ,content    = '$content' 
            ,sex        = '$sex'
           
          ";

  $rec = mysqli_query($connect,$sql) or die(mysqli_error($connect));
  if($rec == TRUE)
  {
    $_SESSION['cli_add'] = "<div class='success'>Your account Added Successfully.</div>";
    $account_id = mysqli_insert_id($connect);
    header("location: http://localhost:8001/account/ManageAccount.php?account_id=$account_id");
  } else
  {
    $_SESSION['cli_fal'] = "<div style='text-align: center; color: #ff6666; font-size: 20px''>Failed to add your account.</div>";
    header("location: http://localhost:8001/account/AddAccount.php");
  }
}
include('../account/partials/ClientFooter.tpl');
?>
