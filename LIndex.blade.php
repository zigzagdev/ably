<?php
include('./config/Constants.blade.php');
include('./client/partials/HeaderEd.blade.php');

  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }

  $client_id = $_GET['client_id'];
  $sql = "
           SELECT
               deadline, user_name, course, remaining, description, image_name, lesson_id
           FROM
               tbl_lesson
               LEFT JOIN
                 tbl_account
                 ON tbl_lesson.account_id = tbl_account.account_id
           WHERE
               NOW() > DATE_SUB(deadline, INTERVAL '31' DAY)
           ORDER BY
               created_at ASC
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
          $image_name  = $rows['image_name'];
          $lesson_id   = $rows['lesson_id'];
        }
      }
    }
  $sql2 = "
           SELECT
               remaining - COUNT(tbl_form.lesson_id), tbl_form.lesson_id, user_name, description, image_name
           FROM
               tbl_form
               LEFT JOIN
                 tbl_lesson
                 ON tbl_form.lesson_id = tbl_lesson.lesson_id
               LEFT JOIN
                 tbl_account
                 ON tbl_lesson.account_id = tbl_account.account_id
           GROUP BY
               tbl_form.lesson_id
           ";

  $rec2 = mysqli_query($connect, $sql2);

  if($rec2==TRUE)
  {
    $count2 = mysqli_num_rows($rec2);
    if($count2>0)
    {
      while($rows2 = mysqli_fetch_assoc($rec2))
      {
        $rest      = $rows2['remaining - COUNT(tbl_form.lesson_id)'];
        $lesson_id = $rows2['lesson_id'];
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
  <body style="background: linear-gradient(90deg, gold 20%, floralwhite 50%, lightyellow 10%); height: 100%">
    <div style="margin: 0 100px 0 100px;">
      <h1 style="padding: 20px ; text-align:center">Upcoming Lessons</h1>
      <div class="cardoutline" style="display: flex">
<?php foreach($rec as $value ){ ?>
        <a href="./client/ReserveDetail.php?client_id=<?=$client_id;?>&lesson_id=<?=$value['lesson_id']?>" style="text-decoration: none; color: black; margin: 13px 0">
          <div class="cardcontent" style="margin: 10px;display: flex; float: left; flex-direction: column;">
            <span class="flex" style="margin-top: 8px">
              <img src="../images/profile/<?php echo $value['image_name']; ?>" class="c_img_index">
              <strong style="color: darkblue; padding:20px 0 0 20px">
                TeacherName<br>
                <strong style="color: black; padding: 5px 0 0 5px; display: flex"><?php echo $value['user_name']?></strong>
              </strong><br><br>
            </span>
            <div style="margin: 20px 20px 30px 20px; text-align: left">
              <strong style="overflow-wrap: break-word"><?php echo mb_strimwidth( strip_tags( $value['description'] ), 0, 60, '…', 'UTF-8' ); ?></strong>
            </div>
            <div style="text-align: center;margin-top:auto; padding-bottom: 25px">
              <strong style="float: left; margin-left: 30px;">Deadline</strong><br>
              <strong style="overflow-wrap: break-word; display: inline-block; "><?php echo $value['deadline'] ?></strong>
            </div>
          </div>
<?php } ?>
        </a>
      </div>
      <h1 style="padding: 20px ; text-align:center">Popular Lessons.</h1>
      <div class="cardoutline" style="display: inline-block; margin: 10px 10px 55px 10px">
<?php foreach($rec2 as $key){ if($key['remaining - COUNT(tbl_form.lesson_id)']){?>
        <a href="./client/ReserveDetail.php?client_id=<?=$client_id;?>&lesson_id=<?=$key['lesson_id'];?>" style="text-decoration: none; color: black; margin: 13px 0">
          <div class="cardcontent" style="margin: 12px; display: flex; float: left; flex-direction: column">
            <span class="flex" style="margin-top: 8px">
              <img src="../images/profile/<?php echo $key['image_name']; ?>" class="c_img_index">
              <strong style="color: darkblue; padding:20px 0 0 20px">
                TeacherName<br>
                <strong style="color: black; padding: 5px 0 0 5px; display: flex"><?php echo $key['user_name']?></strong>
              </strong><br><br>
            </span>
            <div style="margin: 10px 20px; text-align: left">
              <strong style="overflow-wrap: break-word"><?php echo mb_strimwidth( strip_tags( $key['description'] ), 0, 80, '…', 'UTF-8' ); ?></strong>
            </div>
            <div style="margin: 50px 20px 20px 20px; text-align: center; margin-top: auto">
              <strong style="float: left;">Rest Reservations</strong><br>
<?php }} ?>
        </a>
      </div>
    </div>
  </body>
</html>

<?php include "./client/partials/FooterEd.tpl" ?>