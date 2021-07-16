<?php  include('../account/partials/header.php'); ?>

<?php
if(isset($_GET['form_id'])) {

    $form_id = $_GET['form_id'];
    $sql2 = "SELECT * FROM tbl_form  where form_id= $form_id";
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

        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>

<section class="food-search">
    <div class="container2"><br/>
        <a class="btn-secondary" href="../form/update-form.php?form_id=<?= $form_id=$_GET['form_id']?>">To your Pearsonal Page</a>
        <h2 class="text-center">Update your information.</h2><br/>
        <form action="update-form.php?form_id=$form_id" method="POST" class="order" style="text-align: center" >
            <fieldset class="fieldset">
                <legend class="legend-center">Your information</legend>
                <div class="order-label text-white" >Full Name</div>
                <input type="text"  name="name" placeholder="Test" class="input-responsive" required><br/>
                <div class="order-label text-white">Phone Number</div>
                <input type="tel" name="telephone" placeholder="090-1234-1234" class="input-responsive" required><br/>
                <div class="order-label ">Email</div>
                <input type="email" name="email" placeholder="1234aa@test.com" class="input-responsive" required><br/>
                <div class="order-label ">Sex</div>
                <select name= "sex">
                    <option value = "male">Male</option>
                    <option value = "female">Female</option>
                </select><br/>
            </fieldset>
            <input type="hidden" name="lesson_id" value="<?php echo filter_input(INPUT_GET, 'lesson_id');?>">
            <input type="submit" name="submit" value="送信" class="btn btn-third">
        </form>
    </div>
</section>

<?php

$form_id = $_GET['form_id'];
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

    $sql3 = "INSERT INTO tbl_form SET name = '$name',telephone = '$telephone',
           email = '$email',sex = '$sex',lesson_id= '$lesson_id'" ;

    $rec3=mysqli_query($connect,$sql3);
    if($rec3 == true)
    {
        $_SESSION['order'] = "<div class='success text-center'>Form order Successfully.</div>";
        $url = "http://localhost:8001/account/index.php";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['order'] = "<div class='success text-center'>Form order Failed.</div>";
        $url = "http://localhost:8001/account/index.php";
        header('Location:' .$url,true , 401);
    }
}
?>
<?php include ('../account/partials/footer.php'); ?>
