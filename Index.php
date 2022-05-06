<?php
include('./config/Constants.blade.php');
include('./account/partials/ClientHeader.tpl');

  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }
  if(isset($_SESSION['dlt_cli']))
  {
    echo $_SESSION['dlt_cli'];
    unset($_SESSION['dlt_cli']);
  }
?>

<?php include "./account/partials/ClientFooter.tpl"?>
