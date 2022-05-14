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
?>

<html>
  <head>
    <title>ReserveLessonForm</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body>
  <?php
  if(!empty($_GET['keyword']))
  { foreach ($rec as $value) ?>
    <h1 style="padding: 20px ; text-align:center">Popular Lessons.</h1>
    <div class="cardoutline" style="display: flex;">
      <a href="./Asking.php?client_id=<?= $client_id?>" style="text-decoration: none; color: black; margin: 13px 0">
        <div class="cardcontent" style="margin: 0 10px;">
          <span style="display: flex">
            <img src="../../images/profile/<?php echo $image_name; ?>" class="c_img_index">
            <strong style="padding:28px 0 8px 40px"></strong><br/>
          </span>
          <div style="margin: 20px 20px; text-align: left">
            <strong style="overflow-wrap: break-word"></strong>
          </div>
          <div style="margin: 50px 20px 20px 20px; text-align: center">
            <strong style="float: left; margin-left: 30px">Rest Reservations</strong><br>
            <strong style="overflow-wrap: break-word; display: inline-block">Only  !!</strong>
          </div>
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
