<?php  include('../account/partials/header.php'); ?>

<?php
if(isset($_GET['lesson_id'])) {

    $lesson_id = $_GET['lesson_id'];
    $sql2 = "SELECT * FROM tbl_lesson  where lesson_id= $lesson_id";
    $rec2 = mysqli_query($connect, $sql2);

    if ($rec2 == true) {
        $count = mysqli_num_rows($rec2);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($rec2);
            $lesson_id = $row['lesson_id'];
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
            <a class="btn-secondary" href="../lesson/manage-lesson.php?account_id=<?= $account_id=$_GET['account_id']?>">To Lesson Page</a>
            <br/>

            <form action="" method="post" >
                <table class="tbl-30">
                    <tr>
                        <td class="text-white">Course:</td>
                        <td>
                            <input name="course" name="name" value="<?php echo $course; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Content:</td>
                        <td>
                            <textarea name="content" cols="30" rows="3"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Lesson Day:</td>
                        <td>
                            <input type="datetime-local" name="date">
                        </td>
                    </tr>
                    <br/><br/><br/>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update your Lesson" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['lesson_id']))
{
    $course = $_POST['course'];
    $content = $_POST['content'];
    $day = $_POST['day'];

    $sql2 = " INSERT INTO tbl_lesson SET course = '$course',content = '$content',day = '$day',lesson_id='$lesson_id' ";
    $rec2 = mysqli_query($connect, $sql2);


    if($rec2 == true)
    {
        $url = "http://localhost:8001/lesson/manage-lesson.php?account_id=$account_id&lesson_id=$lesson_id";
        $_SESSION['update'] = "<div class='success'>Account Updated Successfully.</div>";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Account.</div>";
        $url = "http://localhost:8001/lesson/update-lesson.php?account_id=$account_id&lesson_id=$lesson_id";
        header('Location:' .$url,true , 401);
        die();
    }
}
?>
<?php include ('../account/partials/footer.php'); ?>
