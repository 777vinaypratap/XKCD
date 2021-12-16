<?php
define('database', TRUE);

if (isset($_GET['email']) && isset($_GET['token'])) {
    if (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db_conn.php';
        $email = htmlspecialchars($_GET['email']);

        $sql = 'SELECT * FROM users WHERE email=?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['email'] == $email && $row['unsubscribe_token'] == $_GET['token']) {
                $sql = 'DELETE FROM users WHERE email=?';
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                echo '<div>You have successfully Unsubscribed from our service.</div>';
            }
        }
        $stmt->close();
        $conn->close();
    }
}
?>