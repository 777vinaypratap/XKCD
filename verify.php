<?php
define('database', TRUE);

if (isset($_GET['key']) && isset($_GET['token'])) {
    if (filter_var($_GET['key'], FILTER_VALIDATE_EMAIL)) {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db_conn.php';
        $email = htmlspecialchars($_GET['key']);
        $token = $_GET['token'];

        $sql = 'SELECT * FROM users WHERE email=?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($_GET['key'] == $row['email'] && $_GET['token'] == $row['email_verification_link'] && $row['status'] == 0) {
                $sql = 'UPDATE users SET status=? WHERE email=?';
                $stmt = $conn->prepare($sql);
                $status=1;
                $stmt->bind_param('is',$status,$email);
                $stmt->execute();
                echo 'You Have Successfully verified your email address.<br/>Now, You will receive a New comic after each five minutes.';
            } else {
                echo 'You have already verified your email address.';
            }
        }
        $stmt->close();
        $conn->close();
    }
}
?>