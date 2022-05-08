<?php
include('../partials/FormHeader.blade.php');

$sql =
  "SELECT 
       user_name, deadline, course, remaining, description 
   FROM
       tbl_account 
       LEFT JOIN tbl_lesson
         ON tbl_account.account_id=tbl_lesson.account_id
   WHERE 
       deadline LIKE '%" .$_GET['keyword']. "%' 
     OR
       course LIKE '%" . $_GET["keyword"] . "%'
     OR  
       remaining LIKE '%" . $_GET["keyword"] . "%'
     OR                       
       user_name LIKE '%" . $_GET["keyword"] . "%'  
     OR                       
       description LIKE '%" . $_GET["keyword"] . "%'                                    
   ";

$rec = mysqli_query($connect, $sql);

if ($rec == TRUE) {
  $count = mysqli_num_rows($rec);
  if ($count > 0) {
    while ($rows = mysqli_fetch_assoc($rec)) {
      $user_name   = $rows['user_name'];
      $deadline    = $rows['deadline'];
      $course      = $rows['course'];
      $remaining   = $rows['remaining'];
      $description = $rows['description'];
    }
  }
}


$client_id = $_GET['client_id'];
  $sql2 = "SELECT name FROM tbl_client where client_id=$client_id";
  $rec2 = mysqli_query($connect, $sql2);

  if($rec2 == TRUE)
  {
    $count2 = mysqli_num_rows($rec2);
    if($count2>0)
    {
      while ($rows2 = mysqli_fetch_assoc($rec2))
      {
        $name = $rows2['name'];
      }
    }
  }
?>

<html>
  <head>
    <title>ReserveLessonForm</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body>
  </body>
</html>

<?php
  $client_id = $_GET['client_id'];

  if(isset($_POST['submit']))
    {
      $name = $_GET['name'];
      $sql3 = "INSERT INTO tbl_form SET name = '$name'";

    $rec3=mysqli_query($connect,$sql3);
    $url = "http://localhost:8001/account/Index.php";
    if($rec3 == true)
      {
        $_SESSION['form_s'] = "<div class='success text-center'>Form order Successfully.</div>";
        $form_id = mysqli_insert_id($mysqli);
        $url = "http://localhost:8001/form/ManageForm.php?lesson_id=$lesson_id&form_id=$form_id";
        header('Location:' .$url,true , 302);
      }
    else
      {
        $_SESSION['form_f'] = "<div class='success text-center'>Form order Failed.</div>";
        header("location: http://localhost:8001/client/form/ReserveForm.php?client_id=$client_id");
        die();
      }
    }

  include('../../account/partials/ClientFooter.tpl'); ?>
