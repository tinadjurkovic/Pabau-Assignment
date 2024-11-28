<?php
class CertificateGenerator
{
    private $winnerName;
    private $category;
    private $votes;

    public function __construct($winnerName, $category, $votes)
    {
        $this->winnerName = $winnerName;
        $this->category = $category;
        $this->votes = $votes;
    }

    public function generateCertificate()
    {
        $image = imagecreatetruecolor(600, 400);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        imagefill($image, 0, 0, $white);

        $fontSize = 20;
        imagestring($image, 5, 200, 50, 'Certificate of Achievement', $black);
        imagestring($image, 5, 200, 150, 'Congratulations, ' . $this->winnerName . '!', $black);
        imagestring($image, 5, 200, 200, 'Category: ' . $this->category, $black);
        imagestring($image, 5, 200, 250, 'Votes: ' . $this->votes, $black);

        header('Content-Type: image/png');
        imagepng($image);

        imagedestroy($image);
    }
}

if (isset($_GET['winner_name']) && isset($_GET['category']) && isset($_GET['votes'])) {
    $winnerName = $_GET['winner_name'];
    $category = $_GET['category'];
    $votes = $_GET['votes'];

    $certificateGenerator = new CertificateGenerator($winnerName, $category, $votes);
    $certificateGenerator->generateCertificate();
}