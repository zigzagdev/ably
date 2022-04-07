<?php include('partials/header.blade.php'); ?>

<head>
  <title>AdminRegistration</title>
  <link rel="stylesheet" href="../css/account.css">
</head>
<body>
  <div class="formline">
    <div class="form">
      <h1 style="padding-top: 50px; text-align: center">Add your account</h1>
      <?php
        if(isset($_SESSION['add']))
          {
            echo  $_SESSION['add'];
            unset($_SESSION['add']);
          }
      ?>
      <form action="" method="post" enctype="multipart/form-data" >
        <table class="tbl-30">
          <tr>
            <td>UserName:</td>
            <td>
              <input type="text" name="user_name" placeholder="Enter your username">
            </td>
          </tr>
          <tr>
            <td>Password:</td>
            <td>
              <input type="password" name="password" placeholder="Enter your password">
            </td>
          </tr>
          <tr>
            <td>Password Again:</td>
            <td>
              <input type="password" name="password2" placeholder="Password again">
            </td>
          </tr>
          <tr>
            <td>Email:</td>
            <td>
              <input type="email" name="email" placeholder="Enter your email">
            </td>
          </tr>
          <tr>
            <td>Post an Image:</td>
            <td>
              <input type="file" name="image">
            </td>
          </tr>
          <tr>
            <td>Content:</td>
            <td>
              <textarea name="content" cols="30" rows="5" placeholder="Describe yourself"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Add an account" class="btn-secondary">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</body>
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
        $rec = mysqli_query($mysqli,$sql);
        $rec2 = mysqli_num_rows($rec);
        if ($rec2 >= 1) {
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
                header('location:/account/add-client.php');
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



    $sql2= "INSERT INTO tbl_account SET username='$user_name',password ='$password',image_name = '$image_name',email = '$email',content = '$content'";
    $rec = mysqli_query($connect,$sql2) ;

    if($rec == TRUE) {
        $_SESSION['add'] = "<div class='success'>Your account Added Successfully.</div>";
        $account_id = mysqli_insert_id($connect);
        header("location: http://localhost:8001/account/manage-client.php?account_id=$account_id");
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to add your account.</div>";
        header("location: http://localhost:8001/account/login.php");//ページへのリダイレクトをif~else文にて行っている。
    }
}
?>
<?php include ('partials/footer.tpl'); ?>
