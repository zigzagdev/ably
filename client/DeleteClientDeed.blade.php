<?php
include "../config/Constants.blade.php";

$client_id = $_GET['client_id'];

$sql = "
        SELECT
            *
          FROM
            tbl_client
        WHERE
            client_id = $client_id
       ";

$rec = mysqli_query($connect, $sql);
if($rec == TRUE)
{
  $count = mysqli_num_rows($rec);
}

$deletesql = "
              DELETE
                FROM
                  tbl_client
              WHERE
                  client_id = $client_id
             ";

$deleterec = mysqli_query($connect, $deletesql);

if($deleterec == TRUE)
{
  $_SESSION['dlt_cli'] = "<div class='success'>Delete Account Successfully.</div>";
  header("Location:http://localhost:8001/Index.php");
  exit();
} else {
  $_SESSION['client_failed'] = "<div class='success'>Failed to delete Account.</div>";
  header("http:/localhost:8001//client/DeleteClient.php?client_id=$client_id");
  die();
}

?>