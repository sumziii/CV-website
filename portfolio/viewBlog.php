<?php
session_start();
require_once 'db.php';

$result = $conn->query('SELECT * FROM posts');
$posts = [];

while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

$conn->close();

// Bubble sort by created_at, most recent first
$n = count($posts);
for ($i = 0; $i < $n - 1; $i++) {
    for ($j = 0; $j < $n - $i - 1; $j++) {
        if ($posts[$j]['created_at'] < $posts[$j + 1]['created_at']) {
            $temp = $posts[$j];
            $posts[$j] = $posts[$j + 1];
            $posts[$j + 1] = $temp;
        }
    }
}

// Group posts by month
$groupedPosts = [];
foreach ($posts as $post) {
    $monthKey = date('F Y', strtotime($post['created_at']));
    $groupedPosts[$monthKey][] = $post;
}

// Get selected month from dropdown
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : 'all';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Blog</title>
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
    <h1>My Blog</h1>
    <h4>Posts about my projects and what I learn during my Computer Science degree.</h4>
</header>

<main>
    <div class="container">
        <section>

            <!-- Month filter dropdown -->
            <div class="month-filter">
                <form action="viewBlog.php" method="GET">
                    <label for="month">Filter by month:</label>
                    <select name="month" id="month">
                        <option value="all" <?php echo $selectedMonth === 'all' ? 'selected' : ''; ?>>All Posts</option>
                        <?php foreach ($groupedPosts as $month => $monthPosts): ?>
                            <option value="<?php echo htmlspecialchars($month); ?>" <?php echo $selectedMonth === $month ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($month); ?> (<?php echo count($monthPosts); ?> posts)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Go</button>
                </form>
            </div>

            <?php
            // Filter posts based on selected month
            $filteredPosts = [];
            if ($selectedMonth === 'all') {
                $filteredPosts = $posts;
            } else {
                foreach ($posts as $post) {
                    $monthKey = date('F Y', strtotime($post['created_at']));
                    if ($monthKey === $selectedMonth) {
                        $filteredPosts[] = $post;
                    }
                }
            }
            ?>

            <?php if (empty($filteredPosts)): ?>
                <article>
                    <p>No blog posts found.</p>
                </article>
            <?php else: ?>
                <?php foreach ($filteredPosts as $post): ?>
                    <article class="blog-post-entry">
                        <p class="post-date">🕐 <?php echo date('jS F Y, g:i A', strtotime($post['created_at'])); ?> UTC</p>
                        <h2 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                        <p class="post-body"><?php echo htmlspecialchars($post['body']); ?></p>
                        <hr>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <p><a href="addEntry.php">+ Add Post</a></p>
            <?php else: ?>
                <p><a href="login.php">+ Add Post</a></p>
            <?php endif; ?>

        </section>

        <aside>
            <h3>Related</h3>
            <p>Check out my other projects on the <a href="portfolio.html">Projects page</a>.</p>
        </aside>
    </div>
</main>

<footer>
    <p>© 2026 Sumaiya Sajid</p>
</footer>

</body>
</html>