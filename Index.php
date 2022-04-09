<?php include('./account/partials/IndexHeader.blade.php') ?>

<!--Main Section -->
<html>
  <head>
    <title>TopPage</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 100px 0 100px">
      <div>
       <h1 style="padding: 20px ; text-align:center">Upcoming Lessons</h1>
        <?php
        $sql2 = "SELECT * FROM tbl_lesson ";
        $rec2 = mysqli_query($connect, $sql2);

        if($rec2==TRUE)
          {
            $count = mysqli_num_rows($rec2); // Function to get all the rows in database
              if($count>0)
                {
                  while($rows=mysqli_fetch_assoc($rec2))
                    {
                      $course = $rows['course'];
                      $content = $rows['content'];
                      $day = $rows['day'];
                      $lesson_id = $rows['lesson_id']
        ?>
          <div class="cardoutline">
            <div class="cardcontent">
              <p style="padding-top: 15px"><?php echo $course ?></p><br/>
              <?php echo $content ?><br/>
              <?php echo $day ?><br/>
              <a href="./form/ReserveForm.php?lesson_id=<?= $lesson_id?>"> Reserve your form</a>
            </div>
          </div>
        <?php
                    }
                }
                else
                {
                    //
                }
            }
        ?>
      </div>
    </div>
  </body>
</html>
<?php include "./account/partials/Footer.tpl"?>
