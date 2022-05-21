<?php
include './partials/HeaderEd.blade.php';

$client_id = $_GET['client_id'];
$lesson_id = $_GET['lesson_id'];

$sql = "SELECT * FROM tbl_lesson WHERE lesson_id= '$lesson_id'";

$rec = mysqli_query($connect, $sql);

if($rec == TRUE)
{
  $count = mysqli_num_rows($rec);
  if ($count >= 0)
  {
    while ($rows = mysqli_fetch_array($rec))
    {
      $course      = $rows['course'];
      $description = $rows['description'];
      $deadline    = $rows['deadline'];
      $account_id  = $rows['account_id'];
      $created_at  = $rows['created_at'];
    }
  }
}

?>