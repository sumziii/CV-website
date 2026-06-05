<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>My Portfolio</title>
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
    <h1>Sumaiya Sajid</h1>
    <h3>Computer Science Student Portfolio</h3>
</header>

<main>
    <div class="container">
        <section>
            <article>
                <h2>About Me</h2>
                <div class="about-container">
                    <figure>
                        <img src="images/profile.jpg" alt="Profile Photo" width="200">
                        <figcaption>My profile photo</figcaption>
                    </figure>
                    <div class="about-text">
                        <p>I am a Computer Science student interested in software development, web development, and problem solving. Throughout my degree I have worked on multiple projects that helped me develop strong programming and analytical skills.</p>
                    </div>
                </div>
            </article>

            <article class="blog-preview">
                <h2>Latest Blog Post</h2>
                <?php
                require_once 'db.php';
                $result = $conn->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 1');
                $post = $result->fetch_assoc();
                if ($post): ?>
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($post['body'], 0, 150)) . '...'; ?></p>
                    <a href="viewBlog.php">Read More →</a>
                <?php else: ?>
                    <p>No blog posts yet.</p>
                <?php endif; ?>
            </article>
        </section>

        <aside>
            <h3>Related</h3>
            <ul>
                <li><a href="skills.html">My Skills</a></li>
                <li><a href="education.html">My Education</a></li>
            </ul>
        </aside>
    </div>
</main>

<footer>
    <p>© 2026 Sumaiya Sajid</p>
</footer>

</body>
</html>