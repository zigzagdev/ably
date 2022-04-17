<?php include('partials/Header.blade.php'); ?>

<html>
  <head>
    <title>AddAccount</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 230px">
      <div class="mainaccount">
        <h1 style="text-align: center; margin: 55px 0 50px 0; padding-top: 20px">Add your Account</h1>
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
            <textarea type="text" name="content" cols="60" rows="4"></textarea>
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
</html>
<?php
$host = 'localhost';
$username = 'root';
$pass = 'root';
$dbname = 'overcome';

//Process the value from Form and Save it in Database
// Check whether the button is clicked or not
if(isset($_POST['submit']))
{
    $user_name = $_POST['user_name'];
    $password  = md5($_POST['password']);
    $password2 = md5($_POST['password2']);

    $errors = [];


    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $mysqli = mysqli_connect($host,$username,$pass,$dbname);
        if (!$mysqli){
            die("Fail to connect your database.");
        }
        $sql = ("SELECT * FROM tbl_account where email='$email'");
        $formsql = ("SELECT * FROM tbl_form where email='$email'");
        $rec = mysqli_query($mysqli,$sql);
        $formrec = mysqli_query($mysqli,$formsql);
        $rec2 = mysqli_num_rows($rec);
        $formrec2 = mysqli_num_rows($rec2);

        if ($rec2 >= 1 || $formrec2 >= 1) {
            $errors =  "<div class style='color: #ff6b81; text-align: center' >user exists</div>";
            die();
        }
    }

    $content = $_POST['content'];

    if(isset($_FILES['image']['name']))
    {
        $image_name = $_FILES['image']['name'];

        if($image_name != " ")
        {
            $src = $_FILES['image']['tmp_name'];
            $dst ="../images/profile".$image_name;
            $upload = move_uploaded_file($src, $dst);
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                header('location:/account/AddAccount.php');
                die();
            }
        }
    }
    else
    {
        $image_name= "";
    }
    if (empty($user_name)){
        die('Please fill your name fields!');
    }

    if (empty($password)){
        die('Please fill password !');
    }

    if (empty($password2)){
        die('Please fill password2 again !');
    }

    if (empty($email)){
        die('Please fill your email !');
    }

  if (!preg_match("/^[a-zA-Z-' ]*$/", $user_name)) {
    $error_message[] = "英語のみ有効です。";
    die();
  }

    if ($password !== $password2) {
        die('Password and Confirm password should match!');
    }

  if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i", $password)) {
    $error_message[] = "パスワードの形式が正しくありません。";
    die();
  }

  if (!preg_match("/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i", $password2)) {
    $error_message[] = "確認用パスワードの形式が正しくありません。";
    die();
  }



    $sql2= "INSERT INTO tbl_account SET 
              username='$user_name'
              ,password ='$password'
              ,image_name = '$image_name'
              ,email = '$email'
              ,content = '$content'";

    $rec = mysqli_query($connect,$sql2) ;

    if($rec == TRUE) {
        $_SESSION['add'] = "<div class='success'>Your account Added Successfully.</div>";
        $account_id = mysqli_insert_id($connect);
        header("location: http://localhost:8001/account/ManageAccount.php?account_id=$account_id");
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to add your account.</div>";
        header("location: http://localhost:8001/account/Login.blade.php");
    }
}
?>
<?php include('partials/Footer.tpl'); ?>
