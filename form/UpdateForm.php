<?php  include('../account/partials/HeaderInfo.blade.php'); ?>

<?php
if(isset($_GET['form_id'])) {

    $form_id = $_GET['form_id'];
    $sql2 = "SELECT * FROM tbl_form  where form_id = $form_id";
    $rec2 = mysqli_query($connect, $sql2);

    if ($rec2 == true) {
        $count = mysqli_num_rows($rec2);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($rec2);
            $form_id = $row['form_id'];
            $name = $row['name'];
            $telephone = $row['telephone'];
            $email = $row['email'];
            $sex = $row['sex'];
            $lesson_id = $row['lesson_id'];

        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}

?>

<html>
  <head>
    <title>UpdateLessonForm</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <section class="food-search">
      <div class="container2">
        <h2 style="text-align: center">Fill this form to confirm.</h2>
        <form action="ReserveForm.php?lesson_id=$lesson_id" method="POST" class="order" style="text-align: center">
          <fieldset class="fieldset">
          </fieldset>
          <input type="hidden" name="lesson_id" value="<?php echo $lesson_id; ?>">
          <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
          <input type="submit" name="submit" value="送信" class="btn btn-third">
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

    $email = $_POST['email'];
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
    $lesson_id = $_POST['lesson_id'];
    $form_id = $_POST['form_id'];     // Post means repost your correct variable again.

    $sql3 = "UPDATE tbl_form SET name = '$name',telephone = '$telephone',
           email = '$email',sex = '$sex'where form_id= '$form_id' " ;

    $rec3=mysqli_query($connect,$sql3);
    if($rec3 == true)
    {
        $_SESSION['order'] = "<div class='success text-center'>Form order Updated.</div>";
        $url = "http://localhost:8001/form/ManageForm.php?lesson_id=$lesson_id&form_id=$form_id";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['order'] = "<div class='success text-center'>Form Update Failed.</div>";
        $url = "http://localhost:8001/form/UpdateForm.php?lesson_id=$lesson_id&form_id=$form_id";
        header('Location:' .$url,true , 401);
    }
}
?>
<?php include('../account/partials/Footer.tpl'); ?>
