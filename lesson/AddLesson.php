<?php include('../account/partials/Header.blade.php'); ?>

<div class="main">
<div class="wrapper">
        <h1>Add Your lesson.</h1><br/>
        <br/>
        <a class="btn-primary" href="ManageLesson.php?account_id=<?= $account_id=$_GET['account_id']?>"> Back to your lesson page</a>
        <br/><br/>


        <form action="" method="post" >

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
                        <textarea name="content" cols="30" rows="3"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Lesson Day:</td>
                    <td>
                        <input type="datetime-local" name="day">
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
            $day = $_POST['day'];

            if (empty($course) || empty($content) || empty($day) ){
                die('Please fill all required fields!');
            }


            $sql2 = " INSERT INTO tbl_lesson SET course = '$course',content = '$content',day = '$day',account_id='$account_id' ";
            $rec2=mysqli_query($connect,$sql2) ;


            if($rec2 == true)
            {
                $_SESSION['add'] = "<div class='success'>Lesson add Successfully.</div>";
                $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
                header('Location:' .$url,true , 302);
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to Create Account.</div>";
                $url = "http://localhost:8001/lesson/ManageLesson.php?account_id=$account_id";
                header('Location:' .$url,true , 401);
                die();
            }
        }
        ?>
    </div>
</div>

<?php include('../account/partials/Footer.tpl'); ?>
