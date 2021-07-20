<?php include('partials/header_info.php'); ?>




<!--Main Section -->
<div class="main">
    <div class="wrapper">
        <h1 style="padding: 20px 0 0 50px">Lesson Index</h1>

        <br/><br/><br/>
        <table class="tbl-full">
            <tr>
                <th style="text-align: center">Course</th>
                <th  style="text-align: center">Content</th>
                <th  style="text-align: center">Lesson Day</th>
                <th  style="text-align: center">Reserve Form</th>
            </tr>
            <?php
            $sql2 = "SELECT * FROM tbl_lesson ";
            $rec2 = mysqli_query($connect, $sql2);


            if($rec2==TRUE)
            {
                $count = mysqli_num_rows($rec2); // Function to get all the rows in database

                $on=1;

                if($count>0)
                {
                    while($rows=mysqli_fetch_assoc($rec2))
                    {
                        $course = $rows['course'];
                        $content = $rows['content'];
                        $day = $rows['day'];
                        $lesson_id = $rows['lesson_id']
                        ?>
                        <tr>
                            <td style="text-align: center"><?php echo $course; ?></td>
                            <td style="text-align: center"><?php echo $content; ?></td>
                            <td style="text-align: center"><?php echo $day; ?></td>
                            <td style="text-align: center">
                                <a class="btn-primary" href="../form/reserve-form.php?lesson_id=<?= $lesson_id?>"> Reserve your form</a>
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
    <div class="clearfix"></div>
</div>

<?php include('partials/footer.php');  ?>
