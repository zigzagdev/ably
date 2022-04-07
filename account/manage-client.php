<?php include('partials/header.blade.php'); ?>

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
        <a class="btn-primary" href="update-client.php?account_id=<?= $account_id=$_GET['account_id']?>"> Update your Account</a>
        <a class="btn-secondary" class="btn-secondary" onclick="return confirm('Are you sure you want to delete this item')"
           href="delete-client.blade.php?account_id=<?= $account_id=$_GET['account_id']?>">Delete your Account</a>
        <a href="update-password.php" class="btn-primary">Update your Password</a>
        <a class="btn-secondary" href="../lesson/manage-lesson.php?account_id=<?= $account_id=$_GET['account_id']?>">To Lesson Page</a>
        <br/><br/><br/>
        <table class="tbl-full">
          <tr>
            <th style="text-align: center">User Name</th>
            <th style="text-align: center">Image Photo</th>
            <th style="text-align: center">Email</th>
            <th style="text-align: center">Description</th>
          </tr>
          <?php
            $account_id = $_GET['account_id'];
            $sql = "SELECT * FROM tbl_account where account_id=$account_id";
            $rec = mysqli_query($connect, $sql);

            if($rec==TRUE)
              {
                $count = mysqli_num_rows($rec); // Function to get all the rows in database
                  if($count>0)
                    {
                      while($rows=mysqli_fetch_assoc($rec))
                        {
                          $account_id = $rows['account_id'];
                          $username = $rows['username'];
                          $password = $rows['password'];
                          $image_name = $rows['image_name'];
                          $email = $rows['email'];
                          $content = $rows['content'];
                          ?>
              <tr>
                <td style="text-align: center"><?php echo $username; ?></td>
                <td style="text-align: center">
                  <?php
                    if($image_name=="")
                      {
                        echo "<div class='error'>Image not Added.</div>";
                      } else
                      {
                  ?>
                  <img src="../images/profile/<?php echo $image_name; ?>" width="100px">
                  <?php
                      }
                  ?>
                </td>
                <td style="text-align: center"><?php echo $email; ?></td>
                <td style="text-align: center"><?php echo $content; ?></td>
                <td style="text-align: center"></td>
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

<?php include('partials/footer.tpl') ?>