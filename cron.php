<?php
define('comic', TRUE);
define('database', TRUE);
define('mail', TRUE);
define('format', TRUE);
?>


<?php
if (isset($_GET['pass'])) {
    if ($_GET['pass'] === '1@3$5^7*9)') {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'db_conn.php';
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'format.php';
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'mail.php';


        // Comic attachment getting

        include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'comic.php';
        $attachment = $attach;
        $imgtag=$imgtag;

        $sql='SELECT * FROM users WHERE status=1';
        $result = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $email = $row['email'];
                $Unsubscribe_URL = 'https://xkcd.mggsneemrana.in/unsubscribe.php?email=' . $email . '&token=' . $row['unsubscribe_token'];
                $title = $title;
                $content = 'Above is your random XKCD comic. You can also find the same in the below attachment.<br/><br/>If you wanna Unsubscribe from our service then you can click on the below Unsubscribe button.';
                $linktxt = 'Unsubscribe';
                
                $html_body = htmlformat($title, $content, $Unsubscribe_URL, $linktxt,$imgtag);

                AttachEmail('comics@xkcd.mggsneemrana.in', $email, 'XKCD Comic', $html_body, $attachment);
            }
        }
    }
}
?>