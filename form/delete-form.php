<?php
include('../account/partials/header_info.blade.php');

echo '<script type="text/javascript">alert("Do you want to really delete this?");</script>';


$form_id= $_GET['form_id'];
$lesson_id = $_GET['lesson_id'];
$sql2= "DELETE FROM tbl_form WHERE form_id=$form_id";
$rec2= mysqli_query($connect, $sql2);


if($rec2 == TRUE) {

    $_SESSION['delete'] = "<div class='success'>Delete Lesson Successfully.</div>";
    $url = "http://localhost:8001/account/index.php";
    header('Location:' .$url,true , 302);
}
else
{
    $_SESSION['delete'] = "<div class='error'>Failed to Delete lesson.</div>";
    $url = "http://localhost:8001/form/manage-form.php?lesson_id=$lesson_id&form_id=$form_id";
    header('Location:' .$url,true , 401);//ページへのリダイレクトをif~else文にて行っている。
}

include('../account/partials/footer.tpl');
?>
