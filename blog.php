<?php
session_start();
include 'config/db.php';

$search_query = "";
if(isset($_GET['search'])){
    $search_query = $_GET['search'];
    // Vulnerability: SQL Injection
    // The input is not sanitized before being used in the query.
    $sql = "SELECT * FROM posts WHERE title LIKE '%$search_query%' OR content LIKE '%$search_query%'";
} else {
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - SecureVault X</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .glassy-nav {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800" style="background-image: url('images/blog-bg.png'); background-size: cover; background-position: center;">
    <header class="fixed top-0 left-0 right-0 z-20 glassy-nav shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php">
                <img src="images/logo.png" alt="SecureVault X Logo" class="h-12 md:h-16">
            </a>
            <div class="hidden md:flex items-center space-x-4">
                <a href="index.php" class="px-4 text-gray-800 hover:text-red-600">Home</a>
                <a href="blog.php" class="px-4 text-gray-800 hover:text-red-600">Blog</a>
                <a href="contact.php" class="px-4 text-gray-800 hover:text-red-600">Contact</a>
                <?php if(isset($_SESSION['username'])) : ?>
                    <a href="filestorage.php" class="px-4 text-gray-800 hover:text-red-600">File Storage</a>
                    <a href="profile.php" class="px-4 text-gray-800 hover:text-red-600">Profile</a>
                    <a href="logout.php" class="px-4 text-gray-800 hover:text-red-600">Logout</a>
                <?php else : ?>
                    <a href="login.php" class="px-4 text-gray-800 hover:text-red-600">Login</a>
                    <a href="register.php" class="px-4 text-gray-800 hover:text-red-600">Register</a>
                <?php endif; ?>
            </div>
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-800 hover:text-red-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </nav>
        <div id="mobile-menu" class="hidden md:hidden">
            <a href="index.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Home</a>
            <a href="blog.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Blog</a>
            <a href="contact.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Contact</a>
            <?php if(isset($_SESSION['username'])) : ?>
                <a href="filestorage.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">File Storage</a>
                <a href="profile.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Profile</a>
                <a href="logout.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Logout</a>
            <?php else : ?>
                <a href="login.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Login</a>
                <a href="register.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Register</a>
            <?php endif; ?>
        </div>
    </header>

    <main class="container mx-auto px-6 py-32">
        <h2 class="text-3xl font-bold text-center mb-8">Our Blog</h2>

        <div class="max-w-lg mx-auto mb-8 px-4">
            <form method="get" action="blog.php">
                <div class="flex">
                    <input type="text" name="search" class="w-full px-3 py-2 border rounded-l-lg text-gray-700 focus:outline-none focus:border-red-500" placeholder="Search blog posts..." value="<?php echo htmlspecialchars($search_query); ?>">
                    <button type="submit" class="bg-red-600 text-white font-bold py-2 px-4 rounded-r-lg hover:bg-red-700">Search</button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-bold mb-2"><?php echo $row['title']; ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo substr($row['content'], 0, 150); ?>...</p>
                        <a href="post.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:underline">Read More</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center col-span-3">No posts found.</p>
            <?php endif; ?>
        </div>
    </main>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>