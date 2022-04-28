<?php
include "../config/Constants.blade.php";

  $lesson_id = $_GET['lesson_id'];
  $sql = "SELECT * FROM tbl_lesson WHERE lesson_id=$lesson_id";

  $rec = mysqli_query($connect, $sql);

  if($rec == TRUE)
  {
  $count = mysqli_num_rows($rec);
  if ($count >= 0)
  {
    while ($rows = mysqli_fetch_array($rec))
    {
      $account_id  = $rows['account_id'];
    }
  }
}
  $sql2= "DELETE FROM tbl_lesson WHERE lesson_id=$lesson_id";
  $rec2= mysqli_query($connect, $sql2);

  if($rec2 == TRUE) {
    $_SESSION['delete_lesson'] = "<div class='success'>Delete Lesson Successfully.</div>";
    $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
    header('Location:' .$url,true , 302);
  } else {
    $_SESSION['delete_f_lesson'] = "<div class='error'>Failed to Delete lesson.</div>";
    $url = "http://localhost:8001/lesson/DeleteLesson.php?id=$account_id";
    header('Location:' . $url, true, 401);
  }
