<?php
include('./partials/HeaderEd.tpl');

if (isset($_SESSION['order_f'])) {
    echo $_SESSION['order_f'];
    unset($_SESSION['order_f']);
}

if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];
    $sql2 = "SELECT email FROM tbl_client  where client_id = $client_id";
    $rec2 = mysqli_query($connect, $sql2);
    if ($rec2 == true) {
        $count = mysqli_num_rows($rec2);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($rec2);
            $email = $row['email'];
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>

    <html>
    <head>
        <title>UpdateEmail</title>
        <link rel="stylesheet" href="../css/Account.css">
        <link rel="stylesheet" href="../css/Forms.css">
    </head>
    <body>
    <section class="food-search">
        <div class="container2">
            <h2 style="text-align: center">ChangeEmail</h2>
            <form action="" method="POST" class="order" style="text-align: center">
                <fieldset class="mainaccount" style="margin: 0 310px">
                    <legend>Change Email</legend>
                    <p style="font-size: 20px; margin-bottom: 30px">You can change your Email number at below.</p>
                    <li style="list-style: none;  margin:17px 0 17px 140px">
                        <b style="font-size: 20px;width:80px;margin-right:80px; float: left;">
                            Email
                        </b>
                        <input type="email" name="email" placeholder="abc@com" class="input-responsive" required>
                    </li>
                </fieldset>
                <input type="submit" name="submit" value="送信" class="btn btn-third"
                       style="margin-top: 41px; width: 110px; height: 54px">
                <button type="button" onclick=history.back() class="btn-secondary" style="height: 53px; width: 103px;">
                    Return
                </button>
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


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $contents_mail = '/¥A\w\-\.]+¥@[\w\-\.]+.([a-z]+)\z/';
    if (preg_match($contents_mail, $email)) {
        print 'write down your email correctly !';
    }

    $sql_1 = "SELECT
                  tbl_account.email
                FROM
                  tbl_account
              LEFT JOIN
                  tbl_client
                ON
                  tbl_account.email= tbl_client.email
              WHERE
                  tbl_account.email='$email'
              UNION
              SELECT
                  tbl_client.email
                FROM
                  tbl_account
              RIGHT JOIN
                  tbl_client
                ON
                  tbl_account.email= tbl_client.email
              WHERE
              tbl_client.email='$email'
           ";
    $rec_1 = mysqli_query($connect, $sql_1);
    $rec_2 = mysqli_num_rows($rec_1);
    if ($rec_2 > 0) {
        $_SESSION['add_fail_c'] = "<div class='success'>User already exists</div>";
        header("http://localhost:8001/client/UpdateEmail.php?client_id=$client_id");
        die();
    }

    $sql3 = "UPDATE
               tbl_client
           SET
               email = '$email'
           WHERE
               client_id= '$client_id'
           ";

    $rec3 = mysqli_query($connect, $sql3);

    if ($rec3 == true) {
        $_SESSION['order'] = "<div class='success text-center'>Your Email Updated.</div>";
        header("http://localhost:8001/client/ClientPage.php?client_id=$client_id");
        die();
    } else {
        $_SESSION['order_f'] = "<div class='success text-center'>Form Update Failed.</div>";
        header("http://localhost:8001/client/UpdateEmail.php?client_id=$client_id");
        die();
    }
}
include('../account/partials/ClientFooter.tpl');
?>