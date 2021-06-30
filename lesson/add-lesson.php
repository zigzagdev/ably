<?php include ('../account/partials/header.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Add Your lesson.</h1>
        <br/><br/>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Lesson Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="      write lesson title">
                    </td>
                </tr>

                <tr>
                    <td>Course:</td>
                    <td>
                        <textarea name="course" cols="30" rows="5" placeholder="Describe its course."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Content:</td>
                    <td>
                        <textarea name="content" cols="30" rows="5" placeholder="Describe its lesson."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Lesson Day:</td>
                    <td>
                        <input type="date" name="date">
                        <input type="time" name="time">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Lesson" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }

            else
            {
                $featured = "No";
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                if($image_name!="")
                {
                    $src = $_FILES['image']['tmp_name'];
                    $dst ="../images/food".$image_name;
                    $upload = move_uploaded_file($src, $dst);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:/order/add-food.php');
                        die();
                    }
                }
            }
            else
            {
                $image_name= "";
            }
            $sql2 = "INSERT INTO tbl_food SET title = '$title',description = '$description',price = $price,image_name = '$image_name',
             category_id = $category,featured = '$featured',active = '$active'";
            $rec2=mysqli_query($connect,$sql2);
            if($rec2==true)
            {
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:/order/manage-food.php');
                exit();
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Error in Food Add .</div>";
                header('location:/order/manage-food.php');
                exit();
            }
        }
        ?>
    </div>
</div>

<?php include ('../account/partials/footer.php') ?>
