<?php
define('comic', TRUE);
define('database', TRUE);
define('mail', TRUE);
define('format', TRUE);

$pass=getenv('CRON_PASS');
if (isset($_GET['pass'])) {
    if ($_GET['pass'] === $pass) {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db_conn.php';
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'format.php';
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'mail.php';

        // Comic attachment getting

        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'comic.php';
        $attachment = $attach;
        $imgtag=$imgtag;

        $sql = 'SELECT * FROM users WHERE status=?';
        $stmt = $conn->prepare($sql);
        $status=1;
        $stmt->bind_param('i', $status);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $email = $row['email'];
                $Unsubscribe_URL = 'https://'.$_SERVER['HTTP_HOST'].'/unsubscribe.php?email=' . $email . '&token=' . $row['unsubscribe_token'];
                $title = $title;
                $content = 'Above is your random XKCD comic. You can also find the same in the below attachment.<br/><br/>If you wanna Unsubscribe from our service then you can click on the below Unsubscribe button.';
                $linktxt = 'Unsubscribe';
                
                $html_body = htmlformat($title, $content, $Unsubscribe_URL, $linktxt,$imgtag);

                AttachEmail($email, 'XKCD Comic', $html_body, $attachment);
            }
        }
        $stmt->close();
        $conn->close();
    }
}
?>