<?php
session_start();
require_once '../config/database.php';

$stmt = $db->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();

$winners = [];
foreach ($categories as $category) {
    $stmt = $db->prepare("
        SELECT e.firstname, e.lastname, COUNT(v.id) as votes, e.id as winner_id
        FROM employees e
        JOIN votes v ON e.id = v.nominee_id
        WHERE v.category_id = :category_id
        GROUP BY e.id
        ORDER BY votes DESC
        LIMIT 1
    ");
    $stmt->execute(['category_id' => $category['id']]);
    $winner = $stmt->fetch();

    if ($winner) {
        $winners[] = [
            'name' => $winner['firstname'],
            'surname' => $winner['lastname'],
            'votes' => $winner['votes'],
            'category' => $category['name'],
            'winner_id' => $winner['winner_id']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/main.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="winners.php">Winners</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="voters.php">Voters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container container-winners">
        <h4 class="my-4 text-center">Winners for Each Category</h4>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Votes</th>
                    <th>Certificates</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($winners as $winner): ?>
                    <tr>
                        <td><?= htmlspecialchars($winner['category']) ?></td>
                        <td><?= htmlspecialchars($winner['name']) ?></td>
                        <td><?= htmlspecialchars($winner['surname']) ?></td>
                        <td><?= $winner['votes'] ?></td>
                        <td>
                            <a style="color: black !important; text-decoration: none; font-weight: bold;"
                                class="certificate-link" target="_blank"
                                href="../bonus/generate_certificate.php?winner_name=<?= urlencode($winner['name'] . ' ' . $winner['surname']) ?>&category=<?= urlencode($winner['category']) ?>&votes=<?= $winner['votes'] ?>">
                                Get the certificate
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>