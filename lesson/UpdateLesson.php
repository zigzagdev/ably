<?php  include('../account/partials/Header.blade.php'); ?>

<?php
if(isset($_GET['lesson_id'])) {

    $lesson_id = $_GET['lesson_id'];
    $sql2 = "SELECT * FROM tbl_lesson  where lesson_id= $lesson_id";
    $rec2 = mysqli_query($connect, $sql2);

    if ($rec2 == true) {
        $count = mysqli_num_rows($rec2);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($rec2);
            $course = $row['course'];
            $content = $row['content'];
            $day = $row['day'];

        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>
<div class="main2">
    <div class="wrapper">
        <div class="inner">
            <h1>Update your Lesson</h1>
            <br/><br/>
            <a class="btn-secondary" href="ManageLesson.php?account_id=<?= $account_id=$_GET['account_id']?>">To Lesson Page</a>
            <br/>

            <form action="" method="post" >
                <table class="tbl-30">
                    <tr>
                        <td class="text-white" style="text-align: center">Course:</td>
                        <td>
                            <input name="course" name="name" value="<?php echo $course; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center">Content:</td>
                        <td>
                            <textarea name="content" cols="30" rows="3"><?php echo $content; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center">Lesson Day:</td>
                        <td>
                            <input type="datetime-local" name="day"　value="<?php echo $day; ?>">
                        </td>
                    </tr>

                    <br/><br/><br/>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Update your Lesson" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>
</div>

<?php
  if(isset($_POST['submit']))
  {
    $course     = $_POST['course'];
    $content    = $_POST['content'];
    $day        = $_POST['day'];
    $created_at = time();
    if (empty($course) || empty($content) || empty($day) )
    {
      $_SESSION['submit'] = "<div style='text-align: center; color: #ff6666; font-size: 20px'>Failed to Upload Lesson. </div>";
      $url = "http://localhost:8001/lesson/UpdateLesson.php?account_id=$account_id";
      header('Location:'.$url,true , 401);
      die();
    }

    $sql2 = " UPDATE tbl_lesson SET  
                     course      = '$course'
                     ,content    = '$content'
                     ,day        = '$day' 
                     ,created_at = '$created_at'
               WHERE 
                     lesson_id=$lesson_id
            ";
    $rec2 = mysqli_query($connect, $sql2) or die(mysqli_error($connect));


    if($rec2 == true)
    {
        $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
        $_SESSION['update'] = "<div class='success'>Account Updated Successfully.</div>";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Account.</div>";
        $url = "http://localhost:8001/lesson/UpdateLesson.php?account_id=$account_id&lesson_id=$lesson_id";
        header('Location:' .$url,true , 401);
        die();
    }
}

include('../account/partials/Footer.tpl'); ?>


