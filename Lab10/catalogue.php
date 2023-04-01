<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // If not, redirect to the login page
    exit();
}

// Display the catalogue items
$items = array(
    array("name" => "Thumbs Up", "availability" => "In stock", "price" => 20.00),
    array("name" => "Ice Cream", "availability" => "Out of stock", "price" => 20.00),
    array("name" => "Kurkure", "availability" => "In stock", "price" => 15.00),
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Page</title>
    <style>
        /* Write CSS Code */
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th,
        td {
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .submit {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .submit:hover {
            opacity: 0.8;
        }
        .catalogue {
            text-align: center;
        }

    </style>
</head>

<body>
    <h2 class="catalogue">Catalogue</h2>
    <form action='cart.php' method='post'>
        <table>
            <tr>
                <th>Name</th>
                <th>Availability</th>
                <th>Price</th>
                <th>Add to Cart</th>
                <th>Quantity</th>
            </tr>
            <?php
            foreach ($items as $item) {
                echo "<tr><td>" . $item['name'] . "</td>";
                echo "<td>" . $item['availability'] . "</td>";
                echo "<td>$" . $item['price'] . "</td>";
                if ($item['availability'] == 'In stock') {
                    echo "<td><input type='checkbox' name='item[]' value='" . $item['name'] . "'></td>";
                    echo "<td><input type='text' name='quantity[]' value='1'></td></tr>";
                } else {
                    echo "<td><input type='checkbox' name='item[]' value='" . $item['name'] . "' disabled></td>";
                    echo "<td><input type='text' name='quantity[]' value='0' disabled></td></tr>";
                }
            }?>
        </table>
        <input class="submit" type='submit' value='Add to Cart'>
    </form>

</body>

</html>