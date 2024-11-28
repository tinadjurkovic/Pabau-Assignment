<?php
require_once 'certificateGenerator.php';

if (isset($_GET['winner_name']) && isset($_GET['category']) && isset($_GET['votes'])) {
    $winnerName = $_GET['winner_name'];
    $category = $_GET['category'];
    $votes = $_GET['votes'];

    $certificateGenerator = new CertificateGenerator($winnerName, $category, $votes);
    $certificateGenerator->generateCertificate();
}