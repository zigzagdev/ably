<?php  include('../account/partials/header.php'); ?>

<?php
if(isset($_GET['form_id'])) {

    $form_id = $_GET['form_id'];
    $sql2 = "SELECT * FROM tbl_form  where form_id= $form_id";
    $rec2 = mysqli_query($connect, $sql2);

    if ($rec2 == true) {
        $count = mysqli_num_rows($rec2);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($rec2);
            $form_id = $row['form_id'];
            $name = $row['name'];
            $telephone = $row['telephone'];
            $email = $row['email'];
            $sex = $row['sex'];

        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>
