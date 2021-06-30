<?php include('partials/header.php'); ?>

<!--Main Section -->
<div class="main">
    <div class="wrapper">
        <h1 style="padding: 20px 0 0 50px">This is your account</h1>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br/><br/>

        <div class="col-4 text-center">
            <?php
            $sql="SELECT * FROM tbl_account";
            $rec=mysqli_query($connect,$sql);
            $count=mysqli_num_rows($rec);
            ?>
            <h1><?php echo $count; ?></h1>
            <br/>
            Participations
        </div>

        <div class="clearfix"></div>
    </div>

    <?php include('partials/footer.php');  ?>
