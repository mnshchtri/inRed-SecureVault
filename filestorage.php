<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config/db.php';

if(!isset($_SESSION['username'])){
    header("location: login.php");
    exit();
}

$message = '';
$error = '';

// Get current user's ID
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];
$stmt->close();

// Handle file upload
if(isset($_POST['upload'])){
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $original_filename = basename($_FILES["fileToUpload"]["name"]);
    $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
    $unique_filename = uniqid() . "." . $file_extension; // Generate a unique filename
    $target_file = $target_dir . $unique_filename;

    // Basic file type validation (can be enhanced)
    $allowed_extensions = array("jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "txt");
    if (!in_array(strtolower($file_extension), $allowed_extensions)) {
        $error = "<p class='text-red-500'>Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, DOCX, & TXT files are allowed.</p>";
    } else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Store file info in database
        $stmt = $conn->prepare("INSERT INTO files (user_id, filename, filepath) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $original_filename, $target_file);
        if ($stmt->execute()) {
            $message = "<p class='text-green-500'>The file ". htmlspecialchars($original_filename). " has been uploaded.</p>";
        } else {
            $error = "<p class='text-red-500'>Error saving file info to database: " . $stmt->error . "</p>";
            unlink($target_file); // Delete uploaded file if DB insert fails
        }
        $stmt->close();
    } else {
        $error = "<p class='text-red-500'>Sorry, there was an error uploading your file.</p>";
    }
}

// Handle file deletion
if(isset($_GET['delete']) && isset($_GET['file_id'])){
    $file_id = $_GET['file_id'];

    // Fetch file details from database
    $stmt = $conn->prepare("SELECT filepath FROM files WHERE id = ?");
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $file_to_delete = $result->fetch_assoc();
        $filepath = $file_to_delete['filepath'];

        // Delete from filesystem
        if(file_exists($filepath) && unlink($filepath)){
            // Delete from database
            $stmt_delete = $conn->prepare("DELETE FROM files WHERE id = ?");
            $stmt_delete->bind_param("i", $file_id);
            if($stmt_delete->execute()){
                $message = "<p class='text-green-500'>File deleted successfully.</p>";
            } else {
                $error = "<p class='text-red-500'>Error deleting file info from database: " . $stmt_delete->error . "</p>";
            }
            $stmt_delete->close();
        } else {
            $error = "<p class='text-red-500'>Error deleting file from server.</p>";
        }
    } else {
        $error = "<p class='text-red-500'>File not found or you don't have permission to delete it.</p>";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Storage - SecureVault X</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
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
<body class="bg-gray-100 text-gray-800" style="background-image: url('images/filestorage.png'); background-size: cover; background-position: center;">
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
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-2xl p-6 md:p-10 space-y-10 border border-gray-200">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-center text-gray-800">Your Secure File Storage</h2>
            <p class="text-center text-md md:text-lg text-gray-600 mb-8">Upload and manage your personal files securely. We support JPG, JPEG, PNG, GIF, PDF, DOC, DOCX, & TXT files.</p>

            <?php 
            if ($message) { echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>" . $message . "</div>"; }
            if ($error) { echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>" . $error . "</div>"; }
            ?>

            <!-- File Upload Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
                <h3 class="text-2xl font-bold mb-5 text-gray-700">Upload New File</h3>
                <form method="post" action="filestorage.php" enctype="multipart/form-data" class="space-y-6">
                    <div>
                        <label for="fileToUpload" class="block text-lg font-medium text-gray-700 mb-2">Select file to upload:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="block w-full text-sm text-gray-900
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-red-50 file:text-red-700
                            hover:file:bg-red-100
                            cursor:pointer focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            required>
                    </div>
                    <button type="submit" name="upload" class="w-full bg-red-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-red-700 transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">Upload File</button>
                </form>
            </div>

            <!-- Uploaded Files List Section -->
            <div class="pt-8">
                <h3 class="text-2xl font-bold mb-5 text-gray-700">Your Uploaded Files</h3>
                <ul class="divide-y divide-gray-200 border border-gray-200 rounded-lg bg-white shadow-sm">
                    <?php
                        $stmt = $conn->prepare("SELECT id, filename, filepath, upload_time FROM files WHERE user_id = ? ORDER BY upload_time DESC");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $files_result = $stmt->get_result();

                        if($files_result->num_rows > 0){
                            while($file = $files_result->fetch_assoc()){
                                echo "<li class='p-4 flex flex-col md:flex-row items-start md:items-center justify-between hover:bg-gray-50 transition duration-150 ease-in-out'>";
                                echo "    <div class='flex-1 min-w-0 mb-4 md:mb-0'>";
                                echo "        <p class='text-lg font-medium text-gray-900 truncate'>" . htmlspecialchars($file['filename']) . "</p>";
                                echo "        <p class='text-sm text-gray-500'>Uploaded: " . date("M d, Y H:i", strtotime($file['upload_time'])) . "</p>";
                                echo "    </div>";
                                echo "    <div class='ml-0 md:ml-4 flex-shrink-0 flex space-x-3 w-full md:w-auto'>";
                                echo "        <a href='" . htmlspecialchars($file['filepath']) . "' class='flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out'>View</a>";
                                echo "        <a href='filestorage.php?delete=true&file_id=" . $file['id'] . "' class='flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out' onclick=\"return confirm('Are you sure you want to delete this file?');\">Delete</a>";
                                echo "    </div>";
                                echo "</li>";
                            }
                        } else {
                            echo "<li class='py-4 text-gray-600 text-center'>No files uploaded yet.</li>";
                        }
                        $stmt->close();
                    ?>
                </ul>
            </div>
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