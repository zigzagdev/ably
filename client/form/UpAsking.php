<?php
include  "../partials/FormHeader.blade.php";

if(isset($_SESSION['asking_up_f']))
{
  echo  $_SESSION['asking_up_f'];
  unset($_SESSION['asking_up_f']);
}

$client_id = $_GET['client_id'];
$form_id   = $_GET['form_id'];

if ($_GET['client_id'] && $_GET['form_id'])
{
  $sql = " SELECT asking from tbl_form WHERE client_id = '$client_id' && form_id = '$form_id' ";
  $rec = mysqli_query($connect, $sql);
  if ($rec == true) {
    $count = mysqli_num_rows($rec);
    if ($count == 1) {
      $row = mysqli_fetch_assoc($rec);
      $asking = $row['asking'];
    } else {
      header('Location: '. $_SERVER['HTTP_REFERER']);
      die();
    }
  }
}

?>

<html>
  <head>
    <title>Update Asking Form</title>
    <link rel="stylesheet" href="../../css/Account.css">
    <link rel="stylesheet" href="../../css/Forms.css">
  </head>
  <body style="background: linear-gradient(180deg, whitesmoke 5%, floralwhite 60%, snow 40%, snow 100%);">
    <div style="margin: 10px 130px">
      <strong style="text-align: left; margin: 35px 0 30px 30px;display: inline-block">Asking questions to tutor at here !!</strong>
      <form action="" method="post">
        <li style="list-style: none;">
          <textarea id="asking" type="text" name="asking" cols="100" rows="6"
                    style="margin:15px 0 0 50px" required placeholder="Write something .."></textarea>
        </li>
        <div style="margin:60px 0; text-align: center">
          <div style="margin: 0 10px 20px 10px">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary" style="margin-top: 41px; width: 110px; height: 54px">
            <button type="button" onclick=history.back() class="btn-primary" style="height: 53px; width: 103px;">Return</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>


<?php
include "../partials/FooterEd.tpl";

$client_id = $_GET['client_id'];
$lesson_id = $_GET['lesson_id'];

if(isset($_POST['submit'])) {
  $asking = $_POST['asking'];
  $update_at = date('Y-m-d H:i');

  if (4 > mb_strlen($asking, 'UTF-8') || 100 < mb_strlen($asking, 'UTF-8')) {
    $_SESSION['asking_up_f'] = "<div class='success'>Please fill your content in 4~50 words. !</div>";
    header("Location:http://localhost:8001/client/form/UpAsking.php?client_id=$client_id&form_id=$form_id", 401);
    die();
  }
  if (!preg_match("/^[a-zA-Z-' ]*$/", $asking)) {
    $_SESSION['asking_up_f'] = "<div class='success'>Only English is valid !</div>";
    header("Location:http://localhost:8001/client/form/UpAsking.php?client_id=$client_id&form_id=$form_id", 401);
    die();
  }

  $sql2 = "
            UPDATE
                tbl_form
              SET 
                asking     = '$asking',
                updated_at = '$update_at',
                client_id  = '$client_id',
                lesson_id  = '$lesson_id'
          ";
  $rec3 = mysqli_query($connect, $sql2);

  if ($rec3 == true) {
    $_SESSION['asking_up_suc'] = "<div class='success'>Your asking form was updated correctly !</div>";
    header("location: http://localhost:8001/client/ClientPage.php?client_id=$client_id ");
    exit();
  } else {
    $_SESSION['asking_up_f'] = "<div class='error'>Failed to Register your form.</div>";
    header("Location:http://localhost:8001/client/form/Asking.php?client_id=$client_id&lesson_id=$lesson_id", 401);
    die();
  }
}


?>
