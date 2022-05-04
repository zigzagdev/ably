<?php
//include "../config/Constants.blade.php";
//
//  if(isset($_SESSION['u_fail_i']))
//  {
//    echo  $_SESSION['u_fail_i'];
//    unset($_SESSION['u_fail_i']);
//  }
//
//  if(isset($_GET['client_id']))
//  {
//    $client_id = $_GET['client_id'];
//    $sql2 = "SELECT image  FROM tbl_client WHERE client_id = $client_id";
//    $rec2 = mysqli_query($connect, $sql2);
//    if ($rec2 == true)
//    {
//      $count = mysqli_num_rows($rec2);
//      if ($count == 1)
//      {
//        $row = mysqli_fetch_assoc($rec2);
//        $image = $row['image'];
//      } else {
//        header('Location: ' . $_SERVER['HTTP_REFERER']);
//    }
//  }
//}
//
//  if(isset($_FILES['image']['name']))
//  {
//    $new = $_FILES['image']['name'];
//    if($new != "")
//    {
//      $source_path      = $_FILES['image']['tmp_name'];
//      $destination_path = "../images/profile/".$new;
//      $upload = move_uploaded_file($source_path, $destination_path);
//    if($upload!=true)
//    {
//      $_SESSION['upload_f_c'] = "<div style='text-align: center; color: #ff6666; font-size: 20px'>Failed to Upload Image. </div>";
//      $url = "http://localhost:8001/client/UpdateImage.blade.php?client_id=$client_id";
//      header('Location:'.$url,true , 401);
//      die();
//    }
//    if($image != "")
//    {
//      $remove_path = "../images/profile/".$image;
//      $remove = unlink($remove_path);
//      if($remove == false)
//      {
//        $_SESSION['failed-remove'] = "<div style='text-align: center; color: #ff6666; font-size: 20px'>Failed to remove current Image.</div>";
//        $url = "http://localhost:8001/client/UpdateImage.blade.php?client_id=$client_id";
//        header('Location:' .$url, true , 401);
//        die();
//      }
//    }
//  } else
//    {
//    $image = $new;
//  }
//}
//
//$sql = "UPDATE tbl_client SET image ='$image' WHERE client_id = '$client_id'";
//$rec = mysqli_query($connect, $sql);
//
//if($rec==true)
//{
//  $url = "http://localhost:8001/client/ClientPage.php?client_id=$client_id";
//  header('Location:' .$url, true , 302);
//} else
//{
//  $_SESSION['u_fail_i'] = "<div style='text-align: center; color: #ff6666; font-size: 20px'>Failed to Update Account.</div>";
//  $url = "http://localhost:8001/client/ClientPage.php?client_id=$client_id";
//  header('Location:' .$url, true , 401);
//  die();
//}

