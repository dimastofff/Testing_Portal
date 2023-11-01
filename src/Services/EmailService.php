<?php

namespace App\Services;

use App\Models\User;

class EmailService
{
    public static function sendConfirmationLetter(User $user): void
    {
        $emailTemplate = file_get_contents('views/mailer/confirmationTemplate.html');
        $emailConfirmationLink = $_ENV['DOMAIN_FOR_CONFIRMATION'] . '/auth/emailConfirmation?hash=' . $user->getEmailConfirmationHash();
        $body = str_replace(
            ['{email}', '{emailConfirmationLink}'],
            [$user->getEmail(), $emailConfirmationLink],
            $emailTemplate
        );
        self::sendEmail($user->getEmail(), 'Testing Portal: Email Confirmation Letter', $body);
    }

    private static function sendEmail(string $email, string $subject, string $body): void
    {
        $mailer = $GLOBALS['MAILER'];
        $mailer->isHTML(true);
        $mailer->setFrom($_ENV['SMTP_USER'], 'Testing Portal No-Reply');
        $mailer->addAddress($email);
        $mailer->Subject = $subject;
        $mailer->Body = $body;
        $mailer->send();
    }
}
