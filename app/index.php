<?php
header('Content-Type: text/html; charset=utf-8');

try {
    include 'phar://app.phar/index.php';
} catch (Exception $e) {
    echo 'Error loading PHAR file: ' . $e->getMessage();
    exit(1);
}
