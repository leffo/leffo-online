<?php


namespace AYakovlev\Core;


use AYakovlev\Models\User;

class EmailSender
{
    public static function send(
        User $receiver,
        string $subject,
        string $templateName,
        array $templateVars = []
    ): void
    {
        extract($templateVars);

        ob_start();

        require __DIR__ . "/../Mail/" . $templateName;
        $body = ob_get_contents();
        ob_end_clean();
        $tmpmail = "To: " . $receiver->email . "<br>" .  "Theme: " . $subject . "<br><br>" . $body;

        // выполняем функцию sendmail
        echo $tmpmail . "<br><br><br>";
        // TODO uncommented in production
        //mail($receiver->email, $subject, $body, 'Content-Type: text/html; charset=UTF-8');
    }
}