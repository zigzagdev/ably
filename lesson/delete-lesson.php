<?php
include('../account/partials/header.php');


$id= $_GET['id'];

$sql= "DELETE FROM tbl_account WHERE id=$id";
$rec= mysqli_query($connect, $sql);

if($rec == TRUE) {
    $_SESSION['delete'] = "<div class='success'>Delete Lesson Successfully.</div>";
    $url = "http://localhost:8001/account/login.php";
    header('Location:' .$url,true , 302);
}
else
{
    $_SESSION['delete'] = "<div class='error'>Failed to Delete lesson.</div>";
    $url = "http://localhost:8001/account/manage-client.php?id=$id";
    header('Location:' .$url,true , 401);//ページへのリダイレクトをif~else文にて行っている。
}

include('../account/partials/footer.php');
?>