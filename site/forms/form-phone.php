<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$recipient = 'przemek@qamitech.pl';
$siteName = 'Qamitech';
$subject = 'Kontakt telefoniczny ze strony "' . $siteName . '"';

$phone = trim((string)($_POST['visitor_phone'] ?? ''));
$email = trim((string)($_POST['visitor_email'] ?? ''));

if ($phone === '' || $email === '' || preg_match('/[\r\n]/', $email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'Invalid form data']);
    exit;
}

$safePhone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

$message = '
<html>
<body>
  <h2>Nowa prosba o kontakt</h2>
  <p><strong>Telefon:</strong> ' . $safePhone . '</p>
  <p><strong>Email:</strong> ' . $safeEmail . '</p>
</body>
</html>';

$headers = [
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=UTF-8',
    'From: Qamitech <noreply@qamitech.pl>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
];

$sent = mail($recipient, $subject, $message, implode("\r\n", $headers));

if (! $sent) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Mail send failed']);
    exit;
}

echo json_encode(['status' => 'success']);
