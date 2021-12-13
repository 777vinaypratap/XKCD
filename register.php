<?php
define('database', TRUE);
define('mail', TRUE);
define('format', TRUE);
?>


<?php

if (isset($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db_conn.php';
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'format.php';
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'mail.php';

        $email = htmlspecialchars($_POST['email']);
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $email . "'");
        $row = mysqli_num_rows($result);
        if ($row <= 0) {
            $token = md5('rtcamp' . $email . 'rtcamp') . rand(10, 9999);
            $unsubscribeToken = md5('rtcampUnsubscibe') . rand(10, 9999);
            mysqli_query($conn, "INSERT INTO users(email, email_verification_link, unsubscribe_token) VALUES('" . $email . "', '" . $token . "','" . $unsubscribeToken . "')");

            $link = 'https://xkcd.mggsneemrana.in/verify.php?key=' . $email . '&token=' . $token;
            $title = 'Welcome to XKCD Comics';
            $content = 'Please click on the below button to verify your email.';
            $linktxt = 'Verify';
            $html_body = htmlformat($title, $content, $link, $linktxt,'');


            Email('comics@xkcd.mggsneemrana.in', $email, 'Email Verification', $html_body);
        } else {
            echo 'You have already subscribed with this email address.';
        }
    } else {
        echo 'Invalid email address';
    }
}
?>