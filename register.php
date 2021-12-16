<?php
define('database', TRUE);
define('mail', TRUE);
define('format', TRUE);

if (isset($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db_conn.php';
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'format.php';
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'mail.php';
        if(isset($_SERVER['HTTP_HOST'])){
            $address=$_SERVER['HTTP_HOST'];
        }

        $email = htmlspecialchars($_POST['email']);
        $sql = 'SELECT * FROM users WHERE email=?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows <= 0) {
            $token = md5('rtcamp' . $email . 'rtcamp') . rand(10, 9999);
            $unsubscribeToken = md5('rtcampUnsubscibe') . rand(10, 9999);
            $sql = 'INSERT INTO users (email, email_verification_link, unsubscribe_token) VALUES (?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $email,$token,$unsubscribeToken);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            $link = 'https://'.$address.'/verify.php?key=' . $email . '&token=' . $token;
            $title = 'Welcome to XKCD Comics';
            $content = 'Please click on the below button to verify your email.';
            $linktxt = 'Verify';
            $html_body = htmlformat($title, $content, $link, $linktxt,'');

            Email($email, 'Email Verification', $html_body);
        } else {
            echo 'You have already subscribed with this email address.';
        }
    } else {
        echo 'Invalid email address';
    }
}
?>