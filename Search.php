<?php

if(isset($_SESSION['lesson-not-found']))
{
  echo $_SESSION['lesson-not-found'];
  unset($_SESSION['lesson-not-found']);
}