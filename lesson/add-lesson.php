<?php include ('../account/partials/header.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Add Your lesson.</h1><br/>
        <br/>
        <a class="btn-primary" href="manage-lesson.php?id=<?= $id=$_GET['id']?>"> Back to your lesson page</a>
        <br/><br/>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Course:</td>
                    <td>
                        <input type="text" name="course"  placeholder="   Describe its course.">
                    </td>
                </tr>

                <tr>
                    <td>Content:</td>
                    <td>
                        <textarea name="content" cols="30" rows="5" placeholder="Describe its lesson."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Lesson Day:</td>
                    <td>
                        <input type="datetime-local" name="date">
                    </td>
                </tr>
                <br/><br/>




                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Lesson" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $course = $_POST['course'];
            $content = $_POST['content'];
            $day = $_POST['date'];

            if (empty($course) || empty($content) || empty($day) ){
                die('Please fill all required fields!');
            }


            $sql2 = "INSERT INTO tbl_lesson SET course = '$course',content = '$content', day = '$day'
                     account_id= $id ";
            $rec2=mysqli_query($connect,$sql2);
            var_dump($sql2);
            var_dump($rec2);

            if($rec2==true)
            {
                $url = "http://localhost:8001/account/manage-client.php?id=$id";
                $_SESSION['add'] = "<div class='success'>Account Updated Successfully.</div>";
                header('Location:' .$url,true , 302);
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to Update Account.</div>";
                $url = "http://localhost:8001/account/update-client.php?id=$id";
                header('Location:' .$url,true , 401);
                die();
            }
        }
        ?>
    </div>
</div>

<?php include ('../account/partials/footer.php'); ?>
