<?php
include "./partials/HeaderEd.blade.php";

  if(isset($_SESSION['cli_add']))
  {
    echo  $_SESSION['cli_add'];
    unset($_SESSION['cli_add']);
  }
  if(isset($_SESSION['name_s']))
  {
    echo  $_SESSION['name_s'];
    unset($_SESSION['name_s']);
  }
  if(isset($_SESSION['form_s']))
  {
    echo  $_SESSION['form_s'];
    unset($_SESSION['form_s']);
  }

  if(isset($_SESSION['s_login']))
  {
    echo  $_SESSION['s_login'];
    unset($_SESSION['s_login']);
  }
  if(isset($_SESSION['order_tel']))
  {
    echo  $_SESSION['order_tel'];
    unset($_SESSION['order_tel']);
  }

  if(isset($_SESSION['change_pwd_c']))
  {
    echo  $_SESSION['change_pwd_c'];
    unset($_SESSION['change_pwd_c']);
  }

  if(isset($_SESSION['order']))
  {
    echo  $_SESSION['order'];
    unset($_SESSION['order']);
  }

  if(isset($_SESSION['name_error']))
  {
    echo $_SESSION['name_error'];
    unset($_SESSION['name_error']);
  }

  $client_id = $_GET['client_id'];

  $sql = "SELECT * FROM tbl_client where client_id=$client_id";
  $rec = mysqli_query($connect, $sql);

  if($rec==TRUE)
  {
    $count = mysqli_num_rows($rec);
    if($count>0)
    {
      while ($rows = mysqli_fetch_assoc($rec))
      {
        $name        = $rows['name'];
        $image       = $rows['image'];
        $email       = $rows['email'];
        $phone       = $rows['telephone'];

        if ($image == "")
        {
          echo "<div class='success'>Image not Added.</div>";
        }
      }
    }
  }
//  form一覧
  $form_sql = "SELECT 
                   asking, deadline, tbl_form.created_at, course, user_name, image_name 
                 FROM 
                   tbl_form 
               LEFT JOIN 
                   tbl_lesson 
                 ON 
                   tbl_form.lesson_id = tbl_lesson.lesson_id 
               LEFT JOIN
                   tbl_account
                 ON
                   tbl_lesson.account_id= tbl_account.account_id
               WHERE 
                   tbl_lesson.deadline > tbl_form.created_at
          ";
  $form_rec = mysqli_query($connect, $form_sql);

  if($form_rec==TRUE)
  {
    $form_count = mysqli_num_rows($form_rec);
    if($form_count>0)
    {
      while ($form_rows = mysqli_fetch_assoc($form_rec))
      {
        $asking     = $form_rows['asking'];
        $deadline   = $form_rows['deadline'];
        $course     = $form_rows['course'];
        $user_name  = $form_rows['user_name'];
        $image_name = $form_rows['image_name'];
      }
    }
  }
?>
<html>
  <head>
    <title>ManageAccount</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <div style="margin: 0 140px">
      <div class="mainaccount" style="background-color: lightgray">
        <li style="list-style: none;  margin:47px 10px 7px 30px; padding-top: 20px">
          <a href="./UpdateImage.blade.php?client_id=<?=$client_id=$_GET['client_id']?>" style="text-decoration: none;">
            <img src="../images/profile/<?php echo $image; ?>" width="90px" height="90px" class="c_img">
            <p style="margin-left: 30px; line-height: 1px">Edit</p>
          </a>
        </li>
        <li style="list-style: none;  margin:37px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            UserName
          </b>
          <b style="font-size: 20px" onclick="clickname()"><?php echo $name ?></b>
          <a href="./UpdateName.php?client_id=<?=$client_id=$_GET['client_id']?>" style="text-decoration: none">
            <b style="float: right; margin-right: 40px">
              <img src="../images/pencil.png" style="width: 40px; height: 30px">
            </b>
          </a>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            Email
          </b>
          <b style="font-size: 20px"><?php echo $email ?></b>
          <a href="./UpdateEmail.blade.php?client_id=<?=$client_id=$_GET['client_id']?>" style="text-decoration: none">
            <b style="float: right; margin-right: 40px;">
              <img src="../images/pencil.png" class="pencil">
            </b>
          </a>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
        <li style="list-style: none;  margin:17px 0 17px 30px">
          <b style="font-size: 20px;width:100px;margin-right:200px; float: left;">
            PhoneNumber
          </b>
          <b style="font-size: 20px"><?php echo $phone ?></b>
          <a href="./UpdatePhoneNumber.blade.php?client_id=<?=$client_id=$_GET['client_id']?>" style="text-decoration: none">
            <b style="float: right; margin-right: 40px;">
              <img src="../images/pencil.png" class="pencil">
            </b>
          </a>
        </li>
        <hr color="#a9a9a9" width="100%" size="1" style="text-align: center;">
      </div>
      <div class="cardoutline">
        <span style="padding-top: 20px;" class="search_box">
          <strong style="color: darkblue;">-Your Reserved form(s)-</strong>
          <form class="reserveform" method="get" action="../client/form/ReserveForm.php">
            <strong style="color: #2f3542">Find a Tutor</strong><br>
            <input type="hidden" name="client_id" value="<?php echo $client_id ?>"/>
            <input style=" margin-left: 60px; width: 175px;height: 30px" placeholder="  Name,Course" name="keyword"/>
          </form>
        </span>
        <br><br>
<?php foreach($form_rec as $key ){?>
        <div class="cardoutline2" style="display: inline-block; float: left; margin: 50px 10px 20px 10px">
          <div style="padding: 15px 0 0 30px; text-align: left">
            <strong style="color: darkblue">Teacher</strong>
            <span class="flex">
              <p style="padding-left: 10px; margin-right: 70px;font-family: 'Apple LiSung'; font-size: 25px"><?php echo $key['user_name'] ?></p>
              <img src="../images/profile/<?php echo $key['image_name']; ?>" style="width: 60px; height: 60px; border-radius: 50px">
            </span>
          </div>
          <div style="padding: 6px 0 0 30px; text-align: left">
            <strong style="color: darkblue">Course Name</strong>
            <p style="padding-left: 10px; font-family: 'Apple LiSung'; font-size: 18px"><?php echo $key['course']?></p>
          </div>
        </div>
<?php } ?>
      </div>
    </div>
  </body>
</html>



<?php include "./partials/FooterEd.tpl" ?>
