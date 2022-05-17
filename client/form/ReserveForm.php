<?php
include('../partials/FormHeader.blade.php');

if(!empty($_GET['keyword'])) {
  $sql =
    "SELECT 
         user_name, deadline, course, remaining, description, image_name 
     FROM
         tbl_account 
         LEFT JOIN tbl_lesson
           ON tbl_account.account_id=tbl_lesson.account_id
     WHERE 
         deadline LIKE '%". $_GET['keyword']. "%' 
       OR
         course LIKE '%". $_GET["keyword"]. "%'
       OR  
         remaining LIKE '%". $_GET["keyword"]. "%'
       OR                       
         user_name LIKE '%". $_GET["keyword"]. "%'  
       OR                       
         description LIKE '%". $_GET["keyword"]. "%'                                    
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
      }
    }
  }
}

  $client_id = $_GET['client_id'];
  $sql2 = "SELECT name FROM tbl_client WHERE client_id = $client_id";
  $rec2 = mysqli_query($connect, $sql2);

  if($rec2 == TRUE)
  {
    $count2 = mysqli_num_rows($rec2);
    if($count2>0)
    {
      while ($rows2 = mysqli_fetch_assoc($rec2))
      {
        $name = $rows2['name'];
      }
    }
  }

$sql3 = "
           SELECT
               remaining - COUNT(tbl_form.lesson_id)
           FROM
               tbl_form
               LEFT JOIN tbl_lesson ON tbl_form.lesson_id = tbl_lesson.lesson_id
           GROUP BY
               tbl_form.lesson_id
           ";

  $rec3 = mysqli_query($connect, $sql3);
  if($rec3 == TRUE)
  {
    $count3 = mysqli_num_rows($rec3);
    if($count3 > 0)
    {
      while($rows3 = mysqli_fetch_assoc($rec3))
      {
        $rest  = $rows3['remaining - COUNT(tbl_form.lesson_id)'];
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
  <?php
  if(!empty($_GET['keyword']))
  { foreach ($rec as $value) ?>
    <h1 style="padding: 20px ; text-align:center">SearchResults</h1>
    <div class="cardoutline" style="display: flex;">
      <a href="./Asking.php?client_id=<?= $client_id?>" style="text-decoration: none; color: black; margin: 13px 0">
        <div class="cardcontent" style="margin: 0 10px;">
          <span style="display: flex">
            <strong style="padding:48px 30px 18px 50px"><?php echo $user_name; ?></strong>
            <img src="../../images/profile/<?php echo $image_name; ?>" class="c_img_index" style="margin-top: 20px"><br/>
          </span>
          <strong style="color: darkblue; float: left; padding:20px 0 10px 20px"><?php echo $course; ?></strong><br><br>
          <div style="margin: 10px 20px;">
            <strong style="overflow-wrap: break-word; float: left"><?php echo mb_strimwidth( strip_tags( $description ), 0, 20, '…', 'UTF-8' ); ?></strong>
          </div>
<?php { foreach ($rec3 as $value) ?>
          <div style="margin: 50px 20px 20px 20px; text-align: center">
            <strong style="float: left; margin-left: 30px">Rest Reservations<?php echo$value['remaining - COUNT(tbl_form.lesson_id)']?></strong><br>
            <strong style="overflow-wrap: break-word; display: inline-block">Only  !!</strong>
          </div>
<?php } ?>
        </div>
      </a>
    </div>
 <?php }


  ?>
  </body>
</html>

<?php
  $client_id = $_GET['client_id'];

  if(isset($_POST['submit']))
    {
      $asking = $_POST['asking'];
      $sql3 = "INSERT INTO tbl_form SET asking = '$asking'";

    $rec3=mysqli_query($connect,$sql3);
    if($rec3 == true)
      {
        $_SESSION['form_s'] = "<div class='success text-center'>Form order Successfully.</div>";
        $form_id = mysqli_insert_id($connect);
        header("Location:http://localhost:8001/client/ClientPage.php?client_id=$client_id", 302);
        die();
      }
    else
      {
        $_SESSION['form_f'] = "<div class='success text-center'>Form order Failed.</div>";
        header("location: http://localhost:8001/client/form/ReserveForm.php?client_id=$client_id");
        die();
      }
    }

  include('../../account/partials/ClientFooter.tpl'); ?>
