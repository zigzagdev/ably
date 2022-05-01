<?php
include  "./partials/HeaderEd.tpl";
  if(isset($_SESSION['cli_add']))
  {
    echo  $_SESSION['cli_add'];
    unset($_SESSION['cli_add']);
  }

  if(isset($_SESSION['s_login']))
  {
    echo  $_SESSION['s_login'];
    unset($_SESSION['s_login']);
  }

  $client_id = $_GET['client_id'];
  $sql = "SELECT * FROM tbl_account where client_id=$client_id";
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
        $sex         = $rows['sex'];
        $content     = $rows['content'];
        if ($image == "")
        {
          echo "<div class='error'>Image not Added.</div>";
        }
      }
    }
  }
?>




<?php include "./partials/FooterEd.tpl" ?>
