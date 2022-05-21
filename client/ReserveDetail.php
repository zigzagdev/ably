<?php
include './partials/HeaderEd.blade.php';
include "../config/Constants.blade.php";

if(isset($_SESSION['asking_f']))
{
  echo  $_SESSION['asking_f'];
  unset($_SESSION['asking_f']);
}

$client_id = $_GET['client_id'];
$lesson_id = $_GET['lesson_id'];

$sql = "
        SELECT
            client_id, lesson_id
        FROM
            tbl_form
            WHERE 
               client_id='$client_id' 
             AND 
               lesson_id='$lesson_id'
        ";

$rec = mysqli_query($connect, $sql);

if($rec == TRUE)
{
  $count = mysqli_num_rows($rec);
  if ($count >= 0)
  {
    $_SESSION['asking_f'] =  "<div class='success'>You already register this course.</div>";
    header("Location:http://localhost:8001/LIndex.blade.php?client_id=$client_id");
    die();
  }
}

?>