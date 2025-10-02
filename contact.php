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
    <title>Contact Us - InRed SecureVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .glassy-nav {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="fixed top-0 left-0 right-0 z-20 glassy-nav shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php">
                <img src="images/logo.png" alt="InRed SecureVault Logo" class="h-16">
            </a>
            <div>
                <a href="index.php" class="px-4 text-gray-800 hover:text-red-600">Home</a>
                <a href="contact.php" class="px-4 text-gray-800 hover:text-red-600">Contact</a>
                <?php if(isset($_SESSION['username'])) : ?>
                    <a href="profile.php" class="px-4 text-gray-800 hover:text-red-600">Profile</a>
                    <a href="logout.php" class="px-4 text-gray-800 hover:text-red-600">Logout</a>
                <?php else : ?>
                    <a href="login.php" class="px-4 text-gray-800 hover:text-red-600">Login</a>
                    <a href="register.php" class="px-4 text-gray-800 hover:text-red-600">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-32">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-8">
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

    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/4 mb-8 md:mb-0">
                    <a href="index.php">
                        <img src="images/logo.png" alt="InRed SecureVault Logo" class="h-16 mb-4">
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
                <p>&copy; 2025 InRed SecureVault. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>