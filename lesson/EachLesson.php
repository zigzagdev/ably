<?php
include "./header/LessonHeader.blade.php";

  if(isset($_SESSION['fail_lesson']))
  {
    echo $_SESSION['fail_lesson'];
    unset($_SESSION['fail_lesson']);
  }

?>

<html>
  <head>
    <title>EachLessonPage</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>

    <div style="margin:60px 0; text-align: center">
      <div style="margin: 0 10px 20px 10px">
        <a class="lesson-btn-delete" style="margin: 0 7px 0 7px;" href="DeleteLesson.php?lesson_id=<?= $lesson_id=$_GET['lesson_id']?>">
          Delete your Lesson
        </a>
      </div>
    </div>
  </body>
</html>
<?php  include "../account/partials/Footer.tpl" ?>