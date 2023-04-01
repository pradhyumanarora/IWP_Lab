<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // If not, redirect to the login page
    exit();
}

// Process the cart items
if (isset($_POST['item']) && isset($_POST['quantity'])) {
    foreach ($_POST['item'] as $key => $value) {
        if ($_POST['quantity'][$key] != "" && is_numeric($_POST['quantity'][$key])) {
            $item = array("name" => $value, "quantity" => $_POST['quantity'][$key]);
            $found = false;
            // Check if the item already exists in the cart
            for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                if ($_SESSION['cart'][$i]['name'] == $item['name']) {
                    // If the item exists, update the quantity
                    $_SESSION['cart'][$i]['quantity'] += $item['quantity'];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                // If the item does not exist, add it to the cart
                array_push($_SESSION['cart'], $item);
            }
        }
    }
}

// Update the cart items
if (isset($_POST['update'])) {
    foreach ($_POST['cart'] as $key => $value) {
        if ($value['quantity'] == "" || !is_numeric($value['quantity']) || $value['quantity'] == 0) {
            // If the quantity is invalid or zero, remove the item from the cart
            unset($_SESSION['cart'][$key]);
        } else {
            // Otherwise, update the quantity of the item in the cart
            $_SESSION['cart'][$key]['quantity'] = $value['quantity'];
        }
    }
}


if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset the cart keys
}


if(isset($_POST['home'])){
  
    header("Location: catalogue.php");
    exit();
}

if(isset($_POST['signout'])){
    session_destroy();
    header("Location: index.php");
    exit();
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        /* make this in dark theme not black color*/


        body {
            font-family: Arial, Helvetica, sans-serif; 
        }

        h2 {
            text-align: center;
        }

        form {
            width: 30%;
            margin: 0 auto;
        }

        input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
        }

        input[type=number] {
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
        .home{
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .signout{
            background-color: #f44336;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

    </style>

</head>

<body>
    <form action='cart.php' method='post'>
        <table>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($_SESSION['cart'] as $key => $value) {
                echo "<tr><td>" . $value['name'] . "</td>";
                echo "<td><input type='number' name='cart[" . $key . "][quantity]' value='" . $value['quantity'] . "' min='0'></td>";
                // Get the item price from the database
                $price = 10.00; // Example price
                echo "<td>$" . $price . "</td>";
                $subtotal = $price * $value['quantity'];
                $total += $subtotal;
                echo "<td>$" . $subtotal . "</td>";
                echo "<td><a href='cart.php?remove=" . $key . "'>Remove</a></td></tr>";
            }
            ?>
        </table>
        <input type='submit' name='update' value='Update'>
        <?php
        echo "<p>Total: $" . $total . "</p>";
        ?>
        <input type='submit' class="home" name='home' value='Catalogue'></input>
        <input type='submit' class="signout" name='signout' value='Signout'></input>

    </form>


</body>

</html>