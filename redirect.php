<?php
// Safe tracking redirect starter.
// Production: store click event in MySQL, validate allowed destination,
// apply configured geo/device rules, then redirect.
require_once "config.php";
$code = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['c'] ?? '');
$demoDestinations = [
  'demo' => 'https://example.com/'
];
$destination = $demoDestinations[$code] ?? 'https://example.com/';
header("Location: ".$destination, true, 302);
exit;
?>