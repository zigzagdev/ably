<?php include('../account/partials/Header.blade.php'); ?>

<html>
<head>
  <title>ManageReserveForm</title>
  <link rel="stylesheet" href="../css/Account.css">
  <link rel="stylesheet" href="../css/Forms.css">
</head>
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
<!--            <a class="btn-danger" href="AddLesson.php?account_id=--><?//=$account_id=$_GET['account_id']?><!--">-->
<!--              Add others Lessons-->
<!--            </a>-->

            <table class="tbl-full">
                <tr>
                    <th style="text-align: center" >Course</th>
                    <th style="text-align: center">Content</th>
                    <th style="text-align: center">Lesson Day</th>
                    <th style="text-align: center">Reservation</th>
                    <th style="text-align: center">Maintenance</th>
                </tr>

                <?php
                $lesson_id = $_GET['lesson_id'];

//                $sql2 = "SELECT * FROM tbl_lesson where lesson_id = $lesson_id ";        // where means selected by each account
//                $sql3 =  " select f.1lesson_id,count(1) from tbl_form f inner join tbl_lesson l on l.lesson_id = f.lesson_id
//                           where l.account_id = 19 group by f.lesson_id ;";


                $rec2 = mysqli_query($connect, $sql2);
                $rec3 = mysqli_query($connect, $sql3);

                if($rec2 && $rec3 ==TRUE)
                {
                    $count = mysqli_num_rows($rec2); // Function to get all the rows in database
                    $count2 = mysqli_num_rows($rec3);

                    if ($count >= 0 && $count2 >= 1)
                     {
                        while($rows=mysqli_fetch_array($rec2) and $rows2=mysqli_fetch_array($rec3))
                        {
                            $course = $rows['course'];
                            $content = $rows['content'];
                            $day = $rows['day'];
                            $lesson_id = $rows['lesson_id'];
                            $lesson = $rows2['f.lesson_id'];
                            ?>
                            <tr>
                                <td style="text-align: center"><?php echo $course; ?></td>
                                <td style="text-align: center"><?php echo $content; ?></td>
                                <td style="text-align: center"><?php echo $day; ?></td>
                                <td style="text-align: center"><?php echo $lesson?></td>
                                <td style="text-align: center">
                                    <a class="btn-primary" href="UpdateLesson.php?account_id=<?= $account_id=$_GET['account_id']?>&lesson_id=<?= $lesson_id?>">
                                      Update your Lesson
                                    </a>
                                    <a id="destroy" class="btn-secondary" href="DeleteLesson.php?account_id=<?= $account_id=$_GET['account_id']?>&lesson_id=<?= $lesson_id?>">
                                      Delete your Lesson
                                    </a>

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
</html>
<!--Main Section -->

<?php include('../account/partials/Footer.tpl') ?>
