<?php  include('partials/header.php'); ?>

<div class="main2">
    <div class="wrapper">
        <div class="inner">
            <h1>Update your Account</h1>
            <br/><br/>

            <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_account WHERE id=$id";
                $rec = mysqli_query($connect, $sql);

                if ($rec == true) {
                    $count = mysqli_num_rows($rec);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($rec);
                        $id = $row['id'];
                        $username = $row['username'];
                        $image_name = $row['image_name'];
                    } else {
                        header('Location:update-client.php');
                    }
                }
            }
            ?>

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td class="text-white">Username:</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                            if($image_name == "")
                            {
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="../images/profile/<?php echo $image_name; ?>" width="150px">
                                <?php
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td> Select New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update your Account" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['submit']))
{

    $id = $_POST['id'];
    $username = $_POST['username'];

    $sql = "UPDATE tbl_account SET username = '$username' WHERE id='$id' ";

    $rec= mysqli_query($connect, $sql);

    if($rec==true)
    {
        $_SESSION['update'] = "<div class='success'>Account Updated Successfully.</div>";
        header('Location:manage-client.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Account.</div>";
        header('Location:update-client.php');
    }
}
?>
<?php include ('partials/footer.php'); ?>
