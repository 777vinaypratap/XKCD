<?php 
if(!defined('mail')) {
    die('Nothing is available');
 }
?>

<?php 

function AttachEmail($from,$to,$subject,$message,$attachment){
        // a random hash will be necessary to send mixed content
        $boundary = md5(uniqid(time()));
    
        //header
        $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
        $headers .= "From:".$from."\r\n"; // Sender Email
        $headers .= "Reply-To: ".$from."\r\n"; // Email address to reach back
        $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
        $headers .= "boundary = $boundary\r\n"; //Defining the Boundary
             
        //plain text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($message));
             
        //attachment
        $body .= "--$boundary\r\n";
        $body .="Content-Type: ".$attachment[2]."; name=".$attachment[0]."\r\n";
        $body .="Content-Disposition: attachment; filename=".$attachment[0]."\r\n";
        $body .="Content-Transfer-Encoding: base64\r\n";
        $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
        $body .= $attachment[1]; // Attaching the encoded file with email
        //SEND Mail
        if (mail($to, $subject, $body, $headers)) {
            echo "Your mail has been sent successfully."; // or use booleans here
        } else {
            echo "Unable to send email. Please try again";
            // print_r( error_get_last() );
        }


}


function Email($from,$to,$subject,$message){
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    echo 'Success!!! Check your email for verification.';
} else{
    $errorMessage = error_get_last()['message'];
    echo $errorMessage;
    echo 'There is a problem sending email. Please try again.';

}

}

?>