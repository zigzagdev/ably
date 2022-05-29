<?php
include "../../config/Constants.blade.php";

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
                  tbl_form
              WHERE
                  lesson_id = $lesson_id
                AND
                  client_id = $client_id
             ";

$deleterec = mysqli_query($connect, $deletesql);

if($deleterec == TRUE)
{
  $_SESSION['d_s_form'] = "<div class='success'>Delete your form Successfully.</div>";
  header("Location:http://localhost:8001/Index.php", 302);
  exit();
} else {
  $_SESSION['d_f_form'] = "<div class='success'>Failed to delete your form</div>";
  header("Location:http://localhost:8001/client/form/DeleteForm.php?client_id=$client_id&lesson_id=$lesson_id", 401);
  die();
}
?>