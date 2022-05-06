<?php
include('../partials/FormHeader.blade.php');

  if (isset($_SESSION['form_f']))
  {
    echo $_SESSION['form_f'];
    unset($_SESSION['form_f']);
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
            <input type="text" name="name" placeholder="Michel Smith" style="width: 240px; height: 30px">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
              Email
            </b>
            <input type="email" name="email" placeholder="abc@com" class="input-responsive"  required style="height: 30px; width: 240px">
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
              PhoneNumber
            </b>
            <input type="tel" name="telephone"  placeholder="090-1234-1234" class="input-responsive" required>
          </li>
          <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
          <li style="list-style: none;  margin:17px 0 17px 30px">
            <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
              Sex
            </b>
            <select name= "sex">
              <option value = "male">Male</option>
              <option value = "female">Female</option>
              <option value = "others">Others</option>
            </select>
            (can't change whatever reasons.)
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
  $host     = 'localhost';
  $username = 'root';
  $pass     = 'root';
  $dbname   = 'overcome';
  $client_id = $_GET['client_id'];

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
?>

<?php include('../account/partials/ClientFooter.tpl'); ?>
