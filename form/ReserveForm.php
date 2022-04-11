<?php include('../account/partials/HeaderInfo.blade.php');?>

<html>
  <head>
    <title>ReserveLessonForm</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <section class="food-search">
      <div class="container2">
        <h2 class="text-center">Fill this form to confirm.</h2><br/>
        <form action="ReserveForm.php?lesson_id=$lesson_id" method="POST" class="order" style="text-align: center">
          <fieldset class="fieldset">
          </fieldset>
        </form>
      </div>
    </section>
  </body>
</html>

<?php
  $host = 'localhost';
  $username = 'root';
  $pass = 'root';
  $dbname = 'overcome';

  if(isset($_POST['submit']))
    {
      $lesson_id = $_POST['lesson_id'];
      $name = $_POST['name'];
      $telephone = $_POST['telephone'];
      $tel_boolean="/^(([0-9]{3}-[0-9]{4})|([0-9]{7}))$/";
      if(preg_match($tel_boolean,$telephone))
        {
          print  'write down your phone number correctly !';
        }
      else
        {
          //
        }

        if(isset($_POST['email'])) {
          $email = $_POST['email'];
          $mysqli = mysqli_connect($host,$username,$pass,$dbname);
          $sql = ("SELECT * FROM tbl_form where email='$email'");
          $rec = mysqli_query($mysqli,$sql);
          $rec2 = mysqli_num_rows($rec);
          if ($rec2 >= 1) {
            echo  "<div class style='color: #ff6b81; text-align: center' >Email exist　Push the DashBoard button !</div>";
            die();
          }
    }
    $contents_mail='/¥A\w\-\.]+¥@[\w\-\.]+.([a-z]+)\z/';
    if(preg_match($contents_mail,$email))
      {
        print 'write down your email correctly ! ';
      }
    else
      {
            //
      }
    $sex = $_POST['sex'];

    $sql3 = "INSERT INTO tbl_form SET 
             name = '$name'
             ,telephone = '$telephone'
             ,email = '$email'
             ,sex = '$sex'
             ,lesson_id= '$lesson_id'";

    $rec3=mysqli_query($mysqli,$sql3);
    $url = "http://localhost:8001/account/Index.php";
    if($rec3 == true)
      {
        $_SESSION['form'] = "<div class='success text-center'>Form order Successfully.</div>";
        $form_id = mysqli_insert_id($mysqli);
        $url = "http://localhost:8001/form/ManageForm.php?lesson_id=$lesson_id&form_id=$form_id";
        header('Location:' .$url,true , 302);
      }
    else
      {
        $_SESSION['form'] = "<div class='success text-center'>Form order Failed.</div>";
        header('Location:' .$url,true , 401);
      }
    }
?>

<?php include('../account/partials/Footer.tpl'); ?>
