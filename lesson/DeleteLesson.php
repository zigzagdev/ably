<?php
include('../account/partials/Header.blade.php');

  $lesson_id= $_GET['lesson_id'];
  $account_id= $_GET['account_id'];

  $sql2= "DELETE FROM tbl_lesson WHERE lesson_id=$lesson_id";
  $rec2= mysqli_query($connect, $sql2);

  if($rec2 == TRUE)
  {
    $_SESSION['lesson-dlt'] = "<div class='success'>Delete Lesson Successfully.</div>";
    $url = "http://localhost:8001/account/ManageAccount.php?account_id=$account_id";
    header('Location:' .$url,true , 302);
  } else
  {
    $_SESSION['lesson-dlt-error'] = "<div class='error'>Failed to Delete lesson.</div>";
    $url = "http://localhost:8001/lesson/UpdateLesson.php?lesson_id=$lesson_id";
    header('Location:' .$url,true , 401);
  }

include('../account/partials/Footer.tpl');
?>


