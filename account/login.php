<?php include
('../config/constants.php');
?>

<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="../css/account.css">
</head>
<body>
<div class="login">
    <h2 class="text-center">Sign In</h2>
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
        <input type="password" name="password" placeholder="  enter your password"><br/><br/>
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


    $sql = "SELECT * FROM tbl_account WHERE username='$username' AND password='$password'";
    $rec = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($rec);

    if($count==1)
    {
        $row = mysqli_fetch_assoc($rec);
        $url = "http://localhost:8001/account/manage-client.php?id=$row[id]";
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;
        //特定のユーザーがログアウトしてるかしてないかの確認の為に置いてる
        header('Location:' .$url,true , 302);
        exit;
    }
    else
    {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('Location:login.php');
    }
}
?>

<footer>
 <div class="footer_login">

 </div>
</footer>