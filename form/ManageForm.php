<?php include('../account/partials/HeaderInfo.blade.php'); ?>

<?php
  if (isset($_SESSION['add']))
  {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
  }
  if (isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }

  if (isset($_SESSION['update']))
  {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
  }
  if (isset($_SESSION['form-not-found']))
  {
    echo $_SESSION['form-not-found'];
    unset($_SESSION['form-not-found']);
  }

  if (isset($_SESSION['change-form']))
  {
    echo $_SESSION['change-form'];
    unset($_SESSION['change-form']);
  }
  $form_id = $_GET['form_id'];

  $sql2 = "SELECT * FROM tbl_form where form_id ='$form_id'";
  $rec2 = mysqli_query($connect, $sql2);
  if ($rec2 == TRUE)
  {
    $count = mysqli_num_rows($rec2); // Function to get all the rows in database
    $on = 1;
    if ($count > 0)
    {
      while ($rows = mysqli_fetch_array($rec2))
      {
        $name = $rows['name'];
        $phone = $rows['telephone'];
        $address = $rows['email'];
        $sex = $rows['sex'];
        $lesson_id = $rows['lesson_id'];
      }
    } else
    {
      //
    }
  }
?>

<html>
  <head>
    <title>ManageReserveForm</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 230px">
      <div class="mainaccount">
        <li style="list-style: none;  margin:27px 0 17px 40px; padding-top: 20px">
          <b style="font-size: 20px;width:100px;">Manage ReserveForm</b>
        </li>
        <li style="list-style: none;  margin:47px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            UserName
          </b>
          <b style="font-size: 20px"><?php echo $name ?></b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Email
          </b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Content
          </b>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      </div>
      <div style="margin:60px 0; text-align: center">
        <a class="btn-primary"
           href="UpdateForm.php?form_id=<?= $form_id = $_GET['form_id'] ?>">
          Update your Information</a>
        <a id="destroy" class="btn-secondary"
           href="DeleteForm.php?form_id=<?= $form_id = $_GET['form_id'] ?>">
          Delete your Information
        </a>
      </div>
    </div>
  </body>
</html>

<?php include('../account/partials/Footer.tpl') ?>

