<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: #FF0000;
        }

        .ast {
            color: red;
        }

        h1 {
            text-align: center;
        }

        label {
            width: 150px;
            display: inline-block;
            text-align: right;
        }

        input {
            width: 200px;
            display: inline-block;
        }

        input[type="submit"] {
            margin-left: 150px;
        }

        input[type="text"] {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 6px 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        form {
            border: 3px solid #f1f1f1;
            width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <h1>Delete a record</h1>
    <?php

    $regnoErr = "";
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the regno value from the form
        if (empty($_POST["regno"])) {
            $regnoErr = "Registration number is required";
        } else {
            $regno = test_input($_POST["regno"]);
            // check if registration number is valid
            if (!preg_match("/^[0-9]{2}[A-Za-z]{3}[0-9]{4}$/", $regno)) {
                $regnoErr = "Invalid registration number format";
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($regnoErr == "" && isset($_POST['submit'])) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lab9";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM student WHERE regno = '$regno'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record deleted successfully')</script>";
        } else {
            echo "<script>alert('Error deleting record')</script>";
        }
        $conn->close();
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="regno">Registration Number:<span class="ast">*</span></label>
        <input type="text" name="regno" id="regno">
        <span class="error"><?php echo $regnoErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Delete">
    </form>

</body>

</html>