<?php
include('./config/Constants.blade.php');
include('./account/partials/ClientHeader.blade.php');

  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }

  $client_id = $_GET['client_id'];
  $sql2 = "
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

    $rec2 = mysqli_query($connect, $sql2);

    if($rec2==TRUE)
    {
      $count = mysqli_num_rows($rec2);
      if($count>0)
      {
        while($rows=mysqli_fetch_assoc($rec2))
        {
          $image_name  = $rows['image_name'];
          $course      = $rows['course'];
          $description = $rows['description'];
          $deadline    = $rows['deadline'];
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
    <div>
      <h1 style="padding: 20px ; text-align:center">Upcoming Lessons</h1>
      <div class="cardoutline">
        <div class="cardcontent">
          <img src="../images/profile/<?php echo $image_name; ?>" class="c_img_index">
          <p style="padding-top: 5px"><?php echo $course ?></p><br/>
          <?php echo $description ?><br/>
          <?php echo $deadline ?><br/>
          <a href="./client/form/ReserveForm.php?client_id=<?= $client_id?>"> Reserve your form</a>
        </div>
      </div>
      </div>
    </div>
  </body>
</html>
<?php include "./account/partials/ClientFooter.tpl"?>


{{--SELECT--}}
{{--deadline,user_name, course--}}
{{--FROM--}}
{{--tbl_lesson--}}
{{--LEFT JOIN tbl_account--}}
{{--ON tbl_lesson.account_id = tbl_account.account_id--}}
{{--right JOIN tbl_form--}}
{{--ON tbl_form.lesson_id = tbl_lesson.lesson_id--}}
{{--WHERE--}}
{{--NOW() > DATE_SUB(deadline, INTERVAL '13' DAY)--}}
{{--GROUP BY--}}
{{--tbl_form.lesson_id--}}

{{--SELECT--}}
{{--remaining - COUNT(tbl_form.lesson_id)--}}
{{--FROM--}}
{{--tbl_form--}}
{{--LEFT JOIN tbl_lesson--}}
{{--ON tbl_form.lesson_id = tbl_lesson.lesson_id--}}
{{--GROUP BY--}}
{{--tbl_form.lesson_id--}}

{{--ORDER BY--}}
{{--tbl_lesson.created_at--}}
{{--ASC--}}