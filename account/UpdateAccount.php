<?php  include('partials/Header.blade.php'); ?>

<?php
  if(isset($_GET['account_id']))
  {
    $account_id = $_GET['account_id'];
    $sql = "SELECT * FROM tbl_account WHERE account_id=$account_id";
    $rec = mysqli_query($connect, $sql);

    if ($rec == true)
    {
      $count = mysqli_num_rows($rec);
      if ($count == 1)
      {
        $row = mysqli_fetch_assoc($rec);
        $account_id = $row['account_id'];
        $username = $row['username'];
        $current_image = $row['image_name'];
        $image = $row['image_name'];
        $email = $row['email'];
        $content = $row['content'];
      } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
?>
<html>
  <head>
    <title>UpdatePage</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div class="main">
      <div>
        <div>
          <h1>Update your Account</h1>
          <form action="" method="post" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td class="text-white">Username:</td>
                            <td>
                                <input type="text" name="username" value="<?php echo $username; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td >Current Image: </td>
                            <td>
                                <?php
                                if($image == "")
                                {
                                    echo "<div class='error'>Image not Available.</div>";

                                }
                                else
                                {
                                    ?>
                                    <img src="../images/profile/<?php echo $image; ?>" width="150px">
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
                            <td style="text-align: center">Email: </td>
                            <td>
                                <input name="email" name="name" value="<?php echo $email; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center">Content: </td>
                            <td>
                                <textarea name="content" cols="30" rows="6" ><?php echo $content; ?></textarea>
                            </td>
                        </tr>


                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
                                <input type="submit" name="submit" value="Update your Account" class="btn-secondary">
                            </td>
                        </tr>

                    </table>
                </form>
            </div>
        </div>
    </div>
  </body>
<?php
if(isset($_POST['submit']))
{

    $account_id = $_POST['account_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $content = $_POST['content'];

    if(isset($_FILES['image']['name']))
    {
        $image = $_FILES['image']['name'];

        if($image != "")
        {

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/profile/".$image;
            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                $url = "http://localhost:8001/account/UpdateAccount.php?account_id=$row[account_id]";
                header('Location:'.$url,true , 401);
                die();
            }
            if($current_image!="")
            {
                $remove_path = "../images/profile/".$current_image;
                $remove = unlink($remove_path);
                if($remove==false)
                {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                    $url = "http://localhost:8001/account/UpdateAccount.php?account_id=$account_id";
                    header('Location:' .$url,true , 401);
                    die();
                }
            }
        }
        else
        {
            $image = $current_image;
        }
    }
    else
    {
        $image = $current_image;
    }
    $sql = "UPDATE tbl_account SET username='$username',image_name='$image',email='$email',
             content='$content' WHERE account_id=$account_id ";
    $rec = mysqli_query($connect, $sql);

    if($rec==true)
    {
        $url = "http://localhost:8001/account/ManageAccount.php?account_id=$account_id";
        $_SESSION['update'] = "<div class='success'>Account Updated Successfully.</div>";
        header('Location:' .$url,true , 302);
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Account.</div>";
        $url = "http://localhost:8001/account/UpdateAccount.php?account_id=$account_id";
        header('Location:' .$url,true , 401);
        die();
    }
}
?>
<?php include('partials/Footer.tpl'); ?>