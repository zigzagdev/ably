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
            <a class="btn-danger" href="add-lesson.php?account_id=<?= $account_id=$_GET['account_id']?>"> Add others Lessons</a>

            <br/><br/><br/>
            <table class="tbl-full">
                <tr>
                    <th style="text-align: center" >Course</th>
                    <th style="text-align: center">Content</th>
                    <th style="text-align: center">Lesson Day</th>
                    <th style="text-align: center">Reservation</th>
                    <th style="text-align: center">Maintenance</th>
                </tr>

                <?php

                $sql2 = "SELECT * FROM tbl_lesson where account_id ='$account_id'";
                $sql3 = "SELECT COUNT(lesson_id) AS lesson_id FROM tbl_form GROUP BY lesson_id;";

                $rec2 = mysqli_query($connect, $sql2);
                $rec3 = mysqli_query($connect, $sql3);

                if($rec2 && $rec3 ==TRUE)
                {
                    $count = mysqli_num_rows($rec2); // Function to get all the rows in database
                    $count2 = mysqli_num_rows($rec3);

                    $on=1;


                    if($count>0)
                    {
                        while($rows=mysqli_fetch_array($rec2)) while($rows2=mysqli_fetch_array($rec3))
                        {
                            $course = $rows['course'];
                            $content = $rows['content'];
                            $day = $rows['day'];
                            $lesson = $rows2['lesson_id'];
                            ?>
                            <tr>
                                <td style="text-align: center"><?php echo $course; ?></td>
                                <td style="text-align: center"><?php echo $content; ?></td>
                                <td style="text-align: center"><?php echo $day; ?></td>
                                <td style="text-align: center"><?php echo $lesson?></td>
                                <td>
                                    <a class="btn-primary" href="update-lesson.php?account_id=<?= $account_id=$_GET['account_id']?>&lesson_id=<?= $lesson_id?>"> Update your Lesson</a>
                                    <a class="btn-secondary" href="delete-lesson.php?account_id=<?= $account_id=$_GET['account_id']?>&lesson_id=<?= $lesson_id?>"> Delete your Lesson</a>
                                </td>
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
