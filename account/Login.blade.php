<?php
include('../config/Constants.blade.php');
include ('./partials/ClientHeader.tpl');

  if(isset($_SESSION['login']))
  {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
  }
  if(isset($_SESSION['no-login-message']))
  {
    echo $_SESSION['no-login-message'];
    unset($_SESSION['no-login-message']);
  }
?>

<html>
  <head>
    <title>LogIn Page</title>
    <link rel="stylesheet" href="../css/Account.css">
  </head>
  <body>
    <div class="login">
      <h2 class="text-center">Sign In</h2>
      <form action="" method="post" class="text-center">
        Username:
        <input type="text" name="username" placeholder="  enter your username"><br/><br/>
        Password:<br/>
        <input type="password" name="password" placeholder="  enter your password"><br/><br/>
        <input type="submit" name="submit" value="login" class="btn-primary">
        <br/><br/>
    </form>
    <p class="text-center">Havn't create an account ?</p>
    <div class="create">
    <a href="AddAccount.php">Create</a>
    </div>
</div>
</body>
</html>

<?php
  if(isset($_POST['submit']))
  {
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_account WHERE user_name='$user_name' AND password='$password'";
    $rec = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($rec);

    if($count==1)
    {
      $row = mysqli_fetch_assoc($rec);
      $url = "http://localhost:8001/account/ManageAccount.php?account_id=$row[id]";
      $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
      $_SESSION['user'] = $user_name;

      header('Location:' .$url,true , 302);
      exit();
    } else
    {
      $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
      header('Location:Login.blade.php');
    }
  }
include ('./partials/ClientFooter.tpl');
?>
