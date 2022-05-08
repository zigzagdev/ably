<?php
include('./config/Constants.blade.php');
include('./account/partials/ClientHeader.blade.php');

  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }

  $client_id = $_GET['client_id'];
  $sql = "
           SELECT
               deadline,user_name, course,remaining,description,image_name
           FROM
               tbl_lesson
               LEFT JOIN tbl_account
                 ON tbl_lesson.account_id = tbl_account.account_id
           WHERE
               NOW() > DATE_SUB(deadline, INTERVAL '13' DAY)
             ORDER BY
               created_at
             ASC
           ";

    $rec = mysqli_query($connect, $sql);

    if($rec == TRUE)
    {
      $count = mysqli_num_rows($rec);
      if($count>0)
      {
        while($rows=mysqli_fetch_assoc($rec))
        {
          $image_name  = $rows['image_name'];
          $course      = $rows['course'];
          $description = $rows['description'];
          $deadline    = $rows['deadline'];
        }
      }
    }
  $sql2 = "
           SELECT
               remaining - COUNT(tbl_form.lesson_id)
           FROM
               tbl_form
               LEFT JOIN tbl_lesson
                 ON tbl_form.lesson_id = tbl_lesson.lesson_id
           GROUP BY
               tbl_form.lesson_id
           ";

  $rec2 = mysqli_query($connect, $sql2);

  if($rec2==TRUE)
  {
    $count = mysqli_num_rows($rec2);
    if($count>0)
    {
      while($rows=mysqli_fetch_assoc($rec2))
      {
        $rest  = $rows['remaining - COUNT(tbl_form.lesson_id)'];
      }
    }
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
      <h1 style="padding: 20px ; text-align:center">Upcoming Lessons</h1>
      <div class="cardoutline" style="display: flex;">
        <a href="./client/form/ReserveForm.php?client_id=<?= $client_id?>" style="text-decoration: none; color: black; margin: 13px 0">
          <div class="cardcontent" style="margin: 0 10px;">
            <span style="display: flex">
              <img src="../images/profile/<?php echo $image_name; ?>" class="c_img_index">
              <strong style="padding:28px 0 8px 40px"><?php echo $course ?></strong><br/>
            </span>
            <div style="margin: 20px 20px; text-align: left">
              <strong style="overflow-wrap: break-word"><?php echo mb_strimwidth( strip_tags( $description ), 0, 80, '…', 'UTF-8' ); ?></strong>
            </div>
            <div style="margin: 50px 20px 20px 20px; text-align: center">
              <strong style="float: left; margin-left: 30px">Deadline</strong><br>
              <strong style="overflow-wrap: break-word; display: inline-block"><?php echo $deadline ?></strong>
            </div>
          </div>
        </a>
      </div>
      <h1 style="padding: 20px ; text-align:center">Popular Lessons.</h1>
      <div class="cardoutline" style="display: flex;">
        <a href="./client/form/ReserveForm.php?client_id=<?= $client_id?>" style="text-decoration: none; color: black; margin: 13px 0">
          <div class="cardcontent" style="margin: 0 10px;">
            <span style="display: flex">
              <img src="../images/profile/<?php echo $image_name; ?>" class="c_img_index">
              <strong style="padding:28px 0 8px 40px"><?php echo $course ?></strong><br/>
            </span>
            <div style="margin: 20px 20px; text-align: left">
              <strong style="overflow-wrap: break-word"><?php echo mb_strimwidth( strip_tags( $description ), 0, 80, '…', 'UTF-8' ); ?></strong>
            </div>
            <div style="margin: 50px 20px 20px 20px; text-align: center">
              <strong style="float: left; margin-left: 30px">Rest Reservations</strong><br>
              <strong style="overflow-wrap: break-word; display: inline-block">Only <?php echo $rest ?> !!</strong>
            </div>
          </div>
        </a>
      </div>
    </div>
  </body>
</html>
<?php include "./account/partials/ClientFooter.tpl"?>