<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**Send email function using PHP Mailer Library */
if (!function_exists('sendEmail')) {
    function sendEmail($mailConfig)
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port = env('MAIL_PORT');
        $mail->setFrom($mailConfig['mail_from_email'], $mailConfig['mail_from_name']);
        $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mail_subject'];
        $mail->Body = $mailConfig['mail_body'];
        $mail->CharSet = "UTF-8";

        // dd($mail);
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}


if (!function_exists('get_user')) {
    function get_user()
    {
        if (Auth::check()) {
            $user = User::findOrFail(auth()->id());
            return $user;
        } else {
            return null;
        }
    }
}
