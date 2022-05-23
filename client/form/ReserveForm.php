<?php
include('../partials/FormHeader.blade.php');

if(!empty($_GET['keyword'])) {
  $sql =
    "SELECT 
         user_name, deadline, course, remaining, description, image_name,tbl_lesson.lesson_id, remaining - COUNT(tbl_form.lesson_id)
     FROM
         tbl_lesson 
         LEFT JOIN tbl_account
           ON tbl_account.account_id = tbl_lesson.account_id
         RIGHT  JOIN tbl_form
           ON tbl_form.lesson_id = tbl_lesson.lesson_id
     WHERE 
         deadline LIKE '%" . $_GET['keyword'] . "%' 
       OR
         course LIKE '%" . $_GET["keyword"] . "%'
       OR  
         remaining LIKE '%" . $_GET["keyword"] . "%'
       OR                       
         user_name LIKE '%" . $_GET["keyword"] . "%'  
       OR                       
         description LIKE '%" . $_GET["keyword"] . "%'  
     GROUP BY
         tbl_form.lesson_id                                       
     ";

  $rec = mysqli_query($connect, $sql);

  if ($rec == TRUE) {
    $count = mysqli_num_rows($rec);
    if ($count > 0) {
      while ($rows = mysqli_fetch_assoc($rec)) {
        $user_name   = $rows['user_name'];
        $deadline    = $rows['deadline'];
        $course      = $rows['course'];
        $remaining   = $rows['remaining'];
        $description = $rows['description'];
        $image_name  = $rows['image_name'];
        $lesson_id   = $rows['lesson_id'];
        $rest        = $rows['remaining - COUNT(tbl_form.lesson_id)'];
      }
    }
  }


  $client_id = $_GET['client_id'];
  $sql2 = "SELECT name FROM tbl_client WHERE client_id = $client_id";
  $rec2 = mysqli_query($connect, $sql2);

  if ($rec2 == TRUE) {
    $count2 = mysqli_num_rows($rec2);
    if ($count2 > 0) {
      while ($rows2 = mysqli_fetch_assoc($rec2)) {
        $name = $rows2['name'];
      }
    }
  }
}
?>

<html>
  <head>
    <title>ReserveLessonIndex</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body>
    <h1 style="padding: 20px ; text-align:center">SearchResults</h1>
<?php
if(!empty($_GET['keyword'])){
   foreach ($rec as $value){?>
    <div style="display: inline-block; margin:0 30px 30px 45px">
      <a href="./Asking.php?client_id=<?=$client_id?>&lesson_id=<?=$value['lesson_id']?>" style="text-decoration: none; color: black; margin: 13px 0">
        <div class="cardcontent" style="margin: 0 10px;">
          <span style="display: flex">
            <strong style="padding:48px 30px 18px 50px"><?php echo $value['user_name']; ?></strong>
            <img src="../../images/profile/<?php echo $value['image_name']; ?>" class="c_img_index" style="margin-top: 20px"><br/>
          </span>
          <strong style="color: darkblue; float: left; padding:20px 0 10px 20px"><?php echo $value['course']; ?></strong><br><br>
          <div style="margin: 10px 20px;">
            <strong style="overflow-wrap: break-word; float: left"><?php echo mb_strimwidth( strip_tags( $value['description'] ), 0, 20, '…', 'UTF-8' ); ?></strong>
          </div><br><br>
          <div style="margin:0 20px 20px 20px; margin-top: auto">
            <strong style="float: left;">Rest Reservations</strong><br>
<?php if($value['remaining - COUNT(tbl_form.lesson_id)'] < 11 )  {?>
            <span>
              <strong style="float: left">
                Only remain <i style="color: red"><?php echo($value['remaining - COUNT(tbl_form.lesson_id)']); ?></i> seats !!
              </strong>
            </span>
<?php } else{?>
            <span>
              <strong style="float: left">
                Only remain <i style="color: blue"><?php echo($value['remaining - COUNT(tbl_form.lesson_id)']); ?></i> seats !!
              </strong>
            </span>
<?php } ?>
          </div>
        </div>
      </a>
    </div>
 <?php }} ?>
  </body>
</html>

<?php include('../../account/partials/ClientFooter.tpl');