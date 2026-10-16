<?php

$host = $_SERVER['HTTP_HOST'] ?? 'qamitech.pl';
$isHttps = ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
$scheme = $isHttps ? 'https' : 'http';
$basePath = preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/', $host) ? '/qamitech/' : '/';

define('ABS_URL', $scheme . '://' . $host . $basePath);
