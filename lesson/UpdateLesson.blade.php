<?php
include('./header/LessonHeader.blade.php');

  if(isset($_SESSION['fail-lesson']))
  {
    echo $_SESSION['fail-lesson'];
    unset($_SESSION['fail-lesson']);
  }
  if(isset($_SESSION['lesson-upd-fail']))
  {
    echo $_SESSION['lesson-upd-fail'];
    unset($_SESSION['lesson-upd-fail']);
  }

  if(isset($_SESSION['lesson-dlt-error']))
  {
    echo $_SESSION['lesson-dlt-error'];
    unset($_SESSION['lesson-dlt-error']);
  }

  if(isset($_GET['lesson_id']))
  {
    $lesson_id = $_GET['lesson_id'];
    $sql = "SELECT * FROM tbl_lesson  where lesson_id= $lesson_id";
    $rec = mysqli_query($connect, $sql);
    if ($rec == true)
    {
      $count = mysqli_num_rows($rec);
      if ($count == 1)
      {
        $row = mysqli_fetch_assoc($rec);
        $course = $row['course'];
        $content = $row['content'];
        $deadline = $row['deadline'];
      } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
?>
<html>
  <head>
    <title>UpdateLesson</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
<?php if( !empty($error_message) ): ?>
    <ul class="error_message">
<?php foreach( $error_message as $value ): ?>
      <p style="color: #d9534f; text-align: center"><?php echo $value; ?></p>
<?php endforeach; ?>
    </ul>
<?php endif; ?>
    <form action="" method="post" style="margin: 50px 170px">
      <fieldset class="mainaccount" style="margin: 0 100px">
        <legend style="text-align: center;"><b style="color: darkblue; font-size: 25px">LessonUpdate Form</b></legend>
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            LessonName(Title)
          </b>
          <select name="course">
            <option value="">Select your first native language</option>
            <option value="English(British accent)">English(British accent)</option>
            <option value="English(American accent)">English(American accent)</option>
            <option value="English(Australia accent)">English(Australia accent)</option>
            <option value="English(NZ accent)">English(NZ accent)</option>
            <option value="English(French accent)">English(French accent)</option>
            <option value="English(Canada accent)">English(Canada accent)</option>
            <option value="French(advanced)">French(advanced)</option>
            <option value="French(intermediate)">French(intermediate)</option>
            <option value="French(beginner,)">French(beginner)</option>
            <option value="Spanish(advanced)">Spanish(advanced)</option>
            <option value="Spanish(intermediate)">Spanish(intermediate)</option>
            <option value="Spanish(beginner)">Spanish(beginner)</option>
            <option value="German(advanced)">German(advanced)</option>
            <option value="German(intermediate)">German(intermediate)</option>
            <option value="German(beginner)">German(beginner)</option>
            <option value="Japanese(advanced)">Japanese(advanced)</option>
            <option value="Japanese(intermediate)">japanese(intermediate)</option>
            <option value="Japanese(beginner)">Japanese(beginner)</option>
          </select>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:157px; vertical-align: 110%">
            LessonDetail
          </b>
          <textarea name="content" class="input-responsive" cols="60" rows="4"><?php echo $content ?></textarea>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            DeadLine
          </b>
          <input type="date" name="deadline" class="input-responsive" value="<?php echo $deadline ?>" required>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <div style="text-align: center; margin: 30px 0 20px 0">
          <input type="submit" name="submit" value="Submit" class="btn-primary">
          <button type="button" onclick=history.back() class="btn-secondary">Return</button>
        </div>
      </fieldset>
    </form>
    <div style="margin:60px 0; text-align: center">
      <div style="margin: 0 10px 20px 10px">
        <a class="lesson-btn-delete" style="margin: 0 7px 0 7px;" href="DeleteLesson.php?lesson_id=<?= $lesson_id=$_GET['lesson_id']?>">
          Delete your Lesson
        </a>
      </div>
    </div>
  </body>
</html>
<?php
  if(isset($_POST['submit']))
  {
    $course     = $_POST['course'];
    $content    = $_POST['content'];
    $deadline   = $_POST['deadline'];
    $updated_at = date('Y-m-d H:i');

    if (empty($course) || empty($content) || empty($deadline) )
    {
      $_SESSION['fail-lesson'] = "<div class='fail'>Failed to Upload Lesson. </div>";
      $url = "http://localhost:8001/lesson/UpdateLesson.blade.php?lesson_id=$lesson_id";
      header('Location:'.$url,true , 401);
      die();
    }

    $sql2 = " UPDATE tbl_lesson SET  
                     course      = '$course'
                     ,content    = '$content'
                     ,deadline   = '$deadline'
                     ,updated_at = '$updated_at'
               WHERE 
                     lesson_id=$lesson_id
            ";
    $rec2 = mysqli_query($connect, $sql2) or die(mysqli_error($connect));

    if($rec2 == true)
    {
        $url = "http://localhost:8001/lesson/ManageLesson.php?lesson_id=$lesson_id";
        $_SESSION['lesson-upd'] = "<div class='success' style='font-size: 30px'> Your Lesson was Updated Successfully.</div>";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['lesson-upd-fail'] = "<div class='fail'><i style='color: #ff6666;font-size: 20px'>Failed to Update Lesson.</i></div>";
        $url = "http://localhost:8001/lesson/UpdateLesson.blade.php?lesson_id=$lesson_id";
        header('Location:' .$url,true , 401);
        die();
    }
}

include('../account/partials/Footer.tpl'); ?>


