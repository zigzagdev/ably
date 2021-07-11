<?php include ('../account/partials/header_info.php'); ?>

<?php
if(isset($_GET['lesson_id']))
{
    $lesson_id = $_GET['lesson_id'];
    $sql2 = "SELECT * FROM tbl_lesson where id=$lesson_id";
    $rec2 = mysqli_query($connect, $sql2);
    $count = mysqli_num_rows($rec2);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($rec2);   //Get the Data from Database
    } else {
        $url = "http://localhost:8001/account/index.php";
        header('Location:' . $url, true, 401);
        die();
    }
}
else {
    $url = "http://localhost:8001/account/index.php";
    header('Location:' . $url, true, 401);
    die();
}
?>

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
                <div class="order-label text-white">Address</div>
                <textarea name="address" rows="5 " class="input-responsive" required></textarea></fieldset><br/>
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
</section>
<?php include('../account/partials/footer.php'); ?>
