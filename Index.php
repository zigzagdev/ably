<?php
include('./config/Constants.blade.php');
include('./account/partials/ClientHeader.tpl');

  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }
?>

<?php include "./account/partials/ClientFooter.tpl"?>
