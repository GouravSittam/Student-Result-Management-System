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
    <title>SRMS</title>
    <link rel="shortcut icon" href="sample/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-900 text-white p-4 text-center text-xl">
      Lovely Professional University, Punjab
    </nav>

    <div class="flex flex-col md:flex-row justify-center items-center mt-10">
      <div class="bg-white shadow-lg rounded-lg p-8 m-4 w-full md:w-1/3">
         <div class="text-2xl font-bold border-b-2 border-gray-300 pb-4 mb-4">
            For Students
         </div>
         <div class="mt-8">
            <label for="click" class="text-xl">Search your result:</label>
            <a href="find-result.php" class="block mt-4 bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700">Click here</a>
         </div>
      </div>
        
      <div class="bg-white shadow-lg rounded-lg p-8 m-4 w-full md:w-1/3">
        <form action="" method="post">
          <div class="text-2xl font-bold border-b-2 border-gray-300 pb-4 mb-4">
            Admin Login
          </div>
          <div class="mt-8">
            <label for="username" class="block text-lg">Username</label>
            <input type="text" id="username" name="username" required class="w-full p-2 border border-gray-300 rounded mt-2">
          </div>
          <div class="mt-4">
            <label for="password" class="block text-lg">Password</label>
            <input type="password" id="password" name="password" required class="w-full p-2 border border-gray-300 rounded mt-2">
          </div>
          <div class="mt-6">
            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Login</button>
          </div>
        </form>
      </div>
    </div>
</body>
</html>