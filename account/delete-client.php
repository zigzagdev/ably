<?php
include('../config/constants.php');


$id= $_GET['id'];

$sql= "DELETE FROM tbl_account WHERE id=$id";
$rec= mysqli_query($connect, $sql);

if($rec == TRUE) {
    $_SESSION['add'] = "<div class='success'>Delete Account Successfully.</div>";
    $url = "http://localhost:8001/account/login.php";
    header('Location:' .$url,true , 302);
}
else
{
    $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
    $url = "http://localhost:8001/account/manage-client.php?id=$id";
    header('Location:' .$url,true , 401);//ページへのリダイレクトをif~else文にて行っている。
}
?>