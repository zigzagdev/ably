<?php include ('../account/partials/header_info.php'); ?>

<section class="food-search">
    <div class="container2">
        <h2 class="text-center">Fill this form to confirm your order.</h2><br/><br/>
        <form action="" method="POST" class="order" style="text-align: center" >
            <fieldset class="fieldset">
                <legend class="legend-center">Delivery Details</legend>
                <div class="order-label text-white" >Full Name</div>
                <input type="text"  name="full-name" placeholder="Test Test" class="input-responsive" required>
                <div class="order-label text-white">Phone Number</div>
                <input type="tel" name="contact" placeholder="090-1234-1234" class="input-responsive" required>
                <div class="order-label ">Email</div>
                <input type="email" name="email" placeholder="1234aa@test.com" class="input-responsive" required>
                <div class="order-label text-white">Sex</div>
                <select name="sex" class="input-responsive" required>
                    <option value="">Choose here.</option>
                    <option value="選択肢1">Male</option>
                    <option value="選択肢2">Female</option>
                </select></fieldset><br/>
            <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
</section>

<?php

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $email2 = '/¥A\w\-\.]+¥@[\w\-\.]+.([a-z]+)\z/';
    if(preg_match($email,$email2))
    {
        print 'write down your email correctly ! ';
    }
    else
    {
        //
    }
    $sex = $_POST['sex'];


    $sql3 = "INSERT INTO tbl_form SET name = '$name',telephone = '$telephone',email = '$email',sex = '$sex' ";

    $rec3=mysqli_query($connect,$sql3) or die(mysqli_error($connect));

    if($rec3 == true)
    {
        $_SESSION['order'] = "<div class='success text-center'>Form order Successfully.</div>";
        $url = "http://localhost:8001/account/index.php";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['order'] = "<div class='error text-center'>Failed to Post a form.</div>";
        $url = "http://localhost:8001/form/reserve-form.php";
        header('Location:' .$url,true , 401);
    }
}
?>



?>
<?php include('../account/partials/footer.php'); ?>
