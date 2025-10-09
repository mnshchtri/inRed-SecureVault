<?php
session_start();
include 'config/db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Vulnerability: SQL Injection
    // The input is not sanitized before being used in the query.
    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $post = $result->fetch_assoc();
    } else {
        echo "Post not found.";
        exit;
    }
} else {
    echo "No post ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?> - SecureVault X</title>
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
<body class="bg-gray-100 text-gray-800">
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

    <main class="container mx-auto px-4 md:px-6 py-32">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h2 class="text-2xl md:text-3xl font-bold mb-4"><?php echo $post['title']; ?></h2>
            <p class="text-gray-600 mb-8">By <?php echo $post['author']; ?> on <?php echo date('F j, Y', strtotime($post['created_at'])); ?></p>
            <div class="prose lg:prose-xl max-w-none">
                <?php echo nl2br($post['content']); ?>
            </div>
            <div class="mt-8">
                <a href="blog.php" class="text-red-600 hover:underline">&larr; Back to Blog</a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/4 mb-8 md:mb-0">
                    <a href="index.php">
                        <img src="images/logo.png" alt="SecureVault X Logo" class="h-16 mb-4">
                    </a>
                    <p class="text-gray-400">Your trusted partner in data security.</p>
                </div>
                <div class="w-full md:w-1/4 mb-8 md:mb-0">
                    <h4 class="text-lg font-bold mb-4">Links</h4>
                    <ul>
                        <li class="mb-2"><a href="#about" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li class="mb-2"><a href="#services" class="text-gray-400 hover:text-white">Services</a></li>
                        <li class="mb-2"><a href="#testimonials" class="text-gray-400 hover:text-white">Testimonials</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-8 md:mb-0">
                    <h4 class="text-lg font-bold mb-4">Follow Us</h4>
                    <ul>
                        <li class="mb-2"><a href="#" class="text-gray-400 hover:text-white">Twitter</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-400 hover:text-white">LinkedIn</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-400 hover:text-white">GitHub</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4">
                    <h4 class="text-lg font-bold mb-4">Subscribe</h4>
                    <p class="text-gray-400 mb-4">Stay up to date with our latest news and offers.</p>
                    <form>
                        <div class="flex">
                            <input type="email" class="w-full px-3 py-2 border rounded-l-lg text-gray-700 focus:outline-none focus:border-red-500" placeholder="Your Email">
                            <button type="submit" class="bg-red-600 text-white font-bold py-2 px-4 rounded-r-lg hover:bg-red-700">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8 text-center">
                <p>&copy; 2025 SecureVault X. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>