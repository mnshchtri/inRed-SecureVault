<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location: login.php");
}

$message = '';
if(isset($_POST['upload'])){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    // Vulnerability: File Upload
    // The code does not validate the file type or content, allowing any file to be uploaded.
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $message = "<p class='text-green-500'>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.</p>";
    } else {
        $message = "<p class='text-red-500'>Sorry, there was an error uploading your file.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Storage - InRed SecureVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php">
                <img src="images/logo.png" alt="InRed SecureVault Logo" class="h-12">
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

    <main class="container mx-auto px-6 py-12">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">File Storage</h2>
            <p class="text-center text-gray-600 mb-8">Upload your files here. Please note that for security reasons, we do not allow uploading executable files.</p>
            <?php echo $message; ?>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="fileToUpload" class="block text-gray-700 font-bold mb-2">Select file to upload:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
                </div>
                <button type="submit" name="upload" class="w-full bg-red-600 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700">Upload File</button>
            </form>

            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Uploaded Files:</h3>
                <ul>
                    <?php
                        $files = scandir("uploads");
                        foreach($files as $file){
                            if($file !== '.' && $file !== '..'){
                                echo "<li class='mb-2'><a href='uploads/$file' class='text-red-600 hover:underline'>$file</a></li>";
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/4 mb-8 md:mb-0">
                    <a href="index.php">
                        <img src="images/logo.png" alt="InRed SecureVault Logo" class="h-12 mb-4">
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