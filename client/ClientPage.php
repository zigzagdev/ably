<?php
include "./partials/HeaderEd.tpl";
include "../config/Constants.blade.php";

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
if(isset($_SESSION['asking_s']))
{
  echo $_SESSION['asking_s'];
  unset($_SESSION['asking_s']);
}
if(isset($_SESSION['asking_up_suc']))
{
  echo $_SESSION['asking_up_suc'];
  unset($_SESSION['asking_up_suc']);
}

if(isset($_SESSION['asking_up_f']))
{
  echo  $_SESSION['asking_up_f'];
  unset($_SESSION['asking_up_f']);
}
if(isset($_SESSION['d_s_form']))
{
  echo  $_SESSION['d_s_form'];
  unset($_SESSION['d_s_form']);
}

$client_id = $_GET['client_id'];

$sql = "SELECT * FROM tbl_client WHERE client_id=$client_id";
$rec = mysqli_query($connect, $sql);

if($rec == TRUE)
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
$form_sql = "  SELECT 
                   asking, deadline, tbl_form.created_at, course, user_name, image_name, form_id 
                 FROM 
                   tbl_form 
               LEFT JOIN 
                   tbl_lesson 
                 ON 
                   tbl_form.lesson_id = tbl_lesson.lesson_id 
               LEFT JOIN
                   tbl_account
                 ON
                   tbl_lesson.account_id = tbl_account.account_id
               WHERE 
                   tbl_lesson.deadline > CURDATE()
                 AND 
                   tbl_form.client_id = '$client_id'
          ";
$form_rec = mysqli_query($connect, $form_sql);

if($form_rec == TRUE)
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
      $form_id    = $form_rows['form_id'];
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
    <div style="margin: 140px;">
      <div class="mainaccount" style="height: 60%; background: linear-gradient(180deg, whitesmoke 0%, floralwhite 60%, seashell 40%, snow 100%);">
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
          <form class="reserveform" method="get" action="./form/ReserveForm.php">
            <strong style="color: #2f3542; margin-left:13px;">Find Something</strong><br>
            <input type="hidden" name="client_id" value="<?php echo $client_id ?>"/>
            <input style=" margin-left: 60px; width: 175px;height: 30px" placeholder="  Name,Course" name="keyword"/>
          </form>
        </span>
        <br><br>
<?php foreach($form_rec as $key ){?>
        <a href="../client/form/UpAsking.php?client_id=<?php echo $client_id?>&form_id=<?php echo $key['form_id'] ?>"
           style="text-decoration: none">
          <div class="cardoutline2" style="display: inline-block; float: left; margin: 50px 10px 10px 10px">
            <div style="padding: 15px 0 0 30px; text-align: left">
              <strong style="color: darkblue">Tutor</strong>
              <span class="flex">
                <p style="padding-left: 10px; margin-right: 70px;font-family: 'Apple LiSung'; font-size: 25px; color: black"><?php echo $key['user_name'] ?></p>
                 <img src="../images/profile/<?php echo $key['image_name']; ?>" style="width: 60px; height: 60px; border-radius: 50px">
              </span>
            </div>
            <div style="padding: 6px 0 0 30px; text-align: left">
              <strong style="color: darkblue">Course Name</strong>
              <p style="padding-left: 10px; font-family: 'Apple LiSung'; font-size: 18px; color: black"><?php echo $key['course']?></p>
            </div>
            <div style="padding: 6px 0 0 30px; text-align: left">
              <strong style="color: darkblue">Lesson Day</strong>
              <p style="padding-left: 10px; font-family: 'Apple LiSung'; font-size: 18px; color: black"><?php echo $key['deadline']?></p>
            </div>
          </div>
        </a>
<?php } ?>
      </div>
    </div>
  </body>
</html>
<?php include "./partials/FooterEd.tpl" ?>
