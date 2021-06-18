<?php include
('../config/constants.php');
?>

<html>
<head>
    <title>Login</title>
    <div class="login10">
    <h1>To train here your skills ! </h1>
    </div>
    <link rel="stylesheet" href="../css/account.css">
</head>
<body>
<div class="login">
    <h2 class="text-center">Login</h2>
    <br/><br/>
    <?php
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

    <br/><br/>
    <form action="" method="post" class="text-center">
        Username:<br/>
        <input type="text" name="username" placeholder="  enter your username"><br/><br/>
        Password:<br/>
        <input type="password" name="password" placeholder="  enter your password"><br/>
        Password Again:<br/>
        <input type="password2" name="password2" placeholder="          enter again" ><br/>
        <br/>
        <input type="submit" name="submit" value="login" class="btn-primary">
        <br/><br/>
    </form>
    <p class="text-center">Havn't create an account ?</p>
    <div class="create">
    <a href="add-client.php">Create</a>
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $password2 = md5($_POST['password2']);

    if($password != $password2){
        print 'Your Passwords  are  wrong. <br />';
    }


    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' AND password = '$password2'";
    $rec = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($rec);

    if($count==1)
    {
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;      //特定のユーザーがログアウトしてるかしてないかの確認の為に置いてる
        header('location:'.SITEURL.'/manage-client.php');
    }
    else
    {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:'.SITEURL.'order/login.php');
    }
}
?>

<footer>
 <div class="footer_login">

 </div>
</footer>