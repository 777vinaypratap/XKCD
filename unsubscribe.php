<?php
define('database', TRUE);
?>

<?php

if (isset($_GET['email']) && isset($_GET['token'])) {
    if (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db_conn.php';
        $email = htmlspecialchars($_GET['email']);
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $email . "'");
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $row = mysqli_fetch_array($result);
            if ($row['email'] == $email && $row['unsubscribe_token'] == $_GET['token']) {
                $sql = "DELETE FROM users WHERE email='" . $row['email'] . "'";
                $result = mysqli_query($conn, $sql) || die('Problem in Unsubscribing the service.');
                echo '<div>You have successfully Unsubscribed from our service.</div>';
            }
        }
    }
}
?>