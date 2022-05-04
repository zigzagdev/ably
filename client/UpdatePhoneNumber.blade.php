<?php
include('../account/partials/HeaderInfo.blade.php');

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
  <body>
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
          <input type="submit" name="submit" value="送信" class="btn btn-third" style="margin-top: 40px">
          <button type="button" onclick=history.back() class="btn-secondary">Return</button>
        </form>
      </div>
    </section>
  </body>
</html>

<?php
  $host = 'localhost';
  $username = 'root';
  $pass = 'root';
  $dbname = 'overcome';

  if(isset($_POST['submit']))
  {
    $telephone = $_POST['telephone'];
    $tel_boolean="/^0[0-9]{1,4}-[0-9]{1,4}-[0-9]{3,4}\z/";
    if(preg_match($tel_boolean,$telephone))
    {
      $_SESSION['order_f_p'] = "<div class='success text-center'>Form Update Failed.</div>";
      $url = "http://localhost:8001/client/UpdatePhoneNumber.blade.php?client_id=$client_id";
      header('Location:' .$url, true , 401);
    }

    $sql3 = "UPDATE tbl_client SET telephone = '$telephone'WHERE client_id= '$client_id'";

    $rec3=mysqli_query($connect,$sql3);
    if($rec3 == true)
    {
      $_SESSION['order_tel'] = "<div class='success text-center'>Form order Updated.</div>";
      $url = "http://localhost:8001/client/ClientPage.php?client_id=$client_id";
      header('Location:' .$url, true , 302);
    } else
    {
      $_SESSION['order_f_p'] = "<div class='success text-center'>PhoneNumber Update Failed.</div>";
      $url = "http://localhost:8001/form/UpdatePhoneNumber.blade.php?client_id=$client_id";
      header('Location:' .$url, true , 401);
    }
  }
include('../account/partials/ClientFooter.tpl');
?>