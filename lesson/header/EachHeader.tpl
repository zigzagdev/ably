<?php
include ('../config/Constants.blade.php');
  $sql = "
           SELECT
               *
           FROM
               tbl_lesson
             INNER  JOIN  tbl_account
           ON
               tbl_lesson.account_id = tbl_account.account_id
          ";
  $rec = mysqli_query($connect, $sql);

  if($rec == TRUE)
  {
    $count = mysqli_num_rows($rec);
    if ($count >= 0)
{
while ($rows = mysqli_fetch_array($rec))
{
$account_id = $rows['account_id'];
$lesson_id  = $rows['lesson_id'];
}
}
}
?>

<html>
<head>
  <link rel="stylesheet" href="../../css/Account.css">
</head>
<body style="background-color: ghostwhite">
<div class="infooutline">
  <div class="logo">
    <h1 class="hchar" style="color: #125EAE">Become a teacher..!</h1>
  </div>
  <div class="account text-center">
    <div class="wrapper">
      <a href = "../account/ManageAccount.php?lesson_id=<?= $_GET['lesson_id']; ?>" style="text-decoration: none; color: black" class="wrapper-inner">
        Detail
      </a>
      <a href = "../lesson/ManageLesson.php?lesson_id=<?= $_GET['lesson_id']; ?>" style="text-decoration: none; color: black" class="wrapper-inner">ManageLessonPage</a>
      <a href = "../lesson/AddLesson.blade.php?lesson_id=<?= $_GET['lesson_id'];?>" style="text-decoration: none; color: black" class="wrapper-inner">AddLessonPage</a>
    </div>
  </div>
</div>
</body>
</html>