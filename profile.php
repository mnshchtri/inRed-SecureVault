<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['username'])){
    header("location: login.php");
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $email = $row['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - SecureVault X</title>
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
<body class="bg-gray-100 text-gray-800" style="background-image: url('images/profile-bg.png'); background-size: cover; background-position: center;">
    <header class="fixed top-0 left-0 right-0 z-20 glassy-nav shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php">
                <img src="images/logo.png" alt="SecureVault X Logo" class="h-12 md:h-16">
            </a>
            <div class="hidden md:flex items-center space-x-4">
                <a href="index.php" class="px-4 text-gray-800 hover:text-red-600">Home</a>
                <?php if(isset($_SESSION['username'])) : ?>
                    <a href="filestorage.php" class="px-4 text-gray-800 hover:text-red-600">File Storage</a>
                    <a href="profile.php" class="px-4 text-gray-800 hover:text-red-600">Profile</a>
                <a href="logout.php" class="px-4 text-gray-800 hover:text-red-600">Logout</a>
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
            <?php if(isset($_SESSION['username'])) : ?>
                <a href="filestorage.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">File Storage</a>
                <a href="profile.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Profile</a>
                <a href="logout.php" class="block px-4 py-2 text-gray-800 hover:bg-red-100">Logout</a>
            <?php endif; ?>
        </div>
    </header>

    <main class="container mx-auto px-4 md:px-6 py-32">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <h2 class="text-2xl md:text-3xl font-bold mb-6 text-center text-gray-800">User Profile</h2>

            <?php
            $message = '';
            $error = '';

            // Handle profile update
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
                $new_username = $_POST['username'];
                $new_email = $_POST['email'];

                // Sanitize inputs
                $new_username = htmlspecialchars($new_username, ENT_QUOTES, 'UTF-8');
                $new_email = htmlspecialchars($new_email, ENT_QUOTES, 'UTF-8');

                // Update database
                $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE username = ?");
                $stmt->bind_param("sss", $new_username, $new_email, $_SESSION['username']);

                if ($stmt->execute()) {
                    $_SESSION['username'] = $new_username; // Update session username if changed
                    $message = "Profile updated successfully!";
                } else {
                    $error = "Error updating profile: " . $stmt->error;
                }
                $stmt->close();
            }

            // Handle profile picture upload
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_picture'])) {
                if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]['error'] == UPLOAD_ERR_OK) {
                    $target_dir = "uploads/profile_pictures/";
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $error = "File is not an image.";
                        $uploadOk = 0;
                    }

                // Check file size
                if ($_FILES["profile_picture"]["size"] > 2000000) { // 2MB
                    $error = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $error = "Sorry, your file was not uploaded." . $error;
                } else {
                    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                        // Update database with profile picture path
                        $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE username = ?");
                        $stmt->bind_param("ss", $target_file, $_SESSION['username']);
                        if ($stmt->execute()) {
                            $message = "The file ". htmlspecialchars( basename( $_FILES["profile_picture"]["name"])). " has been uploaded.";
                        } else {
                            $error = "Error updating profile picture path: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $error = "No file uploaded or an upload error occurred.";
        }
            }

            // Re-fetch user data after potential updates
            $stmt = $conn->prepare("SELECT username, email, profile_picture FROM users WHERE username = ?");
            $stmt->bind_param("s", $_SESSION['username']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
                $profile_picture = htmlspecialchars($row['profile_picture'], ENT_QUOTES, 'UTF-8');
            } else {
                // Handle case where user is not found (shouldn't happen if session is set)
                $error = "User data not found.";
                $username = '';
                $email = '';
                $profile_picture = 'images/default-profile.png';
            }
            $stmt->close();

            if ($message) {
                echo "<p class=\"text-center mb-4 text-green-500\">" . $message . "</p>";
            }
            if ($error) {
                echo "<p class=\"text-center mb-4 text-red-500\">" . $error . "</p>";
            }
            ?>

            <div class="flex flex-col items-center mb-8">
                <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-red-600 shadow-lg">
                <h3 class="text-2xl font-semibold text-gray-700"><?php echo $username; ?></h3>
                <p class="text-gray-500"><?php echo $email; ?></p>
            </div>

            <div class="mb-8">
                <h4 class="text-xl font-bold mb-4 text-gray-700">Update Profile Picture</h4>
                <form action="profile.php" method="post" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="profile_picture" class="block text-gray-700 font-bold mb-2">Select new profile picture:</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
                    </div>
                    <button type="submit" name="upload_picture" class="w-full bg-red-600 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700 transition duration-300">Upload Picture</button>
                </form>
            </div>

            <div>
                <h4 class="text-xl font-bold mb-4 text-gray-700">Edit Account Information</h4>
                <form action="profile.php" method="post" class="space-y-4">
                    <div>
                        <label for="username_edit" class="block text-gray-700 font-bold mb-2">Username</label>
                        <input type="text" id="username_edit" name="username" value="<?php echo $username; ?>" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500" required>
                    </div>
                    <div>
                        <label for="email_edit" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email_edit" name="email" value="<?php echo $email; ?>" class="w-full px-3 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500" required>
                    </div>
                    <button type="submit" name="update_profile" class="w-full bg-red-600 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700 transition duration-300">Update Information</button>
                </form>
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