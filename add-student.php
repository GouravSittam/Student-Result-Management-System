<?php
session_start();
$showAlert = false;
$showError = false;
include "includes/connection.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
else{
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fullname = $_POST['fullname'];
        $rollno = $_POST['rollno'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $dob = $_POST['birthDate'];
        $branch = $_POST['branch'];
        $sem = $_POST['semester'];
        $status = 1;
        $addsql = "INSERT INTO `student` (`Name`, `Roll_No`, `Email`, `Gender`, `DOB`, `branch_id`, `Reg_date`, `sem_id`, `status`) VALUES ('$fullname','$rollno', '$email', '$gender', '$dob', '$branch', current_timestamp(), '$sem', '$status') ";
        $result = mysqli_query($conn, $addsql);
        if($result){
            $showAlert = true;
        }
        else{
            $showError = true;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Add Students</title>
</head>
<body class="bg-gray-100">
<?php include "nav.php"; ?>
<?php
    if($showAlert){
        echo '<script>alert("Record Added Successfully!")</script>';
    }
    if($showError){
        echo '<script>alert("Error! Try Again.")</script>';
    }
?>
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <form method="post">
        <h2 class="text-2xl font-bold text-center mb-6">Add Student Details</h2>
        <div class="space-y-4">
            <div>
                <label for="fullname" class="block text-lg font-medium text-gray-700">Full name</label>
                <input name="fullname" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div>
                <label for="rollno" class="block text-lg font-medium text-gray-700">Roll No</label>
                <input name="rollno" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div>
                <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div>
                <span class="block text-lg font-medium text-gray-700">Gender</span>
                <div class="mt-2 space-x-4">
                    <label><input type="radio" name="gender" value="Male" class="mr-2"> Male</label>
                    <label><input type="radio" name="gender" value="Female" class="mr-2"> Female</label>
                    <label><input type="radio" name="gender" value="Other" class="mr-2"> Other</label>
                </div>
            </div>
            <div>
                <label for="birthDate" class="block text-lg font-medium text-gray-700">DOB</label>
                <input type="date" name="birthDate" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div>
                <label for="branch" class="block text-lg font-medium text-gray-700">Branch</label>
                <select name="branch" id="branch" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select Branch</option>
                    <?php 
                    $sql = "SELECT * from `branch`";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['branch'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="semester" class="block text-lg font-medium text-gray-700">Semester</label>
                <select name="semester" id="semester" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select Semester</option>
                    <?php 
                    $sql = "SELECT * from `semester`";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <option value="<?php echo $row['sem_id']; ?>"><?php echo $row['semester'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="mt-6 text-right">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add</button>
        </div>
    </form>
</div>
</body>
</html>