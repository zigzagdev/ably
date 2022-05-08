<?php
include('../account/partials/ClientHeader.blade.php');
include "../config/Constants.blade.php";

  if(isset($_SESSION['cli_fal']))
  {
    echo  $_SESSION['cli_fal'];
    unset($_SESSION['cli_fal']);
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
            <input id="name" type="text" name="name" placeholder="Steve Smith" size="40" required>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              Email
            </b>
            <input type="text" name="email" placeholder="abc@com" size="40" required>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              Password
            </b>
            <input type="password" name="password"  size="40" required>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              PasswordAgain
            </b>
            <input type="password" name="password2"  size="40" required>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              Content
            </b>
            <textarea type="text" name="content" cols="60" rows="4" required></textarea>
          </li>
          <hr color="#a9a9a9" width="94%" size="1" style="margin: 8px 5px 0 8px ;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              Sex
            </b>
            <select name="sex" required>
              <option value="">Please Select(Only select here)</option>
              <option value="man">man</option>
              <option value="woman">woman</option>
              <option value="others">other</option>
            </select>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:150px; float: left;">
              PhoneNumber
            </b>
            <input type="tel" name="telephone"  size="20" required>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px ;margin-right:150px; float: left;">
              Image
            </b>
            <input type="file" name="image" required>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 5px 250px">
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
  $name       = $_POST['name'];
  $password   = md5($_POST['password']);
  $password2  = md5($_POST['password2']);
  $email      = $_POST['email'];
  $sex        = $_POST['sex'];
  $telephone  = $_POST['telephone'];

  if(isset($_FILES['image']['name']))
  {
    $image = $_FILES['image']['name'];
    if($image != "")
    {
      $src = $_FILES['image']['tmp_name'];
      $dst ="../images/profile/".$image;
      $upload = move_uploaded_file($src, $dst);
      if ($upload == false)
      {
        $_SESSION['cli_add'] = "<div class='error'>Failed to Upload Image.</div>";
        header('location:/client/AddClient.php');
        die();
      }
    }
  } else
  {
    $image = "";
  }

//  correct words validation
  if( 4 > mb_strlen($name, 'UTF-8') || 50 < mb_strlen($name, 'UTF-8') ) {
    $_SESSION['cli_fal'] = "<div class='success'>Please fill your content in 4~50 words. !</div>";
    header('location:/client/AddClient.php');
    die();
  }
  if( 4 > mb_strlen($email, 'UTF-8') || 50 < mb_strlen($email, 'UTF-8') ) {
    $_SESSION['cli_fal'] = "<div class='success'>Please fill your content in 4~50 words. !</div>";
    header('location:/client/AddClient.php');
    die();
  }

//  password correctly
  if ($password !== $password2)
  {
    $_SESSION['cli_fal'] = "<div class='success'>Passwords should the same one.!</div>";
    header('location:/client/AddClient.php');
    die();
  }

//  select the email and phonenumber whether duplicated it
  $sql = "SELECT 
              tbl_account.password
            FROM 
              tbl_account 
          LEFT JOIN 
              tbl_client 
            ON 
              tbl_account.password= tbl_client.password
            WHERE 
              tbl_account.password='$password'
          UNION   
          SELECT 
              tbl_client.password
            FROM 
              tbl_account
          RIGHT JOIN 
              tbl_client
            ON 
              tbl_account.password= tbl_client.password
          WHERE 
              tbl_client.password='$password'
           ";
  $rec  = mysqli_query($connect,$sql);
  $rec2 = mysqli_num_rows($rec);
  if ($rec2 > 0) {
    $_SESSION['add_fail_client'] =  "<div class='success'>Password already exists</div>";
    header('location:/client/AddClient.php');
    die();
  }


  $sql_1 = "SELECT 
                tbl_account.email
              FROM 
                tbl_account 
             LEFT JOIN 
                 tbl_client 
               ON 
                 tbl_account.email = tbl_client.email
             WHERE 
                 tbl_account.email ='$email'
             UNION   
             SELECT 
                 tbl_client.email
               FROM 
                 tbl_account
             RIGHT JOIN 
                 tbl_client
               ON 
                 tbl_account.email = tbl_client.email
               WHERE 
                 tbl_client.email = '$email'
           ";
  $rec_1  = mysqli_query($connect,$sql_1);
  $rec_2 = mysqli_num_rows($rec_1);
  if ($rec_2 > 0) {
    $_SESSION['add_fail_c'] =  "<div class='success'>User already exists</div>";
    header('location:/client/AddClient.php');
  }

  $sqltel = " SELECT telephone FROM tbl_client WHERE telephone='$telephone'";

  $rectel  = mysqli_query($connect,$sqltel);
  $rec2tel = mysqli_num_rows($rectel);
  if ($rec2tel >= 1) {
    $_SESSION['cli_fal'] = "<div class='success'>PhoneNumber was already registered.!</div>";
    header("location: http://localhost:8001/client/AddClient.php");
  }

//  preg_match
  if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
    $_SESSION['cli_fal'] = "<div class='success'>Only English is valid.!</div>";
    header("location: http://localhost:8001/client/AddClient.php");
  }

  if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password)) {
    $_SESSION['cli_fal'] = "<div class='success'>Password format is not correctly !</div>";
    header("location: http://localhost:8001/client/AddClient.php");
  }

  if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,50}+\z/i", $password2)) {
    $_SESSION['cli_fal'] = "<div class='success'>Password format is not correctly !</div>";
    header("location: http://localhost:8001/client/AddClient.php");
    die();
  }

  $tel_boolean="/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/";
  if(preg_match($tel_boolean, $telephone))
  {
    $_SESSION['cli_fal'] = "<div class='success'>Write down your phone number correctly !</div>";
    header("location: http://localhost:8001/client/AddClient.php");
    die();
  }

  $sql = "INSERT INTO 
            tbl_client
          SET 
            name        = '$name'
            ,password   = '$password'
            ,image      = '$image'
            ,email      = '$email'
            ,sex        = '$sex'
            ,telephone  = '$telephone'
          ";

  $rec = mysqli_query($connect,$sql) or die(mysqli_error($connect));
  if($rec == TRUE)
  {
    $_SESSION['cli_add'] = "<div class='success'>Your account Added Successfully.</div>";
    $client_id = mysqli_insert_id($connect);
    header("location: http://localhost:8001/client/ClientPage.php?client_id=$client_id");
    die();
  } else
  {
    $_SESSION['cli_fal'] = "<div style='text-align: center; color: #ff6666; font-size: 20px''>Failed to add your account.</div>";
    header("location: http://localhost:8001/client/AddClient.php");
    die();
  }
}
include "./partials/FooterEd.tpl";
?>
