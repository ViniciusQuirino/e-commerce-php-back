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
            $obMail->Host = env('HOST');
            $obMail->SMTPAuth = true;
            $obMail->Username = env('USER');
            $obMail->Password = env('PASS');
            $obMail->SMTPSecure = env('SECURE');
            $obMail->Port = env('PORT');
            $obMail->CharSet = env('CHARSET');

            $obMail->setFrom(env('FROM_EMAIL'), env('FROM_NAME'));

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
