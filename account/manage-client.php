<?php include('partials/header.php'); ?>

    <!--Main Section -->
    <div class="main">
        <div class="wrapper">
            <div class="inner">
                <h1>Manage Your Account</h1>
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
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }

                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
                ?>
                <br/><br/>
                <!---button--->
                <a class="btn-primary" href="update-client.php?id=<?= $id=$_GET['id']?>"> Update your Account</a>
                <a class="btn-secondary" href="delete-client.php?id=<?= $id=$_GET['id']?>">Delete your Account</a>
                <a href="update-password.php" class="btn-primary">Update your Password</a>
                <a class="btn-secondary" href="../lesson/manage-lesson.php?id=<?= $id=$_GET['id']?>">To Lesson Page</a>

                <br/><br/><br/>
                <table class="tbl-full">
                    <tr>
                        <th>User Name</th>
                        <th>Image Photo</th>
                        <th>Email</th>
                        <th>Description</th>
                    </tr>

                    <?php
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM tbl_account where id=$id";

                    $rec = mysqli_query($connect, $sql);

                    if($rec==TRUE)
                    {
                        $count = mysqli_num_rows($rec); // Function to get all the rows in database

                        $on=1;

                        if($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($rec))
                            {
                                $id = $rows['id'];
                                $username = $rows['username'];
                                $password = $rows['password'];
                                $image_name = $rows['image_name'];
                                $email = $rows['email'];
                                $content = $rows['content'];
                                ?>
                                <tr>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <?php
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not Added.</div>";
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="../images/profile/<?php echo $image_name; ?>" width="100px">
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $content; ?></td>
                                    <td></td>
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

<?php include('partials/footer.php') ?>