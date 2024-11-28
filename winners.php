<?php
session_start();
require_once 'config/database.php';

$stmt = $db->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();

$winners = [];
foreach ($categories as $category) {
    $stmt = $db->prepare("
        SELECT e.firstname, e.lastname, COUNT(v.id) as votes
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
        $winners[$category['name']] = [
            'name' => $winner['firstname'],
            'surname' => $winner['lastname'],
            'votes' => $winner['votes']
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
    <link href="./styles/main.css" rel="stylesheet">
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

    <div class="container">
        <h4 class="my-4 text-center">Winners for Each Category</h4>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Winner</th>
                    <th>Votes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($winners as $categoryName => $winner): ?>
                    <tr>
                        <td><?= htmlspecialchars($categoryName) ?></td>
                        <td><?= htmlspecialchars($winner['name'] . ' ' . $winner['surname']) ?></td>
                        <td><?= htmlspecialchars($winner['votes']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>