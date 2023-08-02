<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email
{
    private $error;

    public function getError()
    {
        return $this->error;
    }

    public function sendEmail($addresses, $subject, $body, $attachments = [], $ccs = [], $bccs = [])
    {
        $this->error = '';

        $obMail = new PHPMailer(true);
        try {
            $obMail->isSMTP(true);
            $obMail->Host = env('MAILER_HOST');
            $obMail->SMTPAuth = true;
            $obMail->Username = env('MAILER_USER');
            $obMail->Password = env('MAILER_PASS');
            $obMail->SMTPSecure = env('MAILER_SECURE');
            $obMail->Port = env('MAILER_PORT');
            $obMail->CharSet = env('MAILER_CHARSET');

            $obMail->setFrom(env('MAILER_FROM_EMAIL'), env('MAILER_FROM_NAME'));

            $addresses = is_array($addresses) ? $addresses : [$addresses];
            foreach ($addresses as $address) {
                $obMail->addAddress($address);
            }

            $attachments = is_array($attachments) ? $attachments : [$attachments];
            foreach ($attachments as $attachment) {
                $obMail->addAttachment($attachment);
            }

            $ccs = is_array($ccs) ? $ccs : [$ccs];
            foreach ($ccs as $cc) {
                $obMail->addCC($cc);
            }

            $bccs = is_array($bccs) ? $bccs : [$bccs];
            foreach ($bccs as $bcc) {
                $obMail->addBCC($bcc);
            }

            $obMail->isHTML(true);
            $obMail->Subject = $subject;
            $obMail->Body = $body;

            return $obMail->send();
        } catch (PHPMailerException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
}
