# CV Website

A personal portfolio website built with HTML, CSS, JavaScript and PHP, connected to a MySQL database via XAMPP.

## Pages

- **Home** — intro and latest blog post preview
- **Skills** — technical skills and achievements
- **Education** — visual timeline of education history
- **Portfolio** — projects showcase
- **Blog** — all posts, sortable by month
- **Contact** — contact details and links
- **Login** — admin login to access blog management

## Features

- Session-based login system (SHA-256 password hashing)
- Authenticated users can add blog posts via a protected page
- Blog posts stored in MySQL and sorted by date using bubble sort
- Month filter dropdown on the blog page
- Client-side form validation with JavaScript
- Responsive design for mobile screens

## Tech Stack

HTML, CSS, JavaScript, PHP, MySQL

## Getting Started

**Requirements:** XAMPP (or any local server with PHP and MySQL)

1. Clone or download the repository into your XAMPP `htdocs` folder
2. Start Apache and MySQL in the XAMPP Control Panel
3. Open phpMyAdmin and create a database called `portfolio`
4. Create the required tables:

```sql
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  body TEXT,
  created_at DATETIME
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255),
  password VARCHAR(64)
);
```

5. Insert a user with a SHA-256 hashed password:

```sql
INSERT INTO users (email, password)
VALUES ('your@email.com', SHA2('yourpassword', 256));
```

6. Open `http://localhost/[your-folder-name]` in your browser

## File Structure

```
/
├── index.php           # Home page (PHP, shows latest blog post)
├── index.html          # Static version of home page
├── skills.html         # Skills and achievements
├── education.html      # Education timeline
├── portfolio.html      # Projects showcase
├── contact.html        # Contact information
├── login.php           # Login page
├── loginProcess.php    # Handles login authentication
├── logout.php          # Destroys session and redirects
├── addEntry.php        # Add blog post (protected, login required)
├── addPost.php         # Handles blog post form submission
├── viewBlog.php        # Displays all blog posts with month filter
├── db.php              # Database connection
├── js/
│   └── addEntry.js     # Client-side form validation
└── css/
    ├── style.css        # Main stylesheet
    └── reset.css        # CSS reset
```

## Author

Sumaiya Sajid
