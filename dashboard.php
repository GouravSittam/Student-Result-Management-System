<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
include "includes/connection.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>
  <body class="bg-gray-100">
    <?php include "nav.php"; ?>
    <div class="container mx-auto p-4">
      <h1 class="text-4xl font-bold text-center my-4">Welcome Admin!</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="manage-students.php" class="no-underline">
          <div class="bg-gradient-to-r from-red-800 to-red-500 rounded-lg border-2 border-red-800 p-8 text-white text-center h-48">
            No. of Students
            <p id="s1" class="text-2xl mt-2"></p>
          </div>
        </a>
        <a href="manage-sem.php" class="no-underline">
          <div class="bg-gradient-to-r from-blue-900 to-blue-500 rounded-lg border-2 border-blue-900 p-8 text-white text-center h-48">
            Semesters listed
            <p id="s2" class="text-2xl mt-2"></p>
          </div>
        </a>
        <a href="manage-branch.php" class="no-underline">
          <div class="bg-gradient-to-r from-green-800 to-green-500 rounded-lg border-2 border-green-800 p-8 text-white text-center h-48">
            Branches listed
            <p id="s3" class="text-2xl mt-2"></p>
          </div>
        </a>
        <a href="manage-subjects.php" class="no-underline">
          <div class="bg-gradient-to-r from-yellow-800 to-yellow-500 rounded-lg border-2 border-yellow-800 p-8 text-white text-center h-48">
            Subjects listed
            <p id="s4" class="text-2xl mt-2"></p>
          </div>
        </a>
        <a href="manage-results.php" class="no-underline">
          <div class="bg-gradient-to-r from-purple-800 to-purple-500 rounded-lg border-2 border-purple-800 p-8 text-white text-center h-48">
            Results declared
            <p id="s5" class="text-2xl mt-2"></p>
          </div>
        </a>
      </div>
    </div>
    <script>
      function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
          if (!startTimestamp) startTimestamp = timestamp;
          const progress = Math.min((timestamp - startTimestamp) / duration, 1);
          obj.innerHTML = Math.floor(progress * (end - start) + start);
          if (progress < 1) {
            window.requestAnimationFrame(step);
          }
        };
        window.requestAnimationFrame(step);
      }

      const obj = document.getElementById("s1");
      const obj1 = document.getElementById("s2");
      const obj2 = document.getElementById("s3");
      const obj3 = document.getElementById("s4");
      const obj4 = document.getElementById("s5");

      <?php
        $sql1 = "SELECT reg_id from student";
        $result1 = mysqli_query($conn,$sql1);
        $num1 = mysqli_num_rows($result1);

        $sql2 = "SELECT sem_id from semester";
        $result2 = mysqli_query($conn,$sql2);
        $num2 = mysqli_num_rows($result2);

        $sql3 = "SELECT branch_id from branch";
        $result3 = mysqli_query($conn,$sql3);
        $num3 = mysqli_num_rows($result3);

        $sql4 = "SELECT subj_id from subjects";
        $result4 = mysqli_query($conn,$sql4);
        $num4 = mysqli_num_rows($result4);

        $sql5 = "SELECT distinct roll_no from results";
        $result5 = mysqli_query($conn,$sql5);
        $num5 = mysqli_num_rows($result5);
      ?>
      animateValue(obj, 0, <?php echo $num1; ?>, 800);
      animateValue(obj1, 0, <?php echo $num2; ?>, 800);
      animateValue(obj2, 0, <?php echo $num3; ?>, 800);
      animateValue(obj3, 0, <?php echo $num4; ?>, 800);
      animateValue(obj4, 0, <?php echo $num5; ?>, 800);
    </script>
  </body>
</html>