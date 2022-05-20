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


  if(isset($_POST['submit']))
  {
    $asking = $_POST['asking'];
    if (8 > mb_strlen($asking, 'UTF-8')|| 200 <  mb_strlen($asking, 'UTF-8'))
    {
      $_SESSION['asking_f'] = "<div class='success'>Please fill your asking comment in 8~200 words !</div>";
    }

    //  preg_match
    if (!preg_match("/^[a-zA-Z-' ]*$/", $asking)) {
      $_SESSION['asking_f'] = "<div class='success'>Only English is valid.!</div>";
      header("Location: http:/localhost:8001/client/form/Asking.php?client_id=$client_id");
    }
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
        <li style="list-style: none">
          <b style="font-size: 20px;width:100px; margin-left: 50px">Write something here..</b>
        </li>
        <textarea id="description" type="text" name="content" cols="100" rows="4" style="margin:15px 0 0 50px" required></textarea>
      </form>
    </div>
  </body>
</html>

<?php include('../partials/FooterEd.tpl'); ?>