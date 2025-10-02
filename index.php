<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InRed SecureVault</title>
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
        </nav>
    </header>

    <main>
        <section class="relative h-screen flex items-center justify-center text-white" style="background-image: url('images/hero-bg.png'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-5xl font-extrabold mb-4">Securely Store Your Digital Assets</h1>
                <p class="text-xl mb-8">Upload, manage, and access your files with industry-leading security and ease.</p>
                <a href="filestorage.php" class="bg-red-600 text-white font-bold py-3 px-6 rounded-full hover:bg-red-700 transition duration-300">Start Uploading Now</a>
            </div>
        </section>

        <section id="about" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2">
                        <img src="images/about-us.png" alt="About Us" class="rounded-lg shadow-lg">
                    </div>
                    <div class="md:w-1/2 md:pl-12 mt-8 md:mt-0">
                        <h2 class="text-4xl font-bold mb-4">About InRed SecureVault</h2>
                        <p class="text-gray-600 leading-relaxed">Founded in 2010, InRed SecureVault has been a leader in providing robust and secure digital solutions. We are a team of passionate security professionals dedicated to safeguarding your valuable data. Our mission is to offer advanced and effective file storage solutions, ensuring your digital assets are always protected and accessible only to you.</p>
                    </div>
                </div>
                <div class="mt-20">
                    <h3 class="text-3xl font-bold text-center mb-12">Meet the Team</h3>
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full md:w-1/3 p-4 text-center">
                            <img src="images/team-member-1.png" alt="Team Member 1" class="w-32 h-32 rounded-full mx-auto mb-4 shadow-lg">
                            <h4 class="text-xl font-bold">John Doe</h4>
                            <p class="text-gray-600">CEO & Founder</p>
                        </div>
                        <div class="w-full md:w-1/3 p-4 text-center">
                            <img src="images/team-member-2.png" alt="Team Member 2" class="w-32 h-32 rounded-full mx-auto mb-4 shadow-lg">
                            <h4 class="text-xl font-bold">Jane Smith</h4>
                            <p class="text-gray-600">Head of Security</p>
                        </div>
                        <div class="w-full md:w-1/3 p-4 text-center">
                            <img src="images/team-member-3.png" alt="Team Member 3" class="w-32 h-32 rounded-full mx-auto mb-4 shadow-lg">
                            <h4 class="text-xl font-bold">Peter Jones</h4>
                            <p class="text-gray-600">Lead Penetration Tester</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-12">Our Secure Storage Solutions</h2>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                            <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <h3 class="text-2xl font-bold mb-2">Encrypted File Storage</h3>
                            <p class="text-gray-600">Store your documents, photos, and videos with advanced encryption, ensuring privacy and integrity.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                            <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <h3 class="text-2xl font-bold mb-2">Secure Access & Sharing</h3>
                            <p class="text-gray-600">Control who accesses your files with robust authentication and secure sharing options.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                            <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7c0-1.1.9-2 2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <h3 class="text-2xl font-bold mb-2">Data Backup & Recovery</h3>
                            <p class="text-gray-600">Automatic backups and easy recovery options ensure your data is never lost.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-12">Why Choose InRed SecureVault?</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gray-50 rounded-lg shadow-lg p-8 text-center">
                        <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <h3 class="text-2xl font-bold mb-2">Advanced Encryption</h3>
                        <p class="text-gray-600">Your data is protected with industry-leading encryption standards, ensuring maximum security.</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg shadow-lg p-8 text-center">
                        <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <h3 class="text-2xl font-bold mb-2">User-Friendly Interface</h3>
                        <p class="text-gray-600">Easily manage your files and profile with our intuitive and modern design.</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg shadow-lg p-8 text-center">
                        <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9h-3M12 21a9 9 0 01-9-9m9 9H8M12 3a9 9 0 00-9 9m9 0h-3m-6 0a9 9 0 019-9m-9 9h-3M12 3h8.25c.414 0 .75.336.75.75v1.5a.75.75 0 01-.75.75H3.75A.75.75 0 013 5.25v-1.5c0-.414.336-.75.75-.75H12zm-3 8.25H9.75a.75.75 0 00-.75.75v1.5c0 .414.336.75.75.75h1.5a.75.75 0 00.75-.75v-1.5a.75.75 0 00-.75-.75H9zm.75 0h-.75v-.75h.75v.75z"></path></svg>
                        <h3 class="text-2xl font-bold mb-2">Reliable Support</h3>
                        <p class="text-gray-600">Our dedicated support team is always ready to assist you with any queries or issues.</p>
                    </div>
                </div>
            </div>
        </section>
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
                        <li class="mb-2"><a href="#features" class="text-gray-400 hover:text-white">Features</a></li>
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