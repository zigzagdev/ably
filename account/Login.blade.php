<?php
include('../config/Constants.blade.php');
include('./partials/ClientHeader.blade.php');

if(isset($_SESSION['pwd_notmatch']))
{
    echo $_SESSION['pwd_notmatch'];
    unset($_SESSION['pwd_notmatch']);
}
if(isset($_SESSION['ac_logout']))
{
    echo $_SESSION['ac_logout'];
    unset($_SESSION['ac_logout']);
}

?>

<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/Account.css">
</head>
<body>
<div style="text-align: right; margin:30px 160px 0 0">
    <strong>Haven't create an account ?<a href="AddAccount.php" style="margin-left: 10px; text-decoration: none; color: darkcyan">Create</a></strong>
</div>
<div style="margin: 50px 400px 25px 400px">
    <div class="mainaccount">
        <h2 style="text-align: center; padding-top: 18px">Sign In</h2>
        <form method="post" action="">
            <li style="list-style: none;  margin:22px 0 22px 30px">
                <b style="font-size: 20px;width:100px;margin:0 30px 0 100px; float: left;">
                    E-mail
                </b>
                <input type="email" required name="email" size="40px" style="height: 35px">
            </li>
            <li style="list-style: none;  margin:22px 0 22px 30px">
                <b style="font-size: 20px;width:100px;margin:0 30px 0 100px;float: left;">
                    Password
                </b>
                <input type="password" required name="password" size="40px" style="height: 35px">
            </li>
            <li style="list-style: none;  margin:22px 0 22px 30px">
                <a href="" class="passwordforgot">
                    Forgot your password?
                </a>
            </li>
            <li style="list-style: none;  margin:42px 0 22px 30px">
                <b style="font-size: 20px;width:100px;margin:0 30px 0 100px;">
                    <input type="submit" name="submit" value="Login" class="btn-third">
                </b>
            </li>
        </form>
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
    $email    = $_POST['email'];
    $password = md5($_POST['password']);

    $sql   = "SELECT * FROM tbl_account WHERE email='$email' AND password='$password'";
    $rec   = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($rec);

    if($count==1)
    {
        $row = mysqli_fetch_assoc($rec);
        $id  = $row['account_id'];
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['email'] = $email;

        header("Location:http:/localhost:8001/account/ManageAccount.php?account_id=$id", 302);
        exit();
    } else
    {
        $_SESSION['pwd_notmatch'] = "<div class='success' style='text-align: center; font-size: 20px'>Username or Password did not match.</div>";
        header('Location:SLogin.blade.php');
    }
}
include ('./partials/ClientFooter.tpl');
?>
