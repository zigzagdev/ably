<?php include('../account/partials/header.php'); ?>

<!--Main Section -->
<div class="main">
    <div class="wrapper">
        <div class="inner">
            <h1>Manage Your Lesson</h1>
            <br/>
            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['lesson-not-found']))
            {
                echo $_SESSION['lesson-not-found'];
                unset($_SESSION['lesson-not-found']);
            }

            if(isset($_SESSION['change-lesson']))
            {
                echo $_SESSION['change-lesson'];
                unset($_SESSION['change-lesson']);
            }
            ?>
            <br/><br/>
            <!---button--->
            <a class="btn-primary" href="update-lesson.php?id=<?= $id=$_GET['account_id']?>&id=<?= $id=$_GET['id']?>"> Update your Lesson</a>
            <a class="btn-secondary" href="delete-lesson.php?id=<?= $id=$_GET['account_id']?>&id=<?= $id=$_GET['id']?>">Delete your Lesson</a>
            <br/><br/><br/>
            <table class="tbl-full">
                <tr>
                    <th>Course</th>
                    <th>Content</th>
                    <th>Lesson Day</th>
                </tr>

                <?php

                $sql2 = "SELECT * FROM tbl_lesson where lesson_id ='$id'";

                $rec2 = mysqli_query($connect, $sql2);
                var_dump($sql2);

                if($rec2==TRUE)
                {
                    $count = mysqli_num_rows($rec2); // Function to get all the rows in database

                    $on=1;

                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($rec2))
                        {
                            $id = $rows['lesson_id'];
                            $course = $rows['course'];
                            $content = $rows['content'];
                            $day = $rows['day'];
                            $id2 = $rows['account_id'];
                            ?>
                            <tr>
                                <td><?php echo $course; ?></td>
                                <td><?php echo $content; ?></td>
                                <td><?php echo $day; ?></td>
                                <td></td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<!--Main Section -->

<?php include('../account/partials/footer.php') ?>
