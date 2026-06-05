<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Blog Entry</title>
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
        <li><a href="addEntry.php">Add Blog Entry</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</nav>

<header>
    <h1>Add Blog Entry</h1>
    <p>Welcome, <?php echo $_SESSION['email']; ?></p>
</header>

<main>
    <div class="form-container">
        <form id="blogForm" action="addPost.php" method="POST">

            <label for="title">Blog Title:</label>
            <input type="text" id="title" name="title">

            <label for="content">Blog Content:</label>
            <textarea id="content" name="content" rows="8"></textarea>

            <p class="error-message" id="titleError" style="display:none;">Please enter a title.</p>
            <p class="error-message" id="contentError" style="display:none;">Please enter some content.</p>

            <button type="submit">Post</button>
            <button type="button" id="clearBtn">Clear</button>

        </form>
    </div>
</main>

<footer>
    <p>© 2026 Sumaiya Sajid</p>
</footer>

<script src="js/addEntry.js"></script>

</body>
</html>