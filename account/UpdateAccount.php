<?php  include('partials/Header.blade.php'); ?>

<?php
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
        $account_id = $row['account_id'];
        $username = $row['username'];
        $current_image = $row['image_name'];
        $image = $row['image_name'];
        $email = $row['email'];
        $content = $row['content'];
      } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
?>
<html>
  <head>
    <title>UpdatePage</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 230px">
      <div class="mainaccount">
        <h1 style="text-align: center; margin: 55px 0 50px 0; padding-top: 20px">Update your Account</h1>
          <form action="" method="post" enctype="multipart/form-data" style="">
            <li style="list-style: none;  margin:17px 0 17px 30px">
              <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
                UserName
              </b>
              <input id="name" type="text" name="name" placeholder="miku honda" size="40">
            </li>
            <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
            <li style="list-style: none;  margin:17px 0 17px 30px">
              <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
                Email
              </b>
              <input type="text" name="email" placeholder="abc@com" size="40">
            </li>
            <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
            <li style="list-style: none;  margin:17px 0 17px 30px">
              <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
                Content
              </b>
              <textarea type="content" name="name" cols="60" rows="4"></textarea>
            </li>
            <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
            <li style="list-style: none;  margin:17px 0 17px 30px">
              <b style="font-size: 20px;width:100px ;margin-right:200px; float: left;">
                Image
              </b>
              <input type="file" name="image">
            </li>
          </form>
      </div>
    </div>
  </body>
<?php
          if(isset($_POST['submit']))
          {
            $account_id = $_GET['account_id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $content = $_POST['content'];

          if(isset($_FILES['image']['name']))
          {
            $image = $_FILES['image']['name'];
            if($image != "")
            {
              $source_path = $_FILES['image']['tmp_name'];
              $destination_path = "../images/profile/".$image;
              $upload = move_uploaded_file($source_path, $destination_path);
              if($upload!=true)
              {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                $url = "http://localhost:8001/account/UpdateAccount.php?account_id=$account_id";
                header('Location:'.$url,true , 401);
                die();
              }
              if($current_image!="")
              {
                $remove_path = "../images/profile/".$current_image;
                $remove = unlink($remove_path);
                if($remove==false)
                {
                  $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                  $url = "http://localhost:8001/account/UpdateAccount.php?account_id=$account_id";
                  header('Location:' .$url,true , 401);
                  die();
                }
              }
            } else
            {
              $image = $current_image;
            }
          } else
          {
            $image = $current_image;
          }
          $sql = "UPDATE tbl_account SET 
                         username='$username'
                         ,image_name='$image'
                         ,email='$email'
                         ,content='$content' 
                  WHERE account_id=$account_id ";
          $rec = mysqli_query($connect, $sql);
}
?>
<?php include('partials/Footer.tpl'); ?>