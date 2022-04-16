<?php
include('../account/partials/HeaderInfo.blade.php');

  if(isset($_GET['form_id']))
  {
    $form_id = $_GET['form_id'];
    $sql2 = "SELECT * FROM tbl_form  where form_id = $form_id";
    $rec2 = mysqli_query($connect, $sql2);
    if ($rec2 == true) {
      $count = mysqli_num_rows($rec2);
      if ($count == 1) {
        $row       = mysqli_fetch_assoc($rec2);
        $telephone = $row['telephone'];
        $name      = $row['name'];
        $email     = $row['email'];
        $sex       = $row['sex'];
        $lesson_id = $row['lesson_id'];
      } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
?>

<html>
  <head>
    <title>UpdatePhoneNumberForm</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <section class="food-search">
      <div class="container2">
        <h2 style="text-align: center">ChangePhoneNumber</h2>
        <form action="" method="POST" class="order" style="text-align: center">
          <fieldset class="mainaccount" style="margin: 0 310px">
            <legend>Change YourName</legend>
            <p style="font-size: 20px; margin-bottom: 30px">You can change your phone name at below.</p>
            <li style="list-style: none;  margin:17px 0 17px 140px">
              <b style="font-size: 20px;width:80px;margin-right:50px; float: left;">
                YourName
              </b>
              <input type="text" name="name"  placeholder="Steave Smith" class="input-responsive" required>
            </li>
          </fieldset>
          <input type="hidden" name="lesson_id" value="<?php echo $lesson_id; ?>">
          <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
          <input type="submit" name="submit" value="送信" class="btn btn-third" style="margin-top: 40px">
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
    $name = $_POST['name'];
    $name_boolean = "/^[a-zA-Z-' ]*$/";
    if(preg_match($name_boolean,$name))
    {
      print  'write down your name correctly(Only can use Alphabet.) !';
    }
    $lesson_id = $_POST['lesson_id'];
    $form_id = $_POST['form_id'];     // Post means repost your correct variable again.

    $sql3 = "UPDATE tbl_form SET
             name = '$name'
             ,telephone = '$telephone'
             ,email = '$email'
             ,sex = '$sex'
             WHERE form_id= '$form_id'";
    $rec3=mysqli_query($connect,$sql3);
    if($rec3 == true)
    {
      $_SESSION['order'] = "<div class='success text-center'>Name was Updated.</div>";
      $url = "http://localhost:8001/form/ManageForm.php?form_id=$form_id";
      header('Location:' .$url,true , 302);
    }
    else
    {
      $_SESSION['order'] = "<div class='success text-center'>Form Update Failed.</div>";
      $url = "http://localhost:8001/form/UpdateNameForm.blade.php?form_id=$form_id";
      header('Location:' .$url,true , 401);
    }
  }
include('../account/partials/ClientFooter.tpl');
?>
