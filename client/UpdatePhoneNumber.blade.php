<?php
include('./partials/HeaderEd.tpl');
include "../config/Constants.blade.php";

  if(isset($_SESSION['order_f_p']))
  {
    echo  $_SESSION['order_f_p'];
    unset($_SESSION['order_f_p']);
  }

  if(isset($_GET['client_id']))
  {
    $client_id = $_GET['client_id'];
    $sql2 = "SELECT telephone FROM tbl_client  WHERE client_id = $client_id";
    $rec2 = mysqli_query($connect, $sql2);
    if ($rec2 == true)
    {
      $count = mysqli_num_rows($rec2);
      if ($count == 1)
      {
        $row       = mysqli_fetch_assoc($rec2);
        $telephone = $row['telephone'];
      } else
      {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
?>

<html>
  <head>
    <title>UpdatePhoneNumberForm</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body style="background: linear-gradient(90deg, ghostwhite 30%, lightcyan 40%, lightblue 60%); ">
    <section class="food-search">
      <div class="container2">
        <h2 style="text-align: center">ChangePhoneNumber</h2>
        <form action="" method="POST" class="order" style="text-align: center">
          <fieldset class="mainaccount" style="margin: 0 310px">
            <legend>Change PhoneNumber</legend>
            <p style="font-size: 20px; margin-bottom: 30px">You can change your phone number at below.</p>
            <li style="list-style: none;  margin:17px 0 17px 140px">
              <b style="font-size: 20px;width:80px;margin-right:80px; float: left;">
                PhoneNumber
              </b>
              <input type="tel" name="telephone"  placeholder="090-1234-1234" class="input-responsive" required>
            </li>
          </fieldset>
          <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
          <input type="submit" name="submit" value="送信" class="btn btn-third" style="margin-top: 41px; width: 110px; height: 54px">
          <button type="button" onclick=history.back() class="btn-secondary" style="height: 53px; width: 103px;">Return</button>
        </form>
      </div>
    </section>
  </body>
</html>

<?php

  if(isset($_POST['submit']))
  {
    $telephone = $_POST['telephone'];
    $tel_boolean="/^0[0-9]{1,4}-[0-9]{1,4}-[0-9]{3,4}\z/";

    if(preg_match($telephone,$tel_boolean))
    {
      $_SESSION['order_f_p'] = "<div class='success text-center'>TelePhone Number Failed.</div>";
      header("Location:http://localhost:8001/client/UpdatePhoneNumber.blade.php?client_id=$client_id");
      die();
    }

    $sql3 = "UPDATE tbl_client SET telephone = '$telephone'WHERE client_id= '$client_id'";

    $rec3=mysqli_query($connect,$sql3);
    if($rec3 == true)
    {
      $_SESSION['order_tel'] = "<div class='success text-center'>PhoneNumber Updated.</div>";
      header("Location:http:/localhost:8001/client/ClientPage.php?client_id=$client_id", 201);
      die();
    } else
    {
      $_SESSION['order_f_p'] = "<div class='success text-center'>PhoneNumber Update Failed.</div>";
      header("Location:http:/localhost:8001/client/UpdatePhoneNumber.blade.php?client_id=$client_id", 302);
      die();
    }
  }
include('../account/partials/ClientFooter.tpl');
?>