<?php
//
include('../config/constants.php'); ?>

    <div class="main">
        <div class="wrapper">
            <h1 class>Add your account</h1>
            <br/><br/>
            <?php
            if(isset($_SESSION['add']))
            {
                echo  $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data" >
                <table class="tbl-30">
                    <tr>
                        <td>UserName:</td>
                        <td>
                            <input type="text" name="user_name" placeholder="  Enter your username">
                        </td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="  Enter your password">
                        </td>
                    </tr>

                    <tr>
                        <td>Password Again:</td>
                        <td>
                            <input type="password" name="password2" placeholder="      Password again">
                        </td>
                    </tr>

                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="email" name="email" placeholder="      Enter your email">
                        </td>
                    </tr>

                    <tr>
                        <td>Post a Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Content:</td>
                        <td>
                            <textarea name="content" cols="30" rows="5" placeholder="Describe yourself"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add an account" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php
//Process the value from Form and Save it in Database
// Check whether the button is clicked or not
if(isset($_POST['submit']))
{
    $user_name = $_POST['user_name'];
    $password  = md5($_POST['password']);
    $password2 = md5($_POST['password2']);
    $email = $_POST['email'];
    $content = $_POST['content'];

    if(isset($_FILES['image']['name']))
    {
        $image_name = $_FILES['image']['name'];

        if($image_name != " ")
        {
            $src = $_FILES['image']['tmp_name'];
            $dst ="../images/profile".$image_name;
            $upload = move_uploaded_file($src, $dst);
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                header('location:/account/add-client.php');
                die();
            }
        }
    }
    else
    {
        $image_name= "";
    }
    if (empty($user_name) || empty($password) || empty($password2) || empty($email) ){
        die('Please fill all required fields!');
    }

    if ($password !== $password) {
        die('Password and Confirm password should match!');
    }

    $sql= "INSERT INTO tbl_account SET username='$user_name',password ='$password', password2 = '$password2',
image_name = '$image_name',email = '$email',content = '$content'";

    $rec = mysqli_query($connect,$sql) ;

    if($rec == TRUE) {
        $_SESSION['add'] = "<div class='success'>Your account Added Successfully.</div>";
        $account_id = mysqli_insert_id($connect);
        header("location: http://localhost:8001/account/manage-client.php?account_id=$account_id");
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to add your account.</div>";
        header("location: http://localhost:8001/account/login.php");//ページへのリダイレクトをif~else文にて行っている。
    }
}

?>

