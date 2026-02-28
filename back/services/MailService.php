<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class MailService
{
    private const SMTP_HOST = 'smtp-ruche.alwaysdata.net';
    private const SMTP_PORT = 587;
    private const SMTP_USER = 'ruche@alwaysdata.net';
    private const SMTP_PASS = 'laruche@45';
    private const FROM_EMAIL = 'ruche@alwaysdata.net';
    private const FROM_NAME = 'La Ruche';

    private static function createMailer(): PHPMailer
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = self::SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = self::SMTP_USER;
        $mail->Password = self::SMTP_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = self::SMTP_PORT;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

        return $mail;
    }

    public static function sendHTML(string $to, string $subject, string $htmlBody): bool
    {
        try {
            $mail = self::createMailer();
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $htmlBody;
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("LARUCHE MAIL ERROR - to: $to | error: " . $e->getMessage());
            return false;
        }
    }

    public static function sendText(string $to, string $subject, string $textBody): bool
    {
        try {
            $mail = self::createMailer();
            $mail->addAddress($to);
            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body = $textBody;
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("LARUCHE MAIL ERROR - to: $to | error: " . $e->getMessage());
            return false;
        }
    }
}
