<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SecureVault X</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .glassy-nav {
            background-color: #1f2937;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800" style="background-image: url('images/register-bg.png'); background-size: cover; background-position: center;">
    <main class="flex items-center justify-center h-screen px-4">
        <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
            <div class="flex justify-between items-center mb-6">
                <a href="index.php" class="text-gray-600 hover:text-red-600">Home</a>
                <a href="login.php" class="text-gray-600 hover:text-red-600">Login</a>
            </div>
            <h2 class="text-2xl font-bold mb-6 text-center">Create Your SecureVault X Account</h2>
            <?php if(isset($_GET['error'])) : ?>
                <p class="text-center mb-4 text-red-500"><?php echo $_GET['error']; ?></p>
            <?php endif; ?>
            <?php if(isset($_GET['message'])) : ?>
                <p class="text-center mb-4 text-green-500"><?php echo $_GET['message']; ?></p>
            <?php endif; ?>
            <form method="post" action="register_auth.php">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500" required>
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500" required>
                </div>
                <button type="submit" class="w-full bg-red-600 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700">Register</button>
            </form>
        </div>
    </main>
</body>
</html>