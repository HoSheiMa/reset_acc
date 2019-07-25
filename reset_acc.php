<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';

$email = $_GET['email'];
$Code = $_GET['Code'];










    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
    //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
                             // Enable verbose debug output
        // $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;                                    // TCP port to connect to
        $mail->Username = '';
        $mail->Password = '';                       // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

    //Recipients
        $mail->setFrom("support@info.com", "No title");
        $mail->addAddress("$email");    // Name is optional

        $mail->setLanguage('ar', '/optional/path/to/language/directory/');


        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'استرجاع الايمال';
        $mail->Body = "<h3>Your Code is <Strong>{$Code}</Strong></h3>";

        $mail->send();
        echo '{"state" : "success", "code" : "'. $Code. '", "email" : "'.$email.'"}';
    } catch (Exception $e) {
        echo '{"state" : "failed","code": "'. $Code. '", "email" : "'. $email. '"}';
    }
