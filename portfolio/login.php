<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="skills.html">Skills</a></li>
        <li><a href="education.html">Education</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="viewBlog.php">Blog</a></li>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <li><a href="addEntry.php">Add Blog Entry</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</nav>

<header>
    <h1>Login</h1>
</header>

<main>
    <section>
        <div class="form-container">
            <form action="loginProcess.php" method="POST">

                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
                <?php endif; ?>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>

            </form>
        </div>
    </section>
</main>

<footer>
    <p>© 2026 Sumaiya Sajid</p>
</footer>

</body>
</html>