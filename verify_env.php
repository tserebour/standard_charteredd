<?php
require_once __DIR__ . '/includes/env_loader.php';

echo "DB_HOST: " . ($_ENV['DB_HOST'] ?? 'NOT SET') . "\n";
echo "DB_NAME: " . ($_ENV['DB_NAME'] ?? 'NOT SET') . "\n";
echo "DB_USER: " . ($_ENV['DB_USER'] ?? 'NOT SET') . "\n";
echo "DB_PASS: " . (isset($_ENV['DB_PASS']) ? '[HIDDEN]' : 'NOT SET') . "\n";
echo "DB_CHARSET: " . ($_ENV['DB_CHARSET'] ?? 'NOT SET') . "\n";
