<?php
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'da3';
$conn = mysqli_connect($server, $user, $password, $database);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
$sql = "SELECT * FROM `code1`";
$result = mysqli_query($conn, $sql);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['marks']))
        $sql = "UPDATE `code1` SET `marks` = '90' WHERE `first_name` = 'Swati'";
    if (isset($_POST['name']))
        $sql = "UPDATE `code1` SET `last_name` = 'Anderson' WHERE `first_name` =
'James'";

    if (isset($_POST['delete']))
        $sql = "DELETE FROM `code1` WHERE `first_name` = 'Chetna'";
    $result = mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-
alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Records</h1>
        <?php
        if ($result && (mysqli_num_rows($result) > 0)) {
            echo '
 <table class="table table-responsive">
 <thead>
 <tr>
 <th scope="col">S.No.</th>
 <th scope="col">First Name</th>
 <th scope="col">Last Name</th>
 <th scope="col">Marks</th>
 </tr>
 </thead>
 <tbody>
 ';
            $i = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                echo '
 <tr>
 <th scope="row">' . $i++ . '</th>
 <td>' . $row["first_name"] . '</td>
 <td>' . $row["last_name"] . '</td>
 <td>' . $row["marks"] . '</td>
 </tr>';
            }
            echo '
 </tbody>
 </table>';
        } else {
            echo '<p class="text-center">No records found</p>';
        }
        ?>
    </div>
    <form action="" method="POST" class="container d-flex justify-content-start 
align-items-center">
        <button class="btn btn-primary" type="submit" name="marks">Update
            Marks</button>
        <button class="btn btn-primary mx-3" type="submit" name="name">Update
            Name</button>
        <button class="btn btn-danger" type="submit" name="delete">Delete
            Entry</button>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-
alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-
ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>