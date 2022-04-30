<?php
include  "../account/partials/ClientHeader.tpl";
  if(isset($_SESSION['cli_add']))
  {
    echo  $_SESSION['cli_add'];
    unset($_SESSION['cli_add']);
  }

?>