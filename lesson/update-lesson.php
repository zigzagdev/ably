<?php  include('../account/partials/header.php'); ?>

<?php
if(isset($_GET['lesson_id'])) {

    $sql2 = "SELECT * FROM tbl_lesson where account_id='$lesson_id'";
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

            <form action="" method="post" >
                <table class="tbl-30">
                    <tr>
                        <td class="text-white">Course:</td>
                        <td>
                            <input type="text" name="course" value="<?php echo $course; ?>">
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
if(isset($_POST['submit']))
{

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $content = $_POST['content'];

    if(isset($_FILES['image']['name']))
    {
        $image_name = $_FILES['image']['name'];

        if($image_name != "")
        {

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/profile/".$image_name;
            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                $url = "http://localhost:8001/account/update-client.php?id=$row[id]";
                header('Location:'.$url,true , 401);
                die();
            }
            if($current_image!="")
            {
                $remove_path = "../images/profile/".$current_image;
                $remove = unlink($remove_path);
                if($remove==false)
                {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                    $url = "http://localhost:8001/account/update-client.php?id=$id";
                    header('Location:' .$url,true , 401);
                    die();
                }
            }
        }
        else
        {
            $image_name = $current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }
    $sql = "UPDATE tbl_account SET username='$username',image_name='$image_name',email='$email',
             content='$content' WHERE id=$id ";
    $rec = mysqli_query($connect, $sql);


    if($rec==true)
    {
        $url = "http://localhost:8001/account/manage-lesson.php?id=$id";
        $_SESSION['update'] = "<div class='success'>Account Updated Successfully.</div>";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Account.</div>";
        $url = "http://localhost:8001/account/update-lesson.php?id=$id";
        header('Location:' .$url,true , 401);
        die();
    }
}
?>
<?php include ('../account/partials/footer.php'); ?>
