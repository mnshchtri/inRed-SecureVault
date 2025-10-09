<?php
session_start();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Vulnerability: Cross-Site Scripting (XSS)
    // The input is not sanitized before being displayed.
    $feedback = "<div class='mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg'>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Message:</strong> $message</p>
                </div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - SecureVault X</title>
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
<body class="bg-gray-100 text-gray-800" style="background-image: url('images/contact.png'); background-size: cover; background-position: center;">
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
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Contact Us</h2>
            <p class="text-center text-gray-600 mb-8">We'd love to hear from you. Please fill out the form below to get in touch.</p>
            <form method="post" action="">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500" required>
                </div>
                <div class="mb-6">
                    <label for="message" class="block text-gray-700 font-bold mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500" required></textarea>
                </div>
                <button type="submit" name="submit" class="w-full bg-red-600 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700">Send Message</button>
            </form>
            <?php if(isset($feedback)) echo $feedback; ?>
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