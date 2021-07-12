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
                    <option value="選択肢2">Male</option>
                    <option value="選択肢3">Female</option>
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


    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = '$price',
                        quantity = '$quantity',
                        total = '$total',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

    $rec2=mysqli_query($connect,$sql2) or die(mysqli_error($connect));

    if($rec2==true)
    {
        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
        header('location:'.SITEURL.'/index.php');
    }
    else
    {
        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
        header('location:'.SITEURL.'/index.php');
    }
}
?>



?>
<?php include('../account/partials/footer.php'); ?>
