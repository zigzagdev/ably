<?php
include('../partials/FormHeader.blade.php');

  if (isset($_SESSION['form_f']))
  {
    echo $_SESSION['form_f'];
    unset($_SESSION['form_f']);
  }

  $client_id = $_GET['client_id'];
  $sql = "SELECT name FROM tbl_client where client_id=$client_id";
  $rec = mysqli_query($connect, $sql);

  if($rec==TRUE)
  {
    $count = mysqli_num_rows($rec);
    if($count>0)
    {
      while ($rows = mysqli_fetch_assoc($rec))
      {
        $name = $rows['name'];
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
    <form action="" method="post" enctype="multipart/form-data" style="">
      <div style="margin-top: 60px">
          <fieldset class="mainaccount" style="margin 0 100px">
            <legend style="text-align: center;"><b style="color: darkblue">Lesson Reservation Form</b></legend>
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
              FullName
            </b>
             <?php  echo $name ?>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          </fieldset>
          <div style="text-align: center; margin-bottom: 30px">
          <input type="hidden" name="lesson_id" value="<?php echo filter_input(INPUT_GET, 'lesson_id');?>">
          <input type="submit" name="submit" value="Submit" class="btn btn-third">
          </div>
        </div>
    </form>
  </body>
</html>

<?php
  $client_id = $_GET['client_id'];

  if(isset($_POST['submit']))
    {
      $name = $_GET['name'];
      $sql3 = "INSERT INTO tbl_form SET name = '$name'";

    $rec3=mysqli_query($connect,$sql3);
    $url = "http://localhost:8001/account/Index.php";
    if($rec3 == true)
      {
        $_SESSION['form_s'] = "<div class='success text-center'>Form order Successfully.</div>";
        $form_id = mysqli_insert_id($mysqli);
        $url = "http://localhost:8001/form/ManageForm.php?lesson_id=$lesson_id&form_id=$form_id";
        header('Location:' .$url,true , 302);
      }
    else
      {
        $_SESSION['form_f'] = "<div class='success text-center'>Form order Failed.</div>";
        header("location: http://localhost:8001/client/form/ReserveForm.php?client_id=$client_id");
        die();
      }
    }

  include('../../account/partials/ClientFooter.tpl'); ?>
