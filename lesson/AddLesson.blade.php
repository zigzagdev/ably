<?php include('./header/LessonHeader.blade.php');

  if(isset($_SESSION['fail_lesson']))
  {
    echo $_SESSION['fail_lesson'];
    unset($_SESSION['fail_lesson']);
  }

  if(isset($_SESSION['validation']))
  {
    echo $_SESSION['validation'];
    unset($_SESSION['validation']);
  }

  $account_id = $_GET['account_id'];

  if(isset($_POST['submit']))
  {
    $course      = $_POST['course'];
    $description = $_POST['description'];
    $deadline    = $_POST['deadline'];
    $created_at  = date('Y-m-d H:i');

    if (empty($course) || empty($description) || empty($deadline))
    {
      $_SESSION['validation'] = "<div class='error'>Please fill your Registration.</div>";
      $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
      header('Location:' .$url,true , 401);
      die();
    }
    if (mb_strlen($description, 'UTF-8')<= 10 || mb_strlen($description, 'UTF-8')>= 200)
    {
      $_SESSION['validation'] = "<div class='error'>Please Fill the content within 10~200 characters.</div>";
      header("Location:http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id", 401);
      die();
    }
    if ($deadline <= $created_at)
    {
      $_SESSION['validation'] = "<div class='error'>Can't set Deadline before today .</div>";
      header("Location:http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id", 401);
      die();
    }

  $sql2 = " INSERT INTO tbl_lesson
            SET
              course       = '$course'
              ,description = '$description'
              ,deadline    = '$deadline'
              ,created_at  = '$created_at'
              ,account_id  = '$account_id'
          ";
  $rec2 = mysqli_query($connect,$sql2);

  if($rec2 == true)
  {
    $account_id = $_GET['account_id'];
    $_SESSION['lesson_add'] = "<div class='success'>Lesson was added correctly!</div>";
    header("location: http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id");
    exit();
  } else
  {
    $_SESSION['fail_lesson'] = "<div class='error'>Failed to Register your Lesson.</div>";
    $url = "localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
    header('Location:' . $url, true , 401);
    die();
  }
}

?>

<html>
  <head>
    <title>ReserveLessonForm</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <form action="" method="post" style="margin: 0 170px">
    <div>
      <fieldset class="mainaccount" style="margin: 0 100px">
        <legend style="text-align: center;"><b style="color: darkblue">LessonCreate Form</b></legend>
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
          <textarea name="description" class="input-responsive" cols="60" rows="4"></textarea>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            DeadLine
          </b>
          <input type="date" name="deadline" class="input-responsive" required>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <div style="text-align: center; margin: 30px 0 20px 0">
          <input type="submit" name="submit" value="Submit" class="btn btn-third">
          <button type="button" onclick=history.back() class="btn-secondary">Return</button>
        </div>
        </fieldset>
      </div>
    </form>
  </body>
</html>

<?php include('../account/partials/Footer.tpl'); ?>