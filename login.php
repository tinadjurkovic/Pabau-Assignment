<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./styles/main.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h3>Ready to appreciate your favorite employees?</h3>

        <?php if (!empty($_SESSION['errorMessage']['required'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['errorMessage']['required'] ?></div>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Enter your username:</label>
                <input id="username" name="username" type="text" class="form-control"
                    value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">

                <?php if (!empty($_SESSION['errorMessage']['invalidCredentials'])): ?>
                    <div class="text-danger"><?= $_SESSION['errorMessage']['invalidCredentials'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Enter your password:</label>
                <input id="password" name="password" type="password" class="form-control">

                <?php if (!empty($_SESSION['errorMessage']['password'])): ?>
                    <div class="text-danger"><?= $_SESSION['errorMessage']['password'] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn-primary">Log In</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-GLhlTQ8iRABY4d9J8+KnujsZ6Dk3+3BfJ5nF5qGp6T5Dbbt2lVgk5ZP6jFbS6HzF"
        crossorigin="anonymous"></script>
</body>

</html>