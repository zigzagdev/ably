<?php
include('../account/partials/header.blade.php');

$lesson_id= $_GET['lesson_id'];

$sql2= "DELETE FROM tbl_lesson WHERE lesson_id=$lesson_id";
$rec2= mysqli_query($connect, $sql2);


if($rec2 == TRUE) {

    $_SESSION['delete'] = "<div class='success'>Delete Lesson Successfully.</div>";
    $url = "http://localhost:8001/lesson/manage-lesson.php?account_id=$account_id";
    header('Location:' .$url,true , 302);
}
else
{
    $_SESSION['delete'] = "<div class='error'>Failed to Delete lesson.</div>";
    $url = "http://localhost:8001/lesson/manage-client.php?id=$account_id";
    header('Location:' .$url,true , 401);//ページへのリダイレクトをif~else文にて行っている。
}

include('../account/partials/footer.tpl');
?>


