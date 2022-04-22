<?php
  include('../account/partials/LoginAccount.blade.php');

  if(isset($_SESSION['add']))
  {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
  }
  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }

  if(isset($_SESSION['lesson-upd']))
  {
    echo $_SESSION['lesson-upd'];
    unset($_SESSION['lesson-upd']);
  }

  if(isset($_SESSION['lesson-not-found']))
  {
    echo $_SESSION['lesson-not-found'];
    unset($_SESSION['lesson-not-found']);
  }

  if(isset($_SESSION['change-lesson']))
  {
    echo $_SESSION['change-lesson'];
    unset($_SESSION['change-lesson']);
  }

  $sql = "SELECT * FROM tbl_lesson inner join tbl_account on tbl_lesson.account_id = tbl_account.account_id'";
  $rec = mysqli_query($connect, $sql);

  if($rec == TRUE)
  {
    $count = mysqli_num_rows($rec);
    if ($count >= 0)
    {
      while ($rows = mysqli_fetch_array($rec))
      {
        $course     = $rows['course'];
        $content    = $rows['content'];
        $deadline   = $rows['deadline'];
        $lesson_id  = $rows['lesson_id'];
        $created_at = $rows['created_at'];
      }
    }
  }
?>

<html>
<head>
  <title>ManageLesson</title>
  <link rel="stylesheet" href="../css/Account.css">
  <link rel="stylesheet" href="../css/Forms.css">
</head>
<div class="main">
    <div class="wrapper">
        <div class="inner">
            <h1>Manage Your Lesson</h1>
            <br/>
            <br/><br/>
          <?php var_dump($sql);  ?>
        </div>
    </div>
</div>
</html>
<!--Main Section -->

<?php include('../account/partials/Footer.tpl') ?>
