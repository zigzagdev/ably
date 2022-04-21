<?php
include('../account/partials/LoginAccount.blade.php');

if(isset($_POST['submit']))
{
  $course     = $_POST['course'];
  $content    = $_POST['content'];
  $deadline   = $_POST['deadline'];
  $account_id = $_GET['account_id'];
  $created_at = time();

  if (empty($course) || empty($content) || empty($deadline))
  {
    $_SESSION['add'] = "<div class='error'>Please fill your Registration.</div>";
    $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
    header('Location:' .$url,true , 401);
    die();
  }

  if (!preg_match("/^[a-zA-Z-' ]*$/", $course)) {
    $error_message[] = "Only English is valid.";
    die();
  }

  $sql2 = " INSERT INTO tbl_lesson 
            SET 
              course      = '$course'
              ,content    = '$content'
              ,deadline   = '$deadline'
              ,account_id = '$account_id'
              ,created_at = '$created_at' 
          ";
  $rec2=mysqli_query($connect,$sql2);

  if($rec2 == true)
  {
    $_SESSION['add'] = "<div class='success'>Lesson add Successfully.</div>";
    $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
    header('Location:' .$url,true , 302);
  } else
  {
    $_SESSION['add'] = "<div class='error'>Failed to Register your Lesson.</div>";
    $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
    header('Location:' .$url,true , 401);
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
    <form action="" method="post" enctype="multipart/form-data" style="">
    <div>
      <fieldset class="mainaccount" style="margin 0 100px">
        <legend style="text-align: center;"><b style="color: darkblue">LessonCreate Form</b></legend>
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            LessonName(Title)
          </b>
          <select name="course" style="margin-left: 30px">
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
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Content
          </b>
          <input type="text" name="content" placeholder="abc@com" class="input-responsive"  required style="height: 30px; width: 240px">
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            DeadLine
          </b>
          <input type="date" name="deadline" class="input-responsive" required>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        </fieldset>
        <div style="text-align: center; margin-bottom: 30px">
          <input type="hidden" name="lesson_id" value="<?php echo filter_input(INPUT_GET, 'lesson_id');?>">
          <input type="submit" name="submit" value="Submit" class="btn btn-third">
        </div>
      </div>
    </form>
  </body>
</html>

<?php include('../account/partials/Footer.tpl'); ?>
