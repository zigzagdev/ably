<?php
include('./config/Constants.blade.php');
include('./account/partials/ClientHeader.blade.php');

  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }
?>

<html>
  <head>
    <title>TopPage</title>
    <link rel="stylesheet" href="./css/Account.css">
    <link rel="stylesheet" href="./css/Forms.css">
  </head>
  <body>
  <div style="margin: 0 100px 0 100px">
    <div>
      <h1 style="padding: 20px ; text-align:center">Upcoming Lessons</h1>
<?php
  $client_id = $_GET['client_id'];
    $sql2 = "
              SELECT
                  *
              FROM
                tbl_lesson
              WHERE
                NOW() > DATE_SUB(deadline, INTERVAL '13' DAY)
              ORDER BY
                created_at ASC
             ";

    $rec2 = mysqli_query($connect, $sql2);

    if($rec2==TRUE)
    {
      $count = mysqli_num_rows($rec2);
      if($count>0)
      {
        while($rows=mysqli_fetch_assoc($rec2))
        {
          $course      = $rows['course'];
          $description = $rows['description'];
          $deadline    = $rows['deadline'];
          $lesson_id   = $rows['lesson_id']
?>
        <div class="cardoutline">
          <div class="cardcontent">
            <p style="padding-top: 15px"><?php echo $course ?></p><br/>
            <?php echo $description ?><br/>
            <?php echo $deadline ?><br/>
            <a href="./client/form/ReserveForm.php?client_id=<?= $client_id?>"> Reserve your form</a>
          </div>
        </div>
<?php
        }
      } else
      {
        //
      }
    }
?>
      </div>
    </div>
  </body>
</html>
<?php include "./account/partials/ClientFooter.tpl"?>
