<?php include('../account/partials/HeaderInfo.blade.php'); ?>

    <div class="main">
        <div class="wrapper">
            <div class="inner">
                <h1>Manage Your  reserve information</h1>
                <br/>
                <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['form-not-found']))
                {
                    echo $_SESSION['form-not-found'];
                    unset($_SESSION['form-not-found']);
                }

                if(isset($_SESSION['change-form']))
                {
                    echo $_SESSION['change-form'];
                    unset($_SESSION['change-form']);
                }
                ?>
                <br/><br/><br/>
                <table class="tbl-full">
                    <tr>
                        <th style="text-align: center" >Name</th>
                        <th style="text-align: center">Phone Number</th>
                        <th style="text-align: center">Email Address</th>
                        <th style="text-align: center">Sex</th>
                        <th style="text-align: center">Maintenance</th>
                    </tr>

                    <?php
                    $form_id = $_GET['form_id'];
                    $lesson_id = $_GET['lesson_id'];

                    $sql2 = "SELECT * FROM tbl_form where form_id ='$form_id'";

                    $rec2 = mysqli_query($connect, $sql2);

                    if($rec2 == TRUE)
                    {
                        $count = mysqli_num_rows($rec2); // Function to get all the rows in database

                        $on=1;


                        if($count>0)
                        {
                            while($rows=mysqli_fetch_array($rec2))
                            {
                                $name = $rows['name'];
                                $phone = $rows['telephone'];
                                $address = $rows['email'];
                                $sex = $rows['sex'];
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $name; ?></td>
                                    <td style="text-align: center"><?php echo $phone; ?></td>
                                    <td style="text-align: center"><?php echo $address; ?></td>
                                    <td style="text-align: center"><?php echo $sex; ?></td>
                                    <td style="text-align: center">
                                        <a class="btn-primary" href="UpdateForm.php?lesson_id=<?= $lesson_id=$_GET['lesson_id']?>&form_id=<?= $form_id=$_GET['form_id']?>"> Update your Information</a>
                                        <a class="btn-secondary"  class="btn-secondary" onclick="return confirm('Are you sure you want to delete this item')"
                                           href="DeleteForm.php?lesson_id=<?= $lesson_id=$_GET['lesson_id']?>&form_id=<?= $form_id=$_GET['form_id']?>"> Delete your Information</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!--Main Section -->

<?php include('../account/partials/Footer.tpl') ?>