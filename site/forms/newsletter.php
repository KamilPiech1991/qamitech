<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$email = trim((string)($_POST['visitor_mail'] ?? ''));

if ($email === '' || preg_match('/[\r\n]/', $email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'Invalid email']);
    exit;
}

$recipient = 'przemek@qamitech.pl';
$subject = 'Nowy zapis do newslettera Qamitech';
$safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

$message = '
<html>
<body>
  <h2>Nowy zapis do newslettera</h2>
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
