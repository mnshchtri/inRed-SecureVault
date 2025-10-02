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
                <a href="filestorage.php" class="px-4 text-gray-800 hover:text-red-600">File Storage</a>
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

    <main>
        <section class="relative h-screen flex items-center justify-center text-white" style="background-image: url('images/hero-bg.png'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-5xl font-extrabold mb-4">Secure Your Digital World</h1>
                <p class="text-xl mb-8">Leading the industry in proactive threat detection and response.</p>
                <a href="#services" class="bg-red-600 text-white font-bold py-3 px-6 rounded-full hover:bg-red-700 transition duration-300">Explore Our Solutions</a>
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
                        <p class="text-gray-600 leading-relaxed">Founded in 2010, InRed SecureVault has been a leader in the cybersecurity industry for over a decade. We are a team of passionate security professionals dedicated to making the digital world a safer place. Our mission is to provide our clients with the most advanced and effective security solutions available.</p>
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
                <h2 class="text-4xl font-bold text-center mb-12">Our Services</h2>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                            <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <h3 class="text-2xl font-bold mb-2">Cloud Security</h3>
                            <p class="text-gray-600">Comprehensive security for your cloud infrastructure.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                            <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <h3 class="text-2xl font-bold mb-2">Penetration Testing</h3>
                            <p class="text-gray-600">Simulating real-world attacks to find vulnerabilities.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                            <svg class="w-16 h-16 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7c0-1.1.9-2 2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <h3 class="text-2xl font-bold mb-2">Security Audits</h3>
                            <p class="text-gray-600">Ensuring your systems meet industry security standards.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-12">What Our Clients Say</h2>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-gray-50 rounded-lg shadow-lg p-8">
                            <img src="images/testimonial.png" alt="Client Testimonial" class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg">
                            <blockquote class="text-lg text-gray-600 italic text-center">
                                <p>"InRed SecureVault has been an invaluable partner in securing our critical data. Their expertise and dedication are second to none."</p>
                            </blockquote>
                            <p class="mt-4 font-bold text-center">- John Doe, CEO of a Fortune 500 Company</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-gray-50 rounded-lg shadow-lg p-8">
                            <img src="images/testimonial.png" alt="Client Testimonial" class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg">
                            <blockquote class="text-lg text-gray-600 italic text-center">
                                <p>"The team at InRed is professional, knowledgeable, and always goes the extra mile to ensure our systems are secure."</p>
                            </blockquote>
                            <p class="mt-4 font-bold text-center">- Jane Smith, CTO of a Tech Startup</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-gray-50 rounded-lg shadow-lg p-8">
                            <img src="images/testimonial.png" alt="Client Testimonial" class="w-24 h-24 rounded-full mx-auto mb-4 shadow-lg">
                            <blockquote class="text-lg text-gray-600 italic text-center">
                                <p>"I can't recommend InRed SecureVault enough. They are the best in the business."</p>
                            </blockquote>
                            <p class="mt-4 font-bold text-center">- Peter Jones, IT Manager at a Financial Institution</p>
                        </div>
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