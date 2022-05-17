<?php
include('../account/partials/HeaderInfo.blade.php');

  $form_id= $_GET['form_id'];

  $sql2= "SELECT * FROM tbl_form WHERE form_id=$form_id";
  $rec2= mysqli_query($connect, $sql2);
  if ($rec2 == TRUE)
  {
    $count = mysqli_num_rows($rec2);
    $on = 1;
    if ($count > 0)
    {
      while ($rows = mysqli_fetch_array($rec2))
      {
        $asking = $rows['asking'];
      }
    }
  }
?>

<html>
  <head>
    <title>DeleteForm</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 130px">
      <div class="mainaccount">
        <form method="post" action="/">
          <li style="list-style: none;  margin:27px 0 17px 40px; padding-top: 20px">
            <b style="font-size: 20px;width:100px;">Delete ReserveForm</b>
          </li>
          <li style="list-style: none;  margin:47px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              Asking
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $asking ?></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        </form>
      </div>
      <div style="margin-bottom:40px ; text-align: center">
        <form action="" method="post">
          <input type="submit" class="btn-secondary" style="margin-right: 10px" value="Are you sure to delete ?">
        <?php
          $hostname = $_SERVER['HTTP_HOST'];
          if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false))
          {
            echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="btn-primary" style="margin-left: 10px">Return</a>';
          }
        ?>
        </form>
      </div>
    </div>
  </body>
</html>

<?php

  $sql3 = " DELETE FROM tbl_form WHERE form_id= '$form_id'" ;
  $rec3=mysqli_query($connect,$sql3);
  if($rec3 == TRUE)
  {
    $_SESSION['delete'] = "<div style='color: #ff6666'>Delete Lesson Successfully.</div>";
    header("Location:http://localhost:8001/Index.php", 302);
    die();
  } else
  {
    $_SESSION['delete'] = "<div class='error'>Failed to Delete lesson.</div>";
    header("Location:http://localhost:8001/form/ManageForm.php?form_id=$form_id", 401);
    die();
  }

include "./client/partials/FooterEd.tpl";
?>
