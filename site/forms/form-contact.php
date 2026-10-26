<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$recipient = 'przemek@qamitech.pl';
$siteName  = 'Qamitech';

/** Pole formularza jako jednolinijkowy tekst (bez znaków nowej linii – ochrona nagłówków e-mail). */
function form_field(string $key, int $max = 200): string
{
    $value = trim((string)($_POST[$key] ?? ''));
    $value = preg_replace('/[\r\n\t]+/', ' ', $value);
    return mb_substr($value, 0, $max, 'UTF-8');
}

$name    = form_field('visitor_name');
$surname = form_field('visitor_surname');
$company = form_field('visitor_company');
$topic   = form_field('visitor_topic');
$email   = form_field('visitor_email', 254);
$phone   = form_field('visitor_phone', 50);
$msg     = mb_substr(trim((string)($_POST['visitor_msg'] ?? '')), 0, 5000, 'UTF-8');

if ($name === '' || $email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    exit;
}

$e = function ($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
};

$subject = 'Wiadomość ze strony "' . $siteName . '"' . ($topic !== '' ? ' – ' . $topic : '');

$rows = [
    'Imię i nazwisko' => trim($name . ' ' . $surname),
    'Firma'           => $company,
    'Temat'           => $topic,
    'E-mail'          => $email,
    'Telefon'         => $phone,
];
$message = "-------------------<br><br>\n";
foreach ($rows as $label => $value) {
    if ($value !== '') {
        $message .= '<strong>' . $label . ':</strong> ' . $e($value) . "<br>\n";
    }
}
$message .= '<strong>Wiadomość:</strong><br>' . nl2br($e($msg)) . "<br><br>\n-------------------";

$headers = [
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=UTF-8',
    'From: Qamitech <noreply@qamitech.pl>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
];

$encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

if (! mail($recipient, $encodedSubject, $message, implode("\r\n", $headers))) {
    http_response_code(500);
}
