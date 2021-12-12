<?php
define('database', TRUE);
define('mail', TRUE);
define('format', TRUE);
?>


<?php

if (isset($_POST["email"])) {

    include 'db_conn.php';
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $_POST['email'] . "'");
    $row = mysqli_num_rows($result);
    if ($row <= 0) {
        $token = md5('rtcamp' . $_POST['email'] . 'rtcamp') . rand(10, 9999);
        $unsubscribeToken= md5('rtcampUnsubscibe').rand(10,9999);
        mysqli_query($conn, "INSERT INTO users(email, email_verification_link, unsubscribe_token) VALUES('" . $_POST['email'] . "', '" . $token . "','".$unsubscribeToken . "')");
 
        $link = 'https://xkcd.mggsneemrana.in/verify.php?key='.$_POST['email'].'&token='.$token;
        $title='Welcome to XKCD Comics';
        $content='Please click on the below button to verify your subscription.';
        $linktxt='Verify';
        include 'format.php';
        $html_body=htmlformat($title,$content,$link,$linktxt);
        

        include 'mail.php';
        Email('comics@xkcd.mggsneemrana.in',$_POST['email'],'Email Verification',$html_body);
    }
    else{
        echo 'You have already subscribed with this email address.';
    }
}
?>