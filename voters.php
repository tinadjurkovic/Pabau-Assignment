<?php
session_start();
require_once 'config/database.php';

$stmt = $db->prepare("
    SELECT e.firstname, e.lastname, COUNT(v.voter_id) AS votes_count
    FROM employees e
    LEFT JOIN votes v ON e.id = v.voter_id
    GROUP BY e.id
    ORDER BY votes_count DESC
");
$stmt->execute();
$voters = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./styles/main.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="winners.php">Winners</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="voters.php">Voters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <h3 class="my-4">Top Voters</h3>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Votes Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($voters as $voter): ?>
                    <tr>
                        <td><?= htmlspecialchars($voter['firstname']) ?></td>
                        <td><?= htmlspecialchars($voter['lastname']) ?></td>
                        <td><?= $voter['votes_count'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>