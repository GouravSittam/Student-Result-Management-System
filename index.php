<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'includes/connection.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
    $sql = "Select * from admin where username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password, $row['password'])){ 
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: dashboard.php");
            } 
            else{
                $showError = "Invalid Credentials";
            }
        }
    } 
    else{
        $showError = "Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRMS - Lovely Professional University</title>
    <link rel="shortcut icon" href="sample/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-image {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://media.glassdoor.com/l/01/ba/8f/bf/open-theatre.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        .marquee-custom {
            background: rgba(30, 58, 138, 0.9);
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="bg-image">
    <nav class="marquee-custom text-white p-4 text-center text-xl fixed w-full top-0 z-50">
        <marquee>
            Welcome to Lovely Professional University, Punjab - Student Result Management System
        </marquee> 
    </nav>

    <div class="flex min-h-screen pt-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-center items-center gap-8 my-8">
                <!-- Student Section -->
                <div class="glass-effect rounded-xl p-8 w-full md:w-1/3 transform hover:scale-105 transition-transform duration-300">
                    <div class="text-3xl font-bold text-blue-900 border-b-2 border-blue-200 pb-4 mb-6">
                        For Students
                    </div>
                    <div class="mt-8 space-y-6">
                        <p class="text-xl text-gray-700">Search your result:</p>
                        <a href="find-result.php" 
                           class="block text-xl bg-gradient-to-r from-green-600 to-green-700 text-white text-center py-3 px-6 rounded-lg hover:from-green-700 hover:to-green-800 transform hover:-translate-y-1 transition-all duration-300 shadow-lg">
                            Click here
                        </a>
                    </div>
                </div>
                
                <!-- Admin Login Section -->
                <div class="glass-effect rounded-xl p-8 w-full md:w-1/3 transform hover:scale-105 transition-transform duration-300">
                    <form action="" method="post">
                        <div class="text-3xl font-bold text-blue-900 border-b-2 border-blue-200 pb-4 mb-6">
                            Admin Login
                        </div>
                        <?php if($showError): ?>
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                <p><?php echo $showError; ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="space-y-6">
                            <div>
                                <label for="username" class="block text-xl text-gray-700 mb-2">Username</label>
                                <input type="text" id="username" name="username" required 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            </div>
                            <div>
                                <label for="password" class="block text-xl text-gray-700 mb-2">Password</label>
                                <input type="password" id="password" name="password" required 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            </div>
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white text-xl py-3 px-6 rounded-lg hover:from-blue-700 hover:to-blue-800 transform hover:-translate-y-1 transition-all duration-300 shadow-lg">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>