<?php
include('../account/partials/HeaderInfo.blade.php');

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

  $form_id= $_GET['form_id'];

  $sql2= "SELECT * FROM tbl_form WHERE form_id=$form_id";
  $rec2= mysqli_query($connect, $sql2);
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
        $email = $rows['email'];
        $sex = $rows['sex'];
        $lesson_id = $rows['lesson_id'];
      }
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
    <div style="margin: 0 130px">
      <div class="mainaccount">
        <form method="post" action="/">
          <li style="list-style: none;  margin:27px 0 17px 40px; padding-top: 20px">
            <b style="font-size: 20px;width:100px;">Delete ReserveForm</b>
          </li>
          <li style="list-style: none;  margin:47px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              Name
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $name ?></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              PhoneNumber
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $phone ?></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:160px; float: left;">
              Email
            </b>
            <b style="font-size: 20px; margin-right: 170px"><?php echo $email ?></b>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        </form>
      </div>
      <div style="margin-bottom:40px ; text-align: center">
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" class="btn-secondary" style="margin-right: 10px" value="Are you sure to delete ?">
        <?php
          $hostname = $_SERVER['HTTP_HOST'];
          if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false))
          {
            echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="btn-primary" style="margin-left: 10px">Return</a>';
          }
        ?>
      </div>
    </div>
  </body>
</html>

<?php
  $host = 'localhost';
  $username = 'root';
  $pass = 'root';
  $dbname = 'overcome';

  $form_id = $_GET['form_id'];

  if(isset($_POST['submit']))
  {
    $sql3 = " DELETE from tbl_form WHERE form_id= '$form_id'" ;
    $rec3=mysqli_query($connect,$sql3);
    var_dump($sql3);
    if($rec3 == TRUE)
    {
      $_SESSION['delete'] = "<div class='success'>Delete Lesson Successfully.</div>";
      $url = "http://localhost:8001/Index.php";
      header('Location:' .$url,true , 302);
    } else
    {
      $_SESSION['delete'] = "<div class='error'>Failed to Delete lesson.</div>";
      $url = "http://localhost:8001/form/ManageForm.php?form_id=$form_id";
      header('Location:' .$url,true , 401);
    }
  }
include('../account/partials/ClientFooter.tpl');
?>
