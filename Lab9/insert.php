<!DOCTYPE html>
<html>

<head>
    <title>Student Registration Form</title>
</head>
<style>
    .error {
        color: #FF0000;
    }
    
    h2 {
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

<body>

    <h2>Student Registration Form</h2>

    <?php
    // define variables and set to empty values
    $regnoErr = $nameErr = $gpaErr = $emailErr = "";
    $regno = $name = $gpa = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["regno"])) {
            $regnoErr = "Registration number is required";
        } else {
            $regno = test_input($_POST["regno"]);
            // check if registration number is valid
            if (!preg_match("/^[0-9]{2}[A-Za-z]{3}[0-9]{4}$/", $regno)) {
                $regnoErr = "Invalid registration number format";
            }
        }

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name contains only letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["gpa"])) {
            $gpaErr = "GPA is required";
        } else {
            $gpa = test_input($_POST["gpa"]);
            // check if GPA is a number between 0 and 4
            if (!filter_var($gpa, FILTER_VALIDATE_FLOAT, array("options" => array("min_range" => 0, "max_range" => 10)))) {
                $gpaErr = "Invalid GPA";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if email address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
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

    if ($regnoErr == "" && $nameErr == "" && $gpaErr == "" && $emailErr == "" && isset($_POST['submit'])) {
        // insert the values into the table
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lab9";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO student (regno, name, gpa, email)
		VALUES ('$regno', '$name', '$gpa', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="regno">Registration Number:</label>
        <input type="text" id="regno" name="regno" value="<?php echo $regno; ?>">
        <span class="error">* <?php echo $regnoErr; ?></span>
        <br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>

        <label for="gpa">GPA:</label>
        <input type="text" id="gpa" name="gpa" value="<?php echo $gpa; ?>">
        <span class="error">* <?php echo $gpaErr; ?></span>
        <br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>

        <input type="submit" name="submit" value="Submit">
    </form>