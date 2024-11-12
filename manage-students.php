<?php
session_start();
$showAlert = false;
$showError = false;
include "includes/connection.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fp1.css?version=51">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-100">
    <?php include "nav.php";?>
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center mb-6">Manage Students</h1>
        <h3 class="text-xl font-semibold mb-6">* View Students Info</h3>
        <table id="tableID" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll No.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reg Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tfoot class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll No.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reg Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </tfoot>
            <tbody class="bg-white divide-y divide-gray-200">
<?php
$sql = "SELECT student.Name, student.Roll_No, student.Reg_date, student.status, student.reg_id, branch.branch, semester.semester from student join branch on student.branch_id = branch.branch_id join semester on student.sem_id = semester.sem_id ";
$result = mysqli_query($conn, $sql);
$c = 1;
$num = mysqli_num_rows($result);
if($num > 0){
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $c;?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['Name'];?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['Roll_No'];?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['branch'];?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['semester'];?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['Reg_date'];?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php if($row['status'] == 1){
                echo "Active";
            }
            else{
                echo "Blocked";
            };?></td>
            <td class="px-6 py-4 whitespace-nowrap"><a href="edit-student.php?stid=<?php echo $row['reg_id'];?>" class="text-indigo-600 hover:text-indigo-900"><i class="fa fa-edit" title="Edit Record"></i></a></td>
        </tr>
        <?php
        $c++;
    }
}
?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#tableID').DataTable();
            });
        </script>
    </div>
</body>
</html>