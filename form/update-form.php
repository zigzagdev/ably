<?php  include('../account/partials/header_info.php'); ?>

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
var_dump($row);
?>

<section class="food-search">
    <div class="container2"><br/>
        <h2 class="text-center">Update your information.</h2><br/>
        <form action="update-form.php?lesson_id=$lesson_id&form_id=$form_id" method="POST" class="order" style="text-align: center" >
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
<!--            <input type="hidden" name="lesson_id" value="--><?php //echo $lesson_id; ?><!--">-->
<!--            <input type="hidden" name="form_id" value="--><?php //echo $form_id; ?><!--">-->
            <input type="submit" name="submit" value="送信" class="btn btn-third">
        </form>
    </div>
</section>


<?php
$lesson_id = $_POST['lesson_id'];
$form_id = $_POST['form_id'];
var_dump($lesson_id);
var_dump($form_id);
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

    $sql3 = "UPDATE tbl_form SET name = '$name',telephone = '$telephone',
           email = '$email',sex = '$sex' lesson_id = '$lesson_id' where form_id= '$form_id' " ;

    $rec3=mysqli_query($connect,$sql3);
    if($rec3 == true)
    {
        $_SESSION['order'] = "<div class='success text-center'>Form order Updated.</div>";
        $url = "http://localhost:8001/form/manage-php?lesson_id=$lesson_id&form_id=$form_id";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['order'] = "<div class='success text-center'>Form Update Failed.</div>";
        $url = "http://localhost:8001/form/update-form?lesson_id=$lesson_id&form_id=$form_id";
        header('Location:' .$url,true , 401);
    }
}
?>
<?php include ('../account/partials/footer.php'); ?>
