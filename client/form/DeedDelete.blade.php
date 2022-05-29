<?php
include "../config/Constants.blade.php";

$lesson_id = $_GET['lesson_id'];
$client_id = $_GET['client_id'];

$sql = "
        SELECT
            *
          FROM
            tbl_form
        WHERE
            lesson_id = $lesson_id
          AND
            client_id = $client_id
       ";

$rec = mysqli_query($connect, $sql);
if($rec == TRUE)
{
  $count = mysqli_num_rows($rec);
}

$deletesql = "
              DELETE
                FROM
                  tbl_lesson
              WHERE
                  lesson_id = $lesson_id
                AND
                  client_id = $client_id
             ";

$deleterec = mysqli_query($connect, $deletesql);

  if($deleterec == TRUE) {
    $_SESSION['delete_lesson'] = "<div class='success'>Delete Lesson Successfully.</div>";
    header("Location:http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id", 302);
  } else {
    $_SESSION['delete_f_lesson'] = "<div class='error'>Failed to Delete lesson.</div>";
    header("Location:http://localhost:8001/lesson/DeleteLesson.php?id=$account_id", 401);
  }

?>