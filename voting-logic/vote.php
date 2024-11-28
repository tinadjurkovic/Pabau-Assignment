<?php

session_start();
require_once '../config/database.php';

$stmt = $db->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();

$stmt = $db->prepare("SELECT id, firstname, lastname FROM employees WHERE id != :user_id");
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$employees = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote for Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../results/winners.php">Winners</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../results/voters.php">Voters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../login-logout-logic/logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <h3 class="my-4">Vote for your Favorite Employee</h3>

        <form id="voteForm" action="vote_process.php" method="POST">
            <div class="mb-3">
                <label for="category" class="form-label">Select a Category</label>
                <select id="category" name="category_id" class="form-control select-control">
                    <option value="">Select a Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="nominee" class="form-label">Select a Nominee</label>
                <select id="nominee" name="nominee_id" class="form-control select-control">
                    <option value="">Select a Nominee</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee['id'] ?>">
                            <?= htmlspecialchars($employee['firstname'] . ' ' . $employee['lastname']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Your Comment</label>
                <textarea id="comment" name="comment" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Vote</button>
        </form>
    </div>



    <script>
        $(document).ready(function () {
            $('#voteForm').submit(function (event) {
                const nomineeId = $('#nominee').val();
                const comment = $('#comment').val();

                if (nomineeId === <?= $_SESSION['user_id'] ?>) {
                    alert("You cannot vote for yourself!");
                    event.preventDefault();
                }

                if (!comment.trim()) {
                    alert("Comment is required!");
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>