<?php
session_start();

define('SITEURL', 'localhost:8001');
define('LOCALHOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'overcome');

$connect = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($connect));
$db_select = mysqli_select_db($connect, DB_NAME) or die(mysqli_error($connect));
date_default_timezone_set('Asia/Tokyo');
include('./account/partials/ClientHeader.tpl');

  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }
?>

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
        $sql2 = "SELECT
                    *
                 FROM
                    tbl_lesson
                 WHERE
                    NOW() > DATE_SUB(deadline, INTERVAL '13' DAY)
                 ORDER BY
                     created_at
                 ASC 
                    ";

        $rec2 = mysqli_query($connect, $sql2);

        if($rec2==TRUE)
          {
            $count = mysqli_num_rows($rec2); // Function to get all the rows in database
              if($count>0)
                {
                  while($rows=mysqli_fetch_assoc($rec2))
                    {
                      $course = $rows['course'];
                      $description = $rows['description'];
                      $deadline = $rows['deadline'];
                      $lesson_id = $rows['lesson_id']
        ?>
          <div class="cardoutline">
            <div class="cardcontent">
              <p style="padding-top: 15px"><?php echo $course ?></p><br/>
              <?php echo $description ?><br/>
              <?php echo $deadline ?><br/>
              <a href="client/form/ReserveForm.php?lesson_id=<?= $lesson_id?>"> Reserve your form</a>
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
