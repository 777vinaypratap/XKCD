<?php
define('database', TRUE);
?>

<?php
if (isset($_GET['key']) && isset($_GET['token'])) {
    if (filter_var($_GET['key'], FILTER_VALIDATE_EMAIL)) {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db_conn.php';
        $email = htmlspecialchars($_GET['key']);
        $token = $_GET['token'];
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $email . "'");
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = mysqli_fetch_array($result);
            if ($_GET['key'] == $row['email'] && $_GET['token'] == $row['email_verification_link'] && $row['status'] == 0) {
                $sql = "UPDATE users SET status=1 WHERE email='$email'";
                $result = mysqli_query($conn, $sql) || die('Problem uploading data to database');
                echo 'You Have Successfully verified your email address.<br/>Now, You will receive a New comic after each five minutes.';
            } else {
                echo 'You have already verified your email address.';
            }
        }
    }
}


?>