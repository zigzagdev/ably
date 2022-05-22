<?php
include('../partials/FormHeader.blade.php');

  if(isset($_SESSION['asking_f']))
  {
    echo  $_SESSION['asking_f'];
    unset($_SESSION['asking_f']);
  }
  $client_id = $_GET['client_id'];
  $lesson_id = $_GET['lesson_id'];

  $sql = "
           SELECT
               client_id, lesson_id
           FROM
               tbl_form
           WHERE 
               client_id='$client_id' 
             AND 
               lesson_id='$lesson_id'
          ";

  $rec  = mysqli_query($connect,$sql);
  $rec2 = mysqli_num_rows($rec);
  if ($rec2 > 0) {
    $_SESSION['asking_f'] =  "<div class='success'>You already register this course.</div>";
    header("Location:http://localhost:8001/client/form/Asking.php?client_id=$client_id&lesson_id=$lesson_id");
    die();
  }

?>

<html>
  <head>
    <title>ReservePage</title>
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
            <input type="submit" name="submit" value="submit" class=" btn-primary">
<?php
$hostname = $_SERVER['HTTP_HOST'];
if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false))
{
  echo '<a href="'. $_SERVER['HTTP_REFERER']. '" class="btn-primary" style="margin-left: 10px">Return Page</a>';
}
?>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
<?php include('../partials/FooterEd.tpl');

$client_id = $_GET['client_id'];
$lesson_id = $_GET['lesson_id'];

if(isset($_POST['submit'])) {
  $asking     = $_POST['asking'];
  $created_at = date('Y-m-d H:i');

  if (4 > mb_strlen($asking, 'UTF-8') || 100 < mb_strlen($asking, 'UTF-8')) {
    $_SESSION['asking_f'] = "<div class='success'>Please fill your content in 4~50 words. !</div>";
    header("http://localhost:8001/client/form/Asking.php?client_id=$client_id&lesson_id=$lesson_id", 401);
    die();
  }
  if (!preg_match("/^[a-zA-Z-' ]*$/", $asking)) {
    $_SESSION['asking_f'] = "<div class='success'>Only English is valid.!</div>";
    header("Location:Location:http://localhost:8001/client/form/Asking.php?client_id=$client_id&lesson_id=$lesson_id", 401);
    die();
  }

  $sql2 = "
            INSERT INTO 
                tbl_form
              SET 
                asking     = '$asking',
                created_at = '$created_at',
                client_id  = '$client_id',
                lesson_id  = '$lesson_id'
          ";
  $rec2 = mysqli_query($connect,$sql2);

  if($rec2 == true)
  {
    $_SESSION['asking_s'] = "<div class='success'>Your form was reserved correctly!</div>";
    header("location: http://localhost:8001/client/ClientPage.php?client_id=$client_id");
    exit();
  } else
  {
    $_SESSION['asking_f'] = "<div class='error'>Failed to Register your form.</div>";
    header("Location:http://localhost:8001/client/form/Asking.php?client_id=$client_id&lesson_id=$lesson_id", 401);
    die();
  }
}
?>