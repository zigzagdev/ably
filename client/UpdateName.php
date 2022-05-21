<?php
include('./partials/HeaderEd.blade.php');

if(isset($_SESSION['name_error']))
{
  echo $_SESSION['name_error'];
  unset($_SESSION['name_error']);
}
$client_id = $_GET['client_id'];

if(isset($_GET['client_id'])) {
  $sql2 = "SELECT name  FROM tbl_client WHERE client_id = $client_id";
  $rec2 = mysqli_query($connect, $sql2);
  if ($rec2 == true) {
    $count = mysqli_num_rows($rec2);
    if ($count == 1) {
      $row = mysqli_fetch_assoc($rec2);
      $name = $row['name'];
    } else {
      header('Location: '. $_SERVER['HTTP_REFERER']);
    }
  }
}
?>

<html>
  <head>
    <title>UpdateNameForm</title>
    <link rel="stylesheet" href="../css/Account.css">
    <link rel="stylesheet" href="../css/Forms.css">
  </head>
  <body>
    <section class="food-search">
      <div class="container2">
        <h2 style="text-align: center">ChangeYourName</h2>
        <form action="" method="POST" class="order" style="text-align: center">
          <fieldset class="mainaccount" style="margin: 0 310px">
            <legend>Change YourName</legend>
            <p style="font-size: 20px; margin-bottom: 30px">You can change your name at below.</p>
            <li style="list-style: none;  margin:17px 0 17px 140px">
              <b style="font-size: 20px;width:80px;margin-right:50px; float: left;">
                YourName
              </b>
              <input type="text" name="name"  placeholder="Steave Smith" class="input-responsive" required>
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
    $name = $_POST['name'];
    $client_id = $_GET['client_id'];

    $name_boolean = "/^[a-zA-Z]*$/";
    if(preg_match($name,$name_boolean))
    {
      $_SESSION['name_error'] = "<div class='success text-center'>Write down your name correctly(Only can use Alphabet.)!</div>";
      header("location:http://localhost:8001/client/UpdateName.php?client_id=$client_id", 302);
      die();
    }

    $sql3 = "UPDATE tbl_client SET name = '$name' WHERE client_id= '$client_id'";
    $rec3=mysqli_query($connect,$sql3);
    if($rec3 == true)
    {
      $_SESSION['name_s'] = "<div class='success'>Name was Updated.</div>";
      header("location:http://localhost:8001/client/ClientPage.php?client_id=$client_id");
      die();
    }
    else
    {
      $_SESSION['name_error'] = "<div class='success'>Name Update was Failed.</div>";
      header("location:http://localhost:8001/client/UpdateName.php?client_id=$client_id");
      die();
    }
  }
include('../account/partials/ClientFooter.tpl');
?>
